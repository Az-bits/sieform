<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_form_mantenimiento extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_software');
		$this->load->model('Querys', "q");
		// $this->load->library('form_validation');
		//hola

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
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
		} else {
			$this->data['forms'] = $this->model_software->getSoftwareForms();
			$this->data['page_content'] = 'backend/Software/view_software_list';
			$this->data['page'] = 'Software';
			$this->render();
		}
	}

	public function new()
	{
	}

	public function create()
	{
		/**crear nuevo formulario */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ci', 'cedula del solicitante', 'required');
		$this->form_validation->set_rules('ci2', 'cedula del tecnico', 'required');
		$this->form_validation->set_rules('celular', 'celular del solicitante', 'required');
		$this->form_validation->set_rules('email', 'Email del solicitante', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_status_header('400');
			echo validation_errors();
		} else {
			$id = $this->input->post('id_formulario_software');
			$data = [
				'id_persona_solicitante' => $this->input->post('idpersona'),
				'id_persona_desarrollador' => $this->input->post('idpersona2'),
				'tipo_trabajo' => $this->input->post('tipo_trabajo'),
				'fecha_ini' => $this->input->post('fecha_ini') ? date("Y-m-d", strtotime($this->input->post('fecha_ini'))) : null,
				'fecha_fin' => $this->input->post('fecha_fin') ? date("Y-m-d", strtotime($this->input->post('fecha_fin'))) : null,
				'celular' => $this->input->post('celular'),
				'email' => $this->input->post('email'),
				'observaciones' => $this->input->post('observaciones'),
				'estado' => 'A'
			];
			$message = '';
			if ($id) {
				$this->q->updateTable('formularios_software', 'id_formulario_software', $id, $data);
				$message = 'actualizado';
			} else {
				$this->q->insertTable('formularios_software', $data);
				$message = 'creado';
			}
			echo json_encode(array(['message' => 'Formulario ' . $message . ' correctamente']));
		}
	}

	public function edit()
	{
		$id = $this->input->get('id');
		$dataForm  =	$this->model_software->getSoftwareForms($id)[0];
		$data = [
			[
				'id_formulario_software' =>  $dataForm->id_formulario_software,
				'idpersona' => $dataForm->id_persona_solicitante,
				'idpersona2' => $dataForm->id_persona_desarrollador,
				'nombreCompleto' => $dataForm->solicitante,
				'nombreCompleto2' => $dataForm->tecnico,
				'celular' => $dataForm->fcelular ? $dataForm->fcelular : $dataForm->celular,
				'email' => $dataForm->femail ? $dataForm->femail : $dataForm->email,
				'celular2' => $dataForm->celular2,
				'email2' => $dataForm->email2,
				'ci' => $dataForm->ci,
				'ci2' => $dataForm->ci2,
				'tipo_trabajo' => $dataForm->tipo_trabajo,
				'fecha_ini' =>  $dataForm->fecha_ini ? date("m-d-Y", strtotime($dataForm->fecha_ini)) : '',
				'fecha_fin' =>  $dataForm->fecha_fin ? date("m-d-Y", strtotime($dataForm->fecha_fin)) : '',
				'observaciones' => $dataForm->observaciones,

			]
		];
		echo json_encode($data);
	}

	public function delete()
	{
		$this->model_software->updateTable($this->input->get('id'), ['estado' => 'I']);
		echo json_encode([['message' => 'Su formulario ha sido eliminado.']]);
	}
	public function pdf()
	{
		// $id = $this->input->get('id');
		// $data = $this->model_software->getForm($id);
		// var_dump($data);


		ob_start();
		require_once APPPATH . "/libraries/fpdf/fpdf.php";
		$pdf = new FPDF('P', 'mm', 'A4', true);
		$pdf->AddPage();

		$pdf->Image("assets/img/sielogo.png", 10, 10, 25, 25, "png");

		$pdf->ln(12);
		$pdf->SetTextColor(22, 50, 126);
		$pdf->setFont('Times', 'B', 24);
		$pdf->cell(198, 7, 'LISTAR USUARIOS', 0, 1, 'C');

		$pdf->setFont('Times', 'B', 10);
		$pdf->cell(198, 1, '============================================================', 0, 1, 'C');

		$pdf->SetFillColor(184, 191, 211);
		// $pdf->SetDrawColor(0,100,102);

		$pdf->ln(10);
		$pdf->cell(10, 6, '#', 1, 0, 'C', 1);
		$pdf->cell(20, 6, 'CARNET', 1, 0, 'C', 1);
		$pdf->cell(40, 6, 'NOMBRE', 1, 0, 'C', 1);
		$pdf->cell(45, 6, 'APELLIDO', 1, 0, 'C', 1);
		$pdf->cell(20, 6, 'CELULAR', 1, 0, 'C', 1);
		$pdf->cell(20, 6, 'ESTADO', 1, 0, 'C', 1);
		$pdf->cell(35, 6, 'ROL', 1, 1, 'C', 1);

		$con = 1;
		// foreach ($this->Model_usuario->listar_usuarios() as $objecto) {
		// 	$pdf->setFont('Times', '', 8);
		// 	$pdf->cell(10, 6, $con++, 1, 0, 'C');
		// 	$pdf->cell(20, 6, $objecto->ci, 1, 0, 'C');
		// 	$pdf->cell(40, 6, $objecto->nombre, 1, 0, 'C');
		// 	$pdf->cell(45, 6, $objecto->paterno . ' ' . $objecto->materno, 1, 0, 'C');
		// 	$pdf->cell(20, 6, $objecto->celular, 1, 0, 'C');
		// 	$pdf->cell(20, 6, $objecto->estado, 1, 0, 'C');
		// 	$pdf->cell(35, 6, $objecto->roles, 1, 1, 'C');
		// }

		$pdf->output('imprimir_lista_usuario.pdf', 'I');
		ob_end_clean();
	}



	public function getSoftwareForms()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode(['data' => $this->model_software->getSoftwareForms()]);
		}
	}



	public function searchByCI()
	{
		if ($this->input->is_ajax_request()) {
			$foco = $this->input->post('foco');
			$data = [[0 => 0]];
			$ci =  $this->input->post('ci');
			$person  =	$this->model_software->searchByCI($ci);
			if ($person) {
				$person = $person[0];
				$data = [
					[
						'idpersona' . $foco => $person->id,
						'ci' . $foco => $person->ci,
						'nombreCompleto' . $foco => $person->nombre . ' ' . $person->paterno . ' ' . $person->materno,
						'celular' . $foco => $person->celular,
						'email' . $foco => $person->email,
					]
				];
			}
			echo json_encode($data);
		}
	}
}
