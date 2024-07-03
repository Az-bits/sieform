<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');

use setasign\Fpdi\Fpdi;

class MantenimientoPDF extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('fpdf/FPDF');
        $this->load->model('MantenimientoModel', 'm');
        require_once(APPPATH . 'libraries\easy-table\exfpdf.php');
        require_once(APPPATH . 'libraries\easy-table\easyTable.php');
        require_once(APPPATH . 'libraries\fpdi\src\autoload.php');
    }
    public function index()
    {
        $id = $this->input->get('id');
        if (!$data = $this->m->getDataForReport($id)) {
            redirect(site_url(Hasher::make(70)));
        }
        $this->pdf($data, $id);
        redirect(site_url(Hasher::make(31)));
    }
    public function pdf($data, $cod)
    {
        $pdf = new exFPDF('P', 'mm', 'Letter');
        $id = $cod;
        $solicitante = $data->solicitante;
        $celular = $data->celular;
        $area_origen = $data->area_origen;
        $tecnico = $data->tecnico;
        $tcelular = $data->tcelular;
        $equipo = $data->equipo;
        $marca = $data->marca;
        $modelo = $data->modelo;
        $estado_equipo = $data->estado_equipo;
        $tipo_def = $data->tipo_def;
        $descripcion = $data->descripcion;
        $tipo_mantenimiento = $data->tipo_mantenimiento;
        $fecha_ini = $data->fecha_ini;
        $fecha_fin = $data->fecha_fin;
        $defecto = $data->defecto;
        $solucion = $data->solucion;

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
        $pdf->Cell(0, 5, utf8_decode('FORMULARIO DE SOPORTE Y MANTENIMIENTO TÉCNICO'), 0, 1, 'C');
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
        $pdf->Cell(100, 6, $solicitante, $b, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 6, 'CELULAR:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(35, 6, $celular, $b, 1, 'L');

        $pdf->SetDash(0.2, 0.6);
        $pdf->SetLineWidth(0.1);
        $pdf->Line(52, 37, 152, 37);
        $pdf->Line(170, 37, 206.5, 37);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 6, utf8_decode('UNIDAD/DIRECCIÓN/CARRERA:'), $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(145, 6, utf8_decode($area_origen), 0, 1, 'L');
        $pdf->Line(61, 43, 206, 43);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(195, 7, utf8_decode('2.  DATOS DEL TÉCNICO'), $b, 1, 'L');

        $pdf->Cell(42, 6, 'NOMBRES Y APELLIDOS:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(100, 6, $tecnico, $b, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 6, 'CELULAR:', $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(35, 6, $tcelular, $b, 1, 'L');

        $pdf->Line(52, $pdf->GetY() - 1, 152, $pdf->GetY() - 1);
        $pdf->Line(170, $pdf->GetY() - 1, 206, $pdf->GetY() - 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(190, 7, '3.  DATOS DEL EQUIPO', $b, 1, 'L');

        $pdf->SetDash(0, 0);

        $table = new easyTable($pdf, '%{13, 20, 14, 20, 13, 20} ', ' line-height:1.2; border-width:0.1; border:1');
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('EQUIPO: '), 'font-style:B');
        $table->easyCell(utf8_decode($equipo), 'align:C');
        $table->easyCell(utf8_decode('MARCA: '), 'font-style:B');
        $table->easyCell(utf8_decode($marca), 'align:C');
        $table->easyCell(utf8_decode('MODELO: '), 'font-style:B');
        $table->easyCell(utf8_decode($modelo), 'align:C');
        $table->printRow();
        $table->endTable(0);
        $table = new easyTable($pdf, '%{13,29,29,29} ', ' line-height:1.2; border-width:0.1; border:1');
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('ESTADO: '), 'font-style:B');
        $table->easyCell(utf8_decode('BUENO'), 'align:C');
        $table->easyCell(utf8_decode('REGULAR'), 'align:C');
        $table->easyCell(utf8_decode('MALO'), 'align:C');
        $table->printRow();

        $table->endTable(0);

        $y = $pdf->GetY() - 5.1;
        $pdf->Image('assets/img/area-checked.png', 50, $y, 4, 4);
        $pdf->Image('assets/img/area-checked.png', 105, $y, 4, 4);
        $pdf->Image('assets/img/area-checked.png', 165, $y, 4, 4);
        switch ($estado_equipo) {
            case 'B':
                $pdf->Image('assets/img/checked.png', 50, $y, 4, 4);
                break;
            case 'R':
                $pdf->Image('assets/img/checked.png', 105, $y, 4, 4);
                break;
            case 'M':
                $pdf->Image('assets/img/checked.png', 165, $y, 4, 4);
                break;
        }


        $pdf->SetFont('Arial', 'B');
        $pdf->Cell(5, 8, '', 0, 0, 'L');
        $pdf->Cell(105, 8, '4.DEFECTOS REPORTADOS', 0, 1, 'L');
        $pdf->SetFont('Arial', '');

        $table = new easyTable($pdf, '%{15,85} ', ' line-height:1.2; border-width:0.1; border:1');
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('TIPO DEFECTO: '), 'font-style:B;width:15;border:TLB');
        $table->easyCell(utf8_decode($tipo_def), 'border:TRB');
        $table->printRow();
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('OTROS: '), 'font-style:B;width:15;border:TLB');
        $table->easyCell(utf8_decode($descripcion), 'border:TRB');
        $table->printRow();
        $table->endTable(0);

        $pdf->SetFont('Arial', 'B');
        $pdf->Cell(5, 8, '', 0, 0, 'L');
        $pdf->Cell(105, 8, utf8_decode('5.REVISIÓN'), 0, 1, 'L');
        $pdf->SetFont('Arial', '');


        $table = new easyTable($pdf, '%{21, 29, 14, 11, 14, 11} ', ' line-height:1.2; border-width:0.1; border:1');
        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode('TIPO MANTENIMIENTO: '), 'font-style:B;width:15;border:TLRB');
        $table->easyCell(utf8_decode($tipo_mantenimiento == 'C' ? 'CORRECTIVO' : 'PREVENTIVO'), 'border:TRB');
        $table->easyCell(utf8_decode('FECHA INICIO:'), 'font-style:B;border:TB');
        $table->easyCell(utf8_decode($fecha_ini), 'border:TRB');
        $table->easyCell(utf8_decode('FECHA FIN:'), 'font-style:B;border:TB');
        $table->easyCell(utf8_decode($fecha_fin), 'border:TRB');
        $table->printRow();
        $table->endTable(5);

        $pdf->SetDash(0.2, 0.6);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 6, utf8_decode('DESCRIPCIÓN DEFECTO'), 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);


        $table = new easyTable($pdf, '%{100}', ' line-height:1.2; border-width:0.1; border:0;font-size:8;');

        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode($defecto), 'rowspan:7;border:1;valign:T');
        $table->printRow();

        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();

        $table->endTable();



        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 6, utf8_decode('DESCRIPCIÓN SOLUCIÓN'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9);

        $table = new easyTable($pdf, '%{100}', ' line-height:1.2; border-width:0.1; border:0;font-size:8;');

        $table->rowStyle('font-style:;paddingX:2');
        $table->easyCell(utf8_decode($solucion), 'rowspan:7;border:1;valign:T');
        $table->printRow();

        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();
        $table->easyCell('');
        $table->printRow();

        $table->endTable(1);

        $y = $pdf->GetY() + 30;

        $pdf->SetXY(10, $y);
        $y = $pdf->GetY();
        $pdf->Cell(63, 6, 'FIRMA SOLICITANTE', 0, 0, 'C');
        $pdf->Cell(63, 6, 'FIRMA TECNICO', 0, 0, 'C');
        $pdf->Cell(63, 6, 'FIRMA ENCARGADO', 0, 1, 'C');
        $pdf->Line(20, $y, 63, $y);
        $pdf->Line(85, $y, 125, $y);
        $pdf->Line(145, $y, 190, $y);

        $pdf->SetXY(10, 251.5);

        $table = new easyTable($pdf, '%{13,87} ', ' width:195; font-size:7;border:0');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;');
        $table->easyCell(utf8_decode('Codigo documento: '));

        $table->printRow();
        $table->endTable(0);

        $name = uniqid();
        $ruta = 'uploads/archivos/' . $name . '.pdf';
        $pdf->Output('F', $ruta);

        $hash = hash_file('sha256', $ruta);

        if ($res = $this->q->verifyExist('m_multimedia_form_mantenimiento', $hash)) {
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
        $pdf->SetY(252.5);
        $pdf->Cell(26, 3, '', 0, 0, 'C');
        $pdf->Cell(160, 3, $hash, 0, 1, 'L');

        unlink($ruta);

        $pdf->Output('F', $ruta);

        $this->session->set_userdata('name', $name);
        $this->guardaMultimedia($name, $ruta, $hash, $id);
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
        $this->q->insertarTabla('m_multimedia_form_mantenimiento', ['id_formulario' => $id, 'id_multimedia' => $idMultimedia]);
    }
}
