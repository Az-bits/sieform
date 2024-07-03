<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RedesController extends Backend
{
	private $message = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RedesModel', 'r');
		$this->load->model('Querys', "q");
		$this->load->library('form_validation');

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
			// $this->data['forms'] = $this->r->getFormulariosSoftware();
			$this->data['page_content'] = 'backend/redes/r_vista_index';
			$this->data['page'] = 'redes';
			$this->data['title'] = 'Redes';
			$this->render();
		}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()) {
			$data['data']['materiales'] = $this->r->getMaterialUpea();
			$data['data']['procedimientos'] = $this->r->getProcedimientosRedes();
			$data['data']['defectos'] = $this->r->getDefectosRedes();
			// $data['personas'] = $this->r->getPersonas();
			echo json_encode($data);
		}
	}
	public function guardarFormulario()
	{
		/**crear nuevo formulario */

		$this->form_validation->set_rules('idpersona', 'cedula del solicitante', 'required');
		// $this->form_validation->set_rules('ci2', 'cedula del tecnico', 'required');
		// $this->form_validation->set_rules('celular', 'celular del solicitante', 'required');
		// $this->form_validation->set_rules('email', 'Email del solicitante', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_status_header('400');
			echo validation_errors();
		} else {
			$message = '';
			$procedimientos = $this->input->post('procedimientos') ?? [];
			$defectos = $this->input->post('defectos') ?? [];
			$materiales = $this->input->post('materiales') ?? [];
			$id = $this->input->post('id_formulario');

			// preparando datos de formulario para la inserción
			$datosInsertar = [
				'id_solicitante' => $this->input->post('idpersona'),
				'id_tecnico' => $this->input->post('idpersona2'),
				'id_usuario' => $this->session->user_id,
				'celular' => trim($this->input->post('celular')),
				'email' => trim($this->input->post('email')),
				'unidad' => trim($this->input->post('unidad')),
				'descripcion' => trim($this->input->post('descripcion')),
				'observaciones' => trim($this->input->post('observaciones')),
				'fecha_ini' => date("Y-m-d", strtotime($this->input->post('fecha_ini'))),
				'fecha_fin' => date("Y-m-d", strtotime($this->input->post('fecha_fin'))),
				'soporte_nivel_logico' => $this->input->post('soporte_nivel_logico'),
				'soporte_nivel_fisico' => $this->input->post('soporte_nivel_fisico'),
				'estado' => 'A'
			];

			//inserta o actualiza formulario de redes
			if ($id) {
				$this->q->actualizarTabla('r_formularios_redes', 'id_formulario', $id, $datosInsertar);
				$this->q->eliminar('r_procedimientos_realizados', 'id_formulario', $id);
				$this->q->eliminar('r_defectos_reportados', 'id_formulario', $id);
				$this->q->eliminar('r_materiales_usados', 'id_formulario', $id);
				$idNuevo = $id;
				$message = 'actualizado';
			} else {
				$idNuevo = $this->q->insertarTabla('r_formularios_redes', $datosInsertar);
				$message = 'creado';
			}
			//inserta procedimientos - defectos - materiales usados 
			foreach ($procedimientos as $p) {
				$this->q->insertarTabla('r_procedimientos_realizados', ['id_formulario' => $idNuevo, 'id_procedimiento_redes' => $p]);
			}
			foreach ($defectos as $d) {
				$this->q->insertarTabla('r_defectos_reportados', ['id_formulario' => $idNuevo, 'id_defecto' => $d]);
			}
			foreach ($materiales as $m) {
				if ($m['id'] ?? false) {
					$this->q->insertarTabla('r_materiales_usados', ['id_formulario' => $idNuevo, 'id_material' => $m['id'], 'cantidad' => $m['cantidad'] ?? null, 'fecha_uso' => date('Y-m-d')]);
				}
			}
			//respuesta ala petición ajax
			echo json_encode(['message' => 'Formulario ' . $message . ' correctamente']);
		}
	}

	public function editar()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$data = $this->r->getFormulariosRedes($this->input->get('id'));
		$datosEnviar['formulario'] = $data;
		$datosEnviar['data'] = $this->r->getDatosParaCheckBox($data->id_formulario);
		echo json_encode($datosEnviar);
	}
	// Eliminación lógica del formulario
	public function eliminar()
	{
		$this->q->actualizarTabla('r_formularios_redes', 'id_formulario', $this->input->get('id'), ['estado' => 'E']);
		echo json_encode(['message' => 'Su formulario ha sido eliminado.']);
	}

	public function getFormulariosRedesAjax()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode(['data' => $this->r->getFormulariosRedes()]);
		}
	}
	// Buscar persona por su ci
	public function buscarPersona()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->q->buscarPersona($this->input->get('buscarString')));
		}
	}

	// Cambia estado del formulario 
	public function estado()
	{
		if ($this->input->is_ajax_request()) {
			$estado = $this->input->get('estado');
			if ($estado === 'A' || $estado === 'C') {
				$this->q->actualizarTabla('r_formularios_redes', 'id_formulario', $this->input->get('id'), ['estado' => $estado]);
				echo json_encode([['message' => 'Estado actualizado correctamente']]);
			} else {
				$this->output->set_status_header('400');
				echo 'Seleccione un estado';
			}
		}
	}
}
