<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LectorPdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fpdf/FPDF');
    }
    public function index()
    {
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=" . $this->session->name . ".pdf");
        readfile('uploads/archivos/' . $this->session->name . '.pdf');
    }
}
