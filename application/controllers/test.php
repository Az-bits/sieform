<?php
class test extends CI_Controller
{

    public function index()
    {
        // $this->load->model('mantenimiento/model_revisiones_realizadas', "m");
        $this->load->model('querys', "q");
        // var_dump($_SESSION);
        // var_dump(empty($this->m->search_by_ci('10000s001')));

        // var_dump($this->q->searchByCi('10000'));
        echo json_encode($this->q->searchByCi('10000'));
    }
    public function new()
    {
        // $this->load->model('mantenimiento/model_revisiones_realizadas', "m");

        // $this->m->get_forms_revision_realizada();
        // var_dump($this->m->get_forms_revision_realizada());
        // $this->load->view('backend/_theme/template');
        $view = $this->load->view('backend/Mantenimiento/mantenimiento/view_mantenimiento_list', false);
        echo $view;
    }
}
