<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PublicacionController extends Backend
{
	private $message = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PublicacionModel', 'p');
		$this->load->model('Querys', "q");
		$this->load->library('upload');

		$this->form_validation->set_error_delimiters($this->config->item('error_prefix'), $this->config->item('error_suffix'));

		if (!$this->ion_auth->logged_in()) {
			redirect(site_url(Hasher::make(3)));
		} else {
			if (!$this->ion_auth->in_group('admin')) {
				redirect(site_url(Hasher::make(3)));
			}
		}
		$dato = $this->ion_auth->user()->row();
	}

	public function index()
	{
		// ir ala vista formularios de software
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
		} else {
			$this->data['page_content'] = 'backend/publicacion/p_vista_index';
			$this->data['page'] = 'publicacion';
			$this->data['title'] = 'Publicaciones';

			$this->render();
		}
	}
	public function nuevo()
	{
		// ir ala vista formularios de software
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		// Traer datos para mostrar en el formulario
		$data =  $this->p->datosFormulario();
		echo json_encode($data);
	}
	public function guardarFormulario()
	{

		/**crear nuevo formulario o actualizarlo */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fecha_inicio', 'fecha inicio', 'required');
		$this->form_validation->set_rules('id_tipo_publicacion', 'tipo de publicación', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->output->set_status_header('400');
			echo validation_errors();
		} else if ((isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) && !$this->verifyFile('imagen')) {
			$this->output->set_status_header('400');
			echo '<div class="alert alert-danger" role="alert">' . $this->message . '</div>';
			exit;
		} else {
			// var_dump($_FILES);
			$id = $this->input->post('id_publicacion');
			$data = [
				'id_tipo_publicacion' => empty($this->input->post('id_tipo_publicacion')) ? null : $this->input->post('id_tipo_publicacion'),
				'id_usuario' => $this->session->user_id,
				'detalle' => $this->input->post('detalle'),
				'fecha_inicio' => $this->input->post('fecha_inicio') ? date("Y-m-d", strtotime($this->input->post('fecha_inicio'))) : null,
				'fecha_fin' => $this->input->post('fecha_fin') ? date("Y-m-d", strtotime($this->input->post('fecha_fin'))) : null,
				'visibilidad' => $this->input->post('visibilidad') ?? '0',
				'estado' => 'A'
			];
			if (!$id) {
				$idNuevo = $this->q->insertarTabla('p_publicaciones', $data);
				$this->message = 'creada';
			} else {
				$this->q->actualizarTabla('p_publicaciones', 'id_publicacion', $id, $data);

				if ((isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK)) {
					$this->q->eliminar('p_multimedia_publicaciones', 'id_publicacion', $id);
					$this->q->eliminar('multimedia', 'id_multimedia', $this->input->post('id_multimedia'));
				}

				$this->message = 'actualizada';
				$idNuevo = $id;
			}
			if ((isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK)) {
				$this->do_upload($idNuevo, 'imagen');
			}
			echo json_encode(['message' => 'Publicación ' . $this->message . ' correctamente']);
		}
	}
	public function verifyFile($file)
	{
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'jpg|png'; // Extensiones de archivo permitidas
		$config['max_size'] = 2048;
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($file)) {
			$this->message =  $this->upload->display_errors();
			return false;
		}
		$data = $this->upload->data();
		unlink($config['upload_path'] . '/' . $data['file_name']);
		return  true;
	}
	public function do_upload($id, $nameFile)
	{
		$carpeta = './uploads/publicaciones/' . $id;

		if (!is_dir($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$config['upload_path'] = $carpeta . '/'; // Ruta donde se guardarán los archivos subidos
		$config['allowed_types'] = 'gif|jpg|png'; // Extensiones de archivo permitidas
		$config['max_size'] = 2048;

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($nameFile)) {
			return $this->upload->display_errors();
		} else {
			$data = $this->upload->data();
			$name = $data['file_name'];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			$uniqueName = uniqid() . "." . $extension; // nombre unico
			$rutaAntigua = $config['upload_path'] . $name;
			$rutaNueva = $config['upload_path']	 . $uniqueName;
			$tamaño = $data['file_size'];
			rename($rutaAntigua, $rutaNueva);

			$data = [
				'nombre_archivo' => $uniqueName,
				'url' => $rutaNueva,
				'extension' => $extension,
				'fecha_registro' => date('Y-m-d'),
				'tamaño' => $tamaño,
			];
			$idNuevo = $this->q->insertarTabla('multimedia', $data);
			$this->q->insertarTabla('p_multimedia_publicaciones', ['id_multimedia' => $idNuevo, 'id_publicacion' => $id]);
		}

		$this->load->library('upload', $config);
	}
	public function editar()
	{
		/** Datos a mostrar al momento de editar */
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$data = $this->p->getPublicaciones($this->input->get('id'));
		$data->banner =  $this->p->getImagen($data->url);
		$datosEnviar['formulario'] = $data;
		//$datosEnviar['data'] = $this->c->getDatosParaCheckBox($data->id_formulario);
		echo json_encode($datosEnviar);
	}

	public function eliminar()
	{
		// Eliminación lógica del formulario
		$this->q->actualizarTabla('p_publicaciones', 'id_publicacion', $this->input->get('id'), ['estado' => 'E']);
		echo json_encode(['message' => 'Su publicacion ha sido eliminado.']);
	}

	public function getPublicacionesAjax()
	{
		// listado de formularios via ajax
		if ($this->input->is_ajax_request()) {
			$data = $this->p->getPublicaciones();
			foreach ($data as $key => $d) {
				$d->banner =  $this->p->getImagen($d->url);
			}
			echo json_encode(['data' => $data]);
		}
	}
}
