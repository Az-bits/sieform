<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MantenimientoController extends Backend
{
	private $message = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MantenimientoModel', 'm');
		$this->load->model('Querys', "q");

		$this->form_validation->set_error_delimiters($this->config->item('error_prefix'), $this->config->item('error_suffix'));

		if (!$this->ion_auth->logged_in()) {
			echo 'no autenticado';
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
		// ir ala vista formularios de mantenimiento
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
		} else {
			$this->data['page_content'] = 'backend/mantenimiento/m_vista_index';
			$this->data['subtitle'] = 'Mantenimiento';
			$this->data['page'] = 'mantenimiento';
			$this->data['title'] = 'Mantenimiento';
			$this->render();
		}
	}
	public function nuevo()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		echo json_encode([
			[
				'modelos' => $this->m->get_model_equipos(),
				'marcas' => $this->m->get_marcas_equipos(),
				'tipos' => $this->m->get_tipos_equipos(),
				'defectos' => $this->m->get_defectos_equipo()
			]
		]);
	}
	public function guardarFormulario()
	{
		$ci_solicitante = trim($this->input->post('ci'));
		$ci_tecnico =  trim($this->input->post('ci2')) ?? null;

		/**crear nuevo formulario o actualizarlo */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('idpersona', 'solicitante', 'required');
		$this->form_validation->set_rules('idpersona2', 'desarrollador', 'required');
		$this->form_validation->set_rules('celular', 'celular del solicitante', 'required');
		$this->form_validation->set_rules('email', 'Correo del solicitante', 'required');
		$this->form_validation->set_rules('fecha_ini', 'fecha inicio', 'required');
		$this->form_validation->set_rules('defecto', 'defecto', 'trim|max_length[255]');
		$this->form_validation->set_rules('solucion', 'solucion', 'trim|max_length[255]');

		if ($this->form_validation->run() === FALSE) {
			$this->output->set_status_header('400');
			echo validation_errors();
		} else {
			$emp_sol = empty($this->m->search_by_ci($ci_solicitante)); // vacio - error 
			$emp_tec = empty($this->m->search_by_ci($ci_tecnico)); // error - vacio
			if ($emp_sol) {
				if ($emp_tec && $ci_tecnico) {
					echo 'Tecnico no encontrado.<br>';
					$this->output->set_status_header('400');
				}
				if ($emp_sol) {
					echo 'Solicitante no encontrado.';
					$this->output->set_status_header('400');
				}
			} else {
				// var_dump($_POST);
				$id_persona_solicitante = $this->m->search_by_ci($ci_solicitante)[0]->id;
				$id_persona_tecnico = null;
				if ($ci_tecnico) {
					$persona_tecnico =  $this->m->search_by_ci($ci_tecnico);
					empty($persona_tecnico) ? $id_persona_tecnico = null : $id_persona_tecnico = $persona_tecnico[0]->id;
				}
				$id = $this->input->post('id_formulario');
				$data = [
					'id_solicitante' => intval($id_persona_solicitante),
					'id_tecnico' => $id_persona_tecnico,
					'id_usuario' => $this->session->user_id,
					'id_tipo_equipo' => $this->input->post('id_tipo_equipo') ? $this->input->post('id_tipo_equipo') : null,
					'id_marca' => $this->input->post('id_marca_equipo') ? $this->input->post('id_marca_equipo') : null,
					'id_modelo' => $this->input->post('id_modelo_equipo') ? $this->input->post('id_modelo_equipo') : null,
					'id_defecto' => $this->input->post('id_defecto') ? $this->input->post('id_defecto') : null,
					'celular' => intval($this->input->post('celular')),
					'email' => $this->input->post('email'),
					'estado_equipo' => $this->input->post('estado_equipo'),
					'area_origen' => $this->input->post('area_origen'),
					'descripcion' => $this->input->post('descripcion'),
					'defecto' => $this->input->post('defecto'),
					'solucion' => $this->input->post('solucion'),
					'tipo_mantenimiento' => $this->input->post('tipo_mantenimiento'),
					'fecha_ini' => $this->input->post('fecha_ini') ? date("Y-m-d", strtotime($this->input->post('fecha_ini'))) : null,
					'fecha_fin' => $this->input->post('fecha_fin') ? date("Y-m-d", strtotime($this->input->post('fecha_fin'))) : null,
					'estado' => 'A',
				];
				if (!$id) {
					$id_formulario = $this->q->insertarTabla('m_formularios_mantenimiento', $data);
					$this->message = 'creado';
				} else {
					$this->q->actualizarTabla('m_formularios_mantenimiento', 'id_formulario', $id, $data);
					$this->message = 'actualizado';
				}
				echo json_encode(['message' => 'Formulario ' . $this->message . ' correctamente']);
			}
		}
	}

	public function editar()
	{
		$id = $this->input->get('id');
		$dataForm  =  $this->m->getFormulariosMantenimiento($id);
		// var_dump($dataForm);
		$data =
			[
				'id_formulario' =>  $dataForm->id_formulario,
				'idpersona' => $dataForm->id_solicitante,
				'ci' => $dataForm->ci,
				'nombreCompleto' => $dataForm->solicitante,
				'idpersona2' => $dataForm->id_tecnico,
				'email' => $dataForm->femail ? $dataForm->femail : $dataForm->email,
				'celular' => $dataForm->fcelular ? $dataForm->fcelular : $dataForm->celular,
				'area_origen' => $dataForm->area_origen,
				'nombreCompleto2' => $dataForm->tecnico,
				'ci2' => $dataForm->ci2,
				'celular2' => $dataForm->celular2,
				'email2' => $dataForm->email2,
				'id_tipo_equipo' => $dataForm->id_tipo_equipo,
				'id_marca_equipo' => $dataForm->id_marca,
				'id_modelo_equipo' => $dataForm->id_modelo,
				'id_defecto' => $dataForm->id_defecto,
				'estado_equipo' => $dataForm->estado_equipo,
				'descripcion' => $dataForm->descripcion,
				'defecto' => $dataForm->defecto,
				'solucion' => $dataForm->solucion,
				'tipo_mantenimiento' => $dataForm->tipo_mantenimiento,
				'estado' => $dataForm->estado,

				'fecha_ini' =>  $dataForm->fecha_ini ? date("m-d-Y", strtotime($dataForm->fecha_ini)) : '',
				'fecha_fin' =>  $dataForm->fecha_fin ? date("m-d-Y", strtotime($dataForm->fecha_fin)) : '',

			];
		echo json_encode($data);
	}
	// Eliminación lógica del formulario
	public function eliminar()
	{
		$this->q->actualizarTabla('m_formularios_mantenimiento', 'id_formulario', $this->input->get('id'), ['estado' => 'E']);
		echo json_encode(['message' => 'Su formulario ha sido eliminado.']);
	}

	public function getFormulariosMantenimiento()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode(['data' => $this->m->getFormulariosMantenimiento()]);
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
				$this->q->actualizarTabla('m_formularios_mantenimiento', 'id_formulario', $this->input->get('id'), ['estado' => $estado]);
				echo json_encode([['message' => 'Estado actualizado correctamente']]);
			} else {
				$this->output->set_status_header('400');
				echo 'Seleccione un estado';
			}
		}
	}
}
