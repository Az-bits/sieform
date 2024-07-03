<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CuentasUsuarioController extends Backend
{
	private $message = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CuentaUsuarioModel', 'c');
		$this->load->model('Querys', "q");

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
			$this->data['page_content'] = 'backend/cuentasUsuario/c_vista_index';
			$this->data['page'] = 'cuentasUsuario';
			$this->data['title'] = 'Cuenta Usuarios';

			$this->render();
		}
	}
	public function guardarFormulario()
	{
		/**crear nuevo formulario o actualizarlo */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('idpersona', 'solicitante', 'required');
		$this->form_validation->set_rules('idpersona2', 'desarrollador', 'required');
		$this->form_validation->set_rules('celular', 'celular del solicitante', 'required');
		$this->form_validation->set_rules('email', 'Correo del solicitante', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_status_header('400');
			echo validation_errors();
		} else {
			// var_dump($_POST);
			$message = '';
			$id = $this->input->post('id_formulario');
			$operaciones = $this->input->post('operaciones') ?? [];

			$data = [
				'id_solicitante' => $this->input->post('idpersona'),
				'id_tecnico' => $this->input->post('idpersona2'),
				'id_usuario' => $this->session->user_id,
				'id_sistema' => $this->input->post('id_sistema'),
				'celular' => $this->input->post('celular'),
				'email' => $this->input->post('email'),
				'observaciones' => $this->input->post('observaciones'),
				'unidad' => $this->input->post('unidad'),
				'estado' => 'A'
			];
			if (!$id) {
				$idNuevo = $this->q->insertarTabla('c_formularios_cuenta_usuario', $data);
				$this->message = 'creado';
			} else {
				$this->q->actualizarTabla('c_formularios_cuenta_usuario', 'id_formulario', $id, $data);
				$this->q->eliminar('c_operaciones_realizadas', 'id_formulario', $id);
				$this->message = 'actualizado';
				$idNuevo = $id;
			}
			//inserta procedimientos - defectos - materiales usados 
			foreach ($operaciones as $o) {
				$this->q->insertarTabla('c_operaciones_realizadas', ['id_formulario' => $idNuevo, 'id_tipo_operacion' => $o]);
			}
			echo json_encode(['message' => 'Formulario ' . $this->message . ' correctamente']);
		}
	}

	public function editar()
	{
		/** Datos a mostrar al momento de editar */
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$data = $this->c->getFormulariosCuentasUsuario($this->input->get('id'));
		$datosEnviar['formulario'] = $data;
		$datosEnviar['data'] = $this->c->getDatosParaCheckBox($data->id_formulario);
		echo json_encode($datosEnviar);
	}

	public function eliminar()
	{
		// Eliminación lógica del formulario
		$this->q->actualizarTabla('c_formularios_cuenta_usuario', 'id_formulario', $this->input->get('id'), ['estado' => 'E']);
		echo json_encode(['message' => 'Su formulario ha sido eliminado.']);
	}

	public function getFormulariosCuentasUsuarioAjax()
	{
		// listado de formularios via ajax
		if ($this->input->is_ajax_request()) {
			$data = $this->c->getFormulariosCuentasUsuario();
			foreach ($data as $key => $d) {
				$d->operacion =  $this->c->getOperaciones($d->id_formulario);
			}
			echo json_encode(['data' => $data]);
		}
	}

	public function buscarPersona()
	{
		// Buscar persona por su ci
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->q->buscarPersona($this->input->get('buscarString')));
		}
	}

	public function estado()
	{
		// Cambia estado del formulario activo - finalizado
		if ($this->input->is_ajax_request()) {
			$estado = $this->input->get('estado');
			if ($estado === 'A' || $estado === 'C') {
				$this->q->actualizarTabla('c_formularios_cuenta_usuario', 'id_formulario', $this->input->get('id'), ['estado' => $estado]);
				echo json_encode([['message' => 'Estado actualizado correctamente']]);
			} else {
				$this->output->set_status_header('400');
				echo 'Seleccione un estado';
			}
		}
	}
}
