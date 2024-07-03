<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');


class Rep_mantenimiento extends CI_Controller
{
    public function __construct()
    {
        //hola
        parent::__construct();
        $this->load->library('fpdf185/fpdf');
    }
    public function index()
    {
        // $pdf = new FPDF();
        $data = array(
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
        );
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->setXY(0, 10);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(7);
        $pdf->SetTextColor(88, 88, 88);

        // $pdf->AddFont('Calibri', 'B', 'calibri.php');
        $pdf->SetFont('Arial', '', 18.5);
        $pdf->Cell(0, 6, utf8_decode('Universidad Pública de El Alto'), 0, 1, 'C');
        // $pdf->Cell(w, h, 'text', (0 or 1), (0 or 1 or 2), (L or C or R));

        $pdf->Ln(0.1);
        $pdf->SetFontSize(7.5);
        $pdf->Cell(0, 5, 'Creada por ley 2115 del 5 de Septiembre de 2000 y Autonoma por ley 2556 del 12 de Noviembre de 2003', 0, 0, 'C', false);
        $pdf->Ln(4.5);
        $pdf->Cell(0, 5, utf8_decode('Sistema de Administración y Control de Planillas "SiACoP"'), 0, 0, 'C', false);
        $pdf->Image(base_url('assets/img/rrhh.png'), 240, 15, 33, 10);
        $pdf->Image(base_url('assets/img/upea.jpg'), 30, 14, 18, 18);
        // $pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World', 10, 15, 25, 20);
        // $pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World', 10, 30, 90, 20, 'PNG');
        $pdf->SetLineWidth(0.8);
        $pdf->Line(11, 27, 29, 27);
        $pdf->Line(48, 27, 280, 27);

        $pdf->SetFont('Times', 'B', 13.5);
        $pdf->Ln(7);
        $pdf->Cell(0, 6, 'PLANILLA DE ASISTENCIA DIARIA', 0, 0, 'C');

        $pdf->SetLineWidth(0.6);
        $pdf->SetDrawColor(88, 88, 88);
        $pdf->Line(109.5, 33, 190.5, 33);

        // $pdf->Write(10, $pdf->GetStringWidth('PLANILLA DE ASISTENCIA DIARIA'));
        // $pdf->Ln(7);
        // $pdf->Write(10, $pdf->GetY());

        $pdf->Ln();

        $pdf->SetFontSize(9);
        $pdf->SetLineWidth(0.2);
        $pdf->Cell(80, 5, utf8_decode('UNIDAD DE TELEVISIÓN UNIVERSITARIA'), 0, 0, 'L');
        $pdf->Line(11.5, 37.5, 76, 37.5);
        $pdf->Cell(182, 5, 'GESTION:', 0, 0, 'R');

        $pdf->SetFont('Times', '', 9);
        $pdf->Cell(8, 5, '2022', 0, 0, 'R');
        // $pdf->Write(10, $pdf->GetStringWidth(utf8_decode('UNIDAD DE TELEVISIÓN UNIVERSITARIA')));
        $pdf->Ln(7);

        $pdf->SetFont('Times', 'B', 10);
        // $pdf->SetFontSize(12);
        // $pdf->SetFont('Arial', 'B');
        $pdf->SetFillColor(255, 255, 255);
        // $pdf->SetTextColor(40, 40, 40);
        // $pdf->SetDrawColor(88, 88, 88);

        $p = 0;
        $q = 0;

        foreach ($data as $key => $value) {
            $pdf->SetLineWidth(0.2);
            $pdf->Cell(110, 5, 'FECHA:', 1, 0, 'L', 1, false);
            $pdf->Cell(80, 5, utf8_decode('MAÑANA'), 1, 0, 'C', 1, false);
            $pdf->Cell(80, 5, 'TARDE', 1, 0, 'C', 1);
            $pdf->Ln();

            $pdf->SetFillColor(251, 227, 213);

            $pdf->SetFontSize(6.5);
            $pdf->Cell(10, 5, utf8_decode('N°'), 1, 0, 'L', 1);
            $pdf->Cell(45, 5, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
            $pdf->Cell(20, 5, 'CI', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'Cargo', 1, 0, 'C', 1);

            $pdf->Multicell(13, 2.5, "HORA INGRESO", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(133);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);
            $pdf->Multicell(13, 2.5, "HORA SALIDA", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(173);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);

            $pdf->Multicell(13, 2.5, "HORA \nINGRESO", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(213);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);
            $pdf->Multicell(13, 2.5, "HORA SALIDA", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(253);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFontSize(8);
            $pdf->Cell(10, 10, $value['id'], 1, 0, 'L', 1);
            $pdf->Cell(45, 10, $value['nombre'], 1, 0, 'C', 1);
            $pdf->Cell(20, 10, $value['ci'], 1, 0, 'C', 1);
            $pdf->Cell(35, 10, $value['cargo'], 1, 0, 'C', 1);

            $pdf->cell(13, 10, "8:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);
            $pdf->Cell(13, 10, "12:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);

            $pdf->Cell(13, 10, "13:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);
            $pdf->Cell(13, 10, "16:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);
            $pdf->Ln(12);

            $p += 22;

            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(1);
            $pdf->Line(120, 41 + $q, 120, 60 + $q);
            $pdf->Line(200, 41 + $q, 200, 60 + $q);
            $pdf->SetLineWidth(1.2);
            $pdf->Line(280, 41 + $q, 280, 60 + $q);
            $q += 22;
        }
        $pdf->Ln(28);

        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(88, 88, 88);
        $pdf->Line(43, 177, 115, 177);
        $pdf->Line(175, 177, 250, 177);

        $pdf->Cell(135, 3, utf8_decode('VºBº INMEDIATO SUPERIOR'), 0, 0, 'C', 1);
        $pdf->Cell(135, 3, utf8_decode('VºBº RECURSOS HUMANOS'), 0, 0, 'C', 1);

        // $pdf->Write(10, $pdf->GetStringWidth(utf8_decode('VºBº INMEDIATO SUPERIOR')));

        $pdf->WriteHTML('<h1>hola<h1>');














        $pdf->Output();
    }
    public function Header()
    {
        // $pdf->SetFontSize(10);
        // $pdf->SetFont('Arial', 'B');
        // $pdf->SetFillColor(255, 255, 255);
        // $pdf->SetTextColor(40, 40, 40);
        // $pdf->SetDrawColor(88, 88, 88);
        // $pdf->Cell(20, 10, 'N', 1, 0, 'C', 1);
        // $pdf->Cell(30, 10, 'NIE', 1, 0, 'C', 1);
        // $pdf->Cell(50, 10, 'Apellidos', 1, 0, 'C', 1);
        // $pdf->Cell(50, 10, 'Nombres', 1, 0, 'C', 1);
        // $pdf->Cell(10, 10, 'Sexo', 1, 0, 'C', 1);
        // $pdf->Cell(35, 10, 'F. de nacimiento', 1, 0, 'C', 1);



        // $pdf->Cell(10, 10, 'PLANILLA DE ASISTENCIA DIARIA');
        // $pdf->Cell(30, 10, 'Title', 1, 0, 'C');
        // $pdf->Write(5, 'aquI');
        // $pdf->Cell(w,h,'text',(0 or 1),(0 or 1 or 2),(L or C or R));
        // $pdf->Line(10, 10, 10, 10);
        // $pdf->Line(103, 10, 103  - 20, 10);


        // Logo
        // $pdf->Image('logo.png', 10, 8, 33);
        // // Arial bold 15
        // $this->SetFont('Arial', 'B', 15);
        // // Movernos a la derecha
        // $this->Cell(80);
        // // Título
        // $this->Cell(30, 10, 'Title', 1, 0, 'C');
        // // Salto de línea
        // $this->Ln(20);
    }
    public function body()
    {
    }
}