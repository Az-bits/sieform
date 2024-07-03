<?php
class Controller_form_mantenimiento extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Querys', 'q');
        $this->load->model('mantenimiento/model_mantenimiento', 'm');
        // if ($this->ion_auth->logged_in())
        //     redirect(site_url(Hasher::make(1)));
    }

    public function index()
    {
        $this->load->library('parser');
        $data['theme_url'] = base_url('assets/backend/material-dashboard/');
        $data['lang_cancel']  = 'cancelar';
        $data['page'] = 'Mantenimiento';
        $data['content'] = $this->parser->parse('frontend/formularios/view_form_matenimiento', $data, TRUE);
        // $this->load->view('frontend/formularios/v_form_matenimiento', $data);
        $this->parser->parse('frontend/formularios/template', $data);
        // $this->load->view('frontend/formularios/template/v_form_matenimiento');
    }
    public function create_form_external()
    {
        $ci_solicitante = trim($this->input->post('ci'));

        $this->form_validation->set_rules('ci', 'cedula del solicitante', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header('400');
            echo validation_errors();
        } else {
            $emp_sol = empty($this->m->search_by_ci($ci_solicitante)); // vacio - error 
            if ($emp_sol) {
                echo 'Solicitante no encontrado.';
                $this->output->set_status_header('400');
            } else {
                $id_persona_solicitante = $this->m->search_by_ci($ci_solicitante)[0]->id;
                $id = $this->input->post('id_formulario_mantenimiento');
                $data = [
                    'id_persona_solicitante' => intval($id_persona_solicitante),
                    'id_tipo_equipo' => $this->input->post('id_tipo_equipo') ? $this->input->post('id_tipo_equipo') : null,
                    'id_marca_equipo' => $this->input->post('id_marca_equipo') ? $this->input->post('id_marca_equipo') : null,
                    'id_modelo_equipo' => $this->input->post('id_modelo_equipo') ? $this->input->post('id_modelo_equipo') : null,
                    'id_defecto' => $this->input->post('id_defecto') ? $this->input->post('id_defecto') : null,
                    'celular' => intval($this->input->post('celular')),
                    'email' => $this->input->post('email'),
                    'area_origen' => trim($this->input->post('area_origen')),
                    'estado_equipo' => $this->input->post('estado_equipo'),
                    'descripcion' => $this->input->post('descripcion'),
                    'estado' => 'A'
                ];
                $this->q->insertTable('formularios_mantenimientos', $data);
                echo json_encode(array(['message' => 'Formulario enviado correctamente']));
            }
        }
    }
    public function search_by_ci()
    {
        if ($this->input->is_ajax_request()) {
            $foco = $this->input->post('foco');
            $data = [[0 => 0]];
            $ci =  $this->input->post('ci');
            $person  =    $this->m->search_by_ci($ci);
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
