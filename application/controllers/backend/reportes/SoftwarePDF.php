<?php
defined('BASEPATH') or exit('No direct script access allowed');
setlocale(LC_TIME, 'es_ES');
date_default_timezone_set('America/La_Paz');

use setasign\Fpdi\Fpdi;

class SoftwarePDF extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fpdf/FPDF');
        $this->load->model('SoftwareModel', 's');
        $this->load->model('Querys', 'q');
        require_once(APPPATH . 'libraries/easy-table/exFPDF.php');
        require_once(APPPATH . 'libraries/easy-table/easyTable.php');
        require_once(APPPATH . 'libraries/fpdi/src/autoload.php');
    }
    public function index()
    {
        $id = $this->input->get('id');
        if (!$data = $this->s->getDataForReport($id)) {
            redirect(site_url(Hasher::make(60)));
        }

        $data = $this->s->getDataForReport($id);

        $this->pdf($id, $data);
    }
    public function pdf($id, $data)
    {
        $pdf = new exFPDF('P', 'mm', 'Letter');


        $meses = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];

        $nombre = $data->solicitante;
        $celular = $data->celular;
        $unidad = $data->unidad;
        $desarrollador = $data->desarrollador;
        $celular2 = $data->celular2;
        $tipo_trabajo = $data->tipo_trabajo;
        $modulo = $data->modulo;
        $opciones = $data->opciones;
        $observaciones = $data->observaciones;
        $fecha_fin = $data->fecha_fin;


        // $b = 1;
        $b = 0;

        $pdf->AddPage();
        $pdf->setXY(0, 10);
        $pdf->SetLeftMargin(10.9);
        $pdf->SetRightMargin(10);
        /**
         * init::Header
         */
        $pdf->AddFont('BodoniMTBlack', '', 'bodoni-mt-black-2.php');
        $pdf->AddFont('Tahoma-Bold', '', 'TAHOMAB0.php');

        $pdf->Image('assets/img/content-round.png', 83, 10, 50, 8);


        $pdf->SetFont('BodoniMTBlack', '', 10);
        $pdf->Cell(0, 8, utf8_decode('FORMULARIO N° 2'), 0, 1, 'C');

        $pdf->Image('assets/img/upea.jpg', 21, 6, 18, 18);
        $pdf->Image('assets/img/sielogo.png', 175, 5, 24, 22);

        $pdf->SetFont('Tahoma-Bold', 'U', 10);
        $pdf->Cell(0, 5, utf8_decode('FORMULARIO DE SOFTWARE'), 0, 1, 'C');
        /**
         * end::Header
         */

        /**
         * init::Contenido
         */

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(2);
        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(105, 7, '1.  DATOS DEL SOLICITANTE', $b, 0, 'L');
        $pdf->Cell(50, 7, 'FECHA: ' . date('d / m / Y'), $b, 0, 'R');
        $pdf->Cell(35, 7, 'HORA: ' . date('H:i'), $b, 1, 'R');

        $pdf->Cell(42, 6, 'NOMBRES Y APELLIDOS:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(100, 6, $nombre, $b, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 6, 'CELULAR:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(35, 6, $celular, $b, 1, 'L');

        $pdf->SetDash(0.2, 0.6);
        $pdf->SetLineWidth(0.1);
        $pdf->Line(52, 37, 152, 37);
        $pdf->Line(170, 37, 206, 37);

        $pdf->SetDash();

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 6, utf8_decode('UNIDAD/DIRECCIÓN/CARRERA:'), $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(145, 6, utf8_decode($unidad), $b, 1, 'L');

        $pdf->SetDash(0.2, 0.6);
        $pdf->Line(61, 43, 206, 43);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(195, 7, utf8_decode('2.  DATOS DEL DESARROLLADOR'), $b, 1, 'L');

        $pdf->Cell(42, 6, 'NOMBRES Y APELLIDOS:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(100, 6, $desarrollador, $b, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 6, 'CELULAR:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(35, 6, $celular2, $b, 1, 'L');

        $pdf->Line(52, $pdf->GetY() - 1, 152, $pdf->GetY() - 1);
        $pdf->Line(170, $pdf->GetY() - 1, 206, $pdf->GetY() - 1);

        $pdf->SetFont('Arial', 'B');
        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(195, 7, utf8_decode('3.  TIPO DE TRABAJO'), $b, 1, 'L');

        $pdf->SetDash();

        $table = new easyTable($pdf, '%{50,50} ', ' line-height:1.2; border-width:0.1; border:1');
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('SOPORTE Y MANTENIMIENTO'), 'align:C');
        $table->easyCell(utf8_decode('SOLUCIÓN DE PROBLEMAS'), 'align:C');
        $table->printRow();
        $table->endTable(0);


        $y = $pdf->GetY() - 5.1;
        $pdf->Image('assets/img/area-checked.png', 25, $y, 4, 4);
        $pdf->Image('assets/img/area-checked.png', 125, $y, 4, 4);
        switch ($tipo_trabajo) {
            case 'SM':
                $pdf->Image('assets/img/checked.png', 25, $y, 4, 4);
                break;
            case 'SP':
                $pdf->Image('assets/img/checked.png', 125, $y, 4, 4);
                break;
        }

        $pdf->SetFont('Arial', 'B');
        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(195, 7, utf8_decode('3.  TIPO DE TRABAJO'), $b, 1, 'L');

        $table = new easyTable($pdf, '%{10,30,30,30} ', ' line-height:1.2; border-width:0.1; border:1');
        $table->rowStyle('font-style:B;paddingX:2');
        $table->easyCell(utf8_decode('N°'), 'align:C');
        $table->easyCell(utf8_decode('Modulo(s)'), 'align:C');
        $table->easyCell(utf8_decode('observaciones de módulo(s)'), 'align:C');
        $table->easyCell(utf8_decode('Observaciones'), 'align:C');
        $table->printRow();
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('1'), 'align:C');
        $table->easyCell(utf8_decode($modulo), 'align:C');
        $table->easyCell(utf8_decode($opciones), 'align:C');
        $table->easyCell(utf8_decode($observaciones), 'align:C');
        $table->printRow();
        $table->endTable(0);

        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(190, 7, '4. CONFORMIDAD DE SERVICIO POR EL SOLICITANTE.', 0, 1, 'L');
        $pdf->Cell(155, 7, 'Fecha: ', 0, 0, 'R');
        $pdf->SetFont('Arial', '');
        $pdf->Cell(40, 7, date("d", strtotime($fecha_fin)) . ' de ' . $meses[(int)date("m", strtotime($fecha_fin)) - 1] . ' de ' . date("Y", strtotime($fecha_fin)), 0, 1, 'R');

        $y = $pdf->GetY();

        $pdf->SetY($y + 40);

        $table = new easyTable($pdf, '%{50,50} ', ' width:195; bgcolor:#000; line-height:1.2; border-width:0.1; border:0; border-color:#000;font-size:7;paddingX:6;align:{C};');
        $table->rowStyle('bgcolor:#fff; font-style:B; font-color:#000; min-height:0;');
        $table->easyCell(utf8_decode('CONFORMIDAD DEL (SOLICITANTE)'));
        $table->easyCell(utf8_decode('DESARROLLADOR'), 'align:C');
        $table->printRow();
        $table->endTable(20);

        $pdf->SetDash(0.2, 0.6);
        $pdf->Line(32, $y + 40, 89, $y + 40);
        $pdf->Line(128, $y + 40, 186, $y + 40);

        $pdf->SetY($pdf->GetPageHeight() - 30);

        $table = new easyTable($pdf, '%{13,87} ', ' width:195; font-size:7;border:0');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;');
        $table->easyCell(utf8_decode('Codigo documento: '));

        $table->printRow();
        $table->endTable(0);

        /**
         * end::footer
         */

        $name = '__azfile';
        $ruta = 'uploads/archivos/' . $name  . '.pdf';
        $pdf->Output('F', $ruta);
        $hash = hash_file('sha256', $ruta);
        // $name = $hash;

        if ($res = $this->q->verifyExist('r_multimedia_redes', $hash)) {
            unlink($ruta);
            $this->session->set_userdata('name', $res[0]['nombre_archivo']);
            redirect(site_url(Hasher::make(31)));
            return;
        }
        $this->editPdf($ruta, $hash, $name, $id);
    }
    public function editPdf($ruta, $hash, $name, $id)
    {
        $pdf = new FPDI('P', 'mm', 'Letter');

        $pageCount = $pdf->setSourceFile($ruta);
        $templateId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($templateId);
        $pdf->SetFont('Arial', 'B', 7);

        $pdf->SetY($pdf->GetPageHeight() - 29);

        $pdf->Cell(26, 3, '', 0, 0, 'C');
        $pdf->Cell(160, 3, $hash, 0, 1, 'L');

        unlink($ruta);

        $pdf->Output('F', $ruta);


        // readfile($ruta);


        $this->session->set_userdata('name', $name);
        redirect(site_url(Hasher::make(31)));

        // $this->guardaMultimedia($name, $ruta, $hash, $id);
    }
    public function guardaMultimedia($name, $ruta, $hash, $id)
    {
        $data = [
            'nombre_archivo' => $name,
            'url' => $ruta,
            'extension' => '.pdf',
            'tamaño' => filesize($ruta),
            'hash_archivo' => $hash,
            'fecha_registro' => date('Y-m-d')
        ];

        $idMultimedia = $this->q->insertarTabla('multimedia', $data);
        $this->q->insertarTabla('s_multimedia_form_software', ['id_formulario' => $id, 'id_multimedia' => $idMultimedia]);
    }
}
