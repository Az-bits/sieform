<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoftwareController extends Backend
{
	private $message = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SoftwareModel', 'm');
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
			$this->data['forms'] = $this->m->getFormulariosSoftware();
			$this->data['page_content'] = 'backend/software/s_vista_index';
			$this->data['page'] = 'software';
			$this->data['title'] = 'Software';

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
			$id = $this->input->post('id_formulario');
			$data = [
				'id_solicitante' => $this->input->post('idpersona'),
				'id_desarrollador' => $this->input->post('idpersona2'),
				'id_usuario' => $this->session->user_id,
				'modulo' => $this->input->post('modulo'),
				'opciones' => $this->input->post('opciones'),
				'tipo_trabajo' => $this->input->post('tipo_trabajo'),
				'fecha_ini' => $this->input->post('fecha_ini') ? date("Y-m-d", strtotime($this->input->post('fecha_ini'))) : null,
				'fecha_fin' => $this->input->post('fecha_fin') ? date("Y-m-d", strtotime($this->input->post('fecha_fin'))) : null,
				'celular' => $this->input->post('celular'),
				'email' => $this->input->post('email'),
				'observaciones' => $this->input->post('observaciones'),
				'unidad' => $this->input->post('unidad'),
				'estado' => 'A'
			];
			if (!$id) {
				$this->q->insertarTabla('s_formularios_software', $data);
				$this->message = 'creado';
			} else {
				$this->q->actualizarTabla('s_formularios_software', 'id_formulario', $id, $data);
				$this->message = 'actualizado';
			}
			echo json_encode(['message' => 'Formulario ' . $this->message . ' correctamente']);
		}
	}

	public function editar()
	{
		/** Datos a mostrar al momento de editar */
		$dataForm = $this->m->getFormulariosSoftware($this->input->get('id'));
		$data =
			[
				'id_formulario' =>  $dataForm->id_formulario,
				'idpersona' => $dataForm->id_solicitante,
				'idpersona2' => $dataForm->id_desarrollador,
				'nombreCompleto' => $dataForm->solicitante,
				'nombreCompleto2' => $dataForm->desarrollador,
				'celular' => $dataForm->fcelular ? $dataForm->fcelular : $dataForm->celular,
				'email' => $dataForm->femail ? $dataForm->femail : $dataForm->email,
				'celular2' => $dataForm->celular2,
				'email2' => $dataForm->email2,
				'ci' => $dataForm->ci,
				'ci2' => $dataForm->ci2,
				'modulo' => $dataForm->modulo,
				'opciones' => $dataForm->opciones,
				'tipo_trabajo' => $dataForm->tipo_trabajo,
				'estado' => $dataForm->estado,
				'fecha_ini' =>  $dataForm->fecha_ini ? date("m-d-Y", strtotime($dataForm->fecha_ini)) : '',
				'fecha_fin' =>  $dataForm->fecha_fin ? date("m-d-Y", strtotime($dataForm->fecha_fin)) : '',
				'observaciones' => $dataForm->observaciones,


			];
		echo json_encode($data);
	}

	public function eliminar()
	{
		// Eliminación lógica del formulario
		$this->q->actualizarTabla('s_formularios_software', 'id_formulario', $this->input->get('id'), ['estado' => 'E']);
		echo json_encode(['message' => 'Su formulario ha sido eliminado.']);
	}

	public function getFormulariosSoftwareAjax()
	{
		// listado de formularios via ajax
		if ($this->input->is_ajax_request()) {
			echo json_encode(['data' => $this->m->getFormulariosSoftware()]);
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
				$this->q->actualizarTabla('s_formularios_software', 'id_formulario', $this->input->get('id'), ['estado' => $estado]);
				echo json_encode([['message' => 'Estado actualizado correctamente']]);
			} else {
				$this->output->set_status_header('400');
				echo 'Seleccione un estado';
			}
		}
	}
}
