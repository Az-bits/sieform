<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');

use setasign\Fpdi\Fpdi;

class RedesPDF extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fpdf/FPDF');
        // $this->load->library('FPDI');
        $this->load->model('RedesModel', 'r');
        $this->load->model('Querys', 'q');
        require_once(APPPATH . 'libraries\easy-table\exfpdf.php');
        require_once(APPPATH . 'libraries\easy-table\easyTable.php');
        require_once(APPPATH . 'libraries\fpdi\src\autoload.php');
    }
    public function index()
    {
        $id = $this->input->get('id');
        if (!$data = $this->r->getDataForReport($id)) {
            redirect(site_url(Hasher::make(60)));
        }

        $data = $this->r->getDataForReport($id);
        $dataFull = $this->r->getDefectorForReport($id);
        $dataFull['prosc'] = $this->r->getProcedimientosRedes();
        $dataFull['mat'] = $this->r->getMaterialUpea();

        $this->pdf($id, $data, $dataFull);
        redirect(site_url(Hasher::make(31)));
    }
    public function getPos($data, $field)
    {
        return array_search($field, array_column($data, 'tag')) !== false ? array_search($field, array_column($data, 'tag')) : null;
    }
    public function pdf($id, $data, $dataFull)
    {
        $pdf = new exFPDF('P', 'mm', 'Letter');


        $nombre = $data->nombreCompleto;
        $celular = $data->celular;
        $unidad = $data->unidad;
        $log = $data->soporte_nivel_logico;
        $fis = $data->soporte_nivel_fisico;
        $dataDefArray = empty($dataFull['defectos']) ?  ['empty'] : $dataFull['defectos'];
        $descripcion = $data->descripcion;
        $checkProArray = array_column($dataFull['prosc'], 'tag');
        $dataProArray = empty($dataFull['procedimientos']) ?  ['empty'] : $dataFull['procedimientos'];
        $checkMatArray = array_column($dataFull['mat'], 'tag');
        $dataMatArray = empty($dataFull['materiales']) ?  ['empty'] : array_column($dataFull['materiales'], 'tag');
        $cantidad = empty($dataFull['materiales']) ?  ['empty'] : $dataFull['materiales'];


        $observaciones = $data->observaciones;
        $met = $dataFull['materiales'][$this->getPos($dataFull['materiales'], 'cable_utp_c6')]['cantidad'] ?? null;
        $co4U = $dataFull['materiales'][$this->getPos($dataFull['materiales'], 'conec_rj45_c6')]['cantidad'] ?? null;
        $co1U = $dataFull['materiales'][$this->getPos($dataFull['materiales'], 'conec_rj11')]['cantidad'] ?? null;
        $jU = $dataFull['materiales'][$this->getPos($dataFull['materiales'], 'jack_rj45_c6')]['cantidad'] ?? null;
        $cU = $dataFull['materiales'][$this->getPos($dataFull['materiales'], 'capuchones')]['cantidad'] ?? null;
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
        $pdf->Cell(0, 5, utf8_decode('SOPORTE DE INFRAESTRUCTURA DE RED DE DATOS Y COMUNICACIÓN'), 0, 1, 'C');
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

        $pdf->SetDash(0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 6, utf8_decode('UNIDAD/DIRECCIÓN/CARRERA:'), $b, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(145, 6, utf8_decode($unidad), $b, 1, 'L');

        $pdf->SetDash(0.2, 0.6);
        $pdf->Line(61, 43, 206, 43);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(10, 7, '', 0, 0, 'L');
        $pdf->Cell(185, 7, '1.1  DEFECTOS REPORTADOS POR EL SOLICITANTE.', $b, 1, 'L');

        $pdf->SetDash(0, 0);

        $table = new easyTable($pdf, '%{33, 33, 34} ', 'width:195; bgcolor:#000; line-height:1.6; border-width:0.1; border:1; border-color:#000;font-size:7.5');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;paddingX:6');
        $table->easyCell(utf8_decode('Problemas con la red de datos'), 'border:LTR;');
        $table->easyCell(utf8_decode('No puede Ingresar a una página web'), 'border:LTR');
        $table->easyCell(utf8_decode('Red Wifi Inestable'), 'border:LTR');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;paddingX:6');
        $table->easyCell(utf8_decode('El servicio de Internet esta Lento'), 'border:LR');
        $table->easyCell(utf8_decode('Actualización de utilitarios para navegar'), 'border:LR');
        $table->easyCell(utf8_decode('Cambio de contraseña en la red Wifi'), 'border:LR');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;paddingX:6');
        $table->easyCell(utf8_decode('No tiene Internet'), 'border:LRB');
        $table->easyCell(utf8_decode('Problemas con su equipos de computación'), 'border:LRB');
        $table->easyCell(utf8_decode('Soporte para Navegar en la Red de datos'), 'border:LRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0');
        $table->easyCell(utf8_decode('Observaciones: ' . $descripcion), 'colspan:3');
        $table->printRow();
        $table->endTable(0);

        $pdf->SetDash(0.2, 0.6);
        $pdf->Line(32, 76.5, 205, 76.5);

        $x = 12;
        $y = 52;
        $checkDefArray = ['prd', 'nipw', 'rwi', 'sil', 'aun', 'ccrw', 'ni', 'pec', 'snrd'];

        for ($i = 1; $i <= 9; $i++) {
            $pdf->Image('assets/img/' . ((array_search($checkDefArray[$i - 1], $dataDefArray) !== false) ? 'checked' : 'area-checked') . '.png', $x, $y, 4, 4);
            $x += 64.1;
            if ($i % 3 == 0) {
                $x = 12;
                $y += 7;
            }
        }

        $pdf->SetDash(0, 0);

        $pdf->Cell(10, 7, '', 0, 0, 'L');
        $pdf->Cell(185, 7, utf8_decode('1.2  INFORME TÉCNICO (del trabajo realizado)'), 0, 1, 'L');
        $table = new easyTable($pdf, '%{25, 25, 25, 25} ', 'width:195; bgcolor:#000; line-height:1.6; border-width:0.1; border:1; border-color:#000;font-size:8');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;align:{C}');
        $table->easyCell(utf8_decode('Soporte y Mantenimiento de redes a nivel Lógico'), 'border:1;colspan:2;');
        $table->easyCell(utf8_decode('Soporte y Mantenimiento de redes a nivel Físico'), 'border:1;colspan:2;align:C');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;colspan:2;paddingX:6;border:1');
        $table->easyCell(utf8_decode('Preventivo'));
        $table->easyCell(utf8_decode('Correctivo'));
        $table->easyCell(utf8_decode('Preventivo'));
        $table->easyCell(utf8_decode('Correctivo'));
        $table->printRow();
        $table->endTable(0);

        $pdf->Image('assets/img/area-checked.png', 12, 93.8, 4, 4);
        $pdf->Image('assets/img/area-checked.png', 61, 93.8, 4, 4);
        $pdf->Image('assets/img/area-checked.png', 109.5, 93.8, 4, 4);
        $pdf->Image('assets/img/area-checked.png', 158.5, 93.8, 4, 4);

        switch ($log) {
            case 'P':
                $pdf->Image('assets/img/checked.png', 12, 93.8, 4, 4);
                break;
            case 'C':
                $pdf->Image('assets/img/checked.png', 61, 93.8, 4, 4);
                break;
        }
        switch ($fis) {
            case 'P':
                $pdf->Image('assets/img/checked.png', 109.5, 93.8, 4, 4);
                break;
            case 'C':
                $pdf->Image('assets/img/checked.png', 158.5, 93.8, 4, 4);
                break;
        }


        $table = new easyTable($pdf, '%{33, 33, 34} ', 'width:195; bgcolor:#000; line-height:1.6; border-width:0.1; border:1; border-color:#000;font-size:7;paddingX:6');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0');
        $table->easyCell(utf8_decode('Cableado Estructurado'), 'border:LTR;');
        $table->easyCell(utf8_decode('Ponchado cable de red para conector RJ-45'), 'border:LTR');
        $table->easyCell(utf8_decode('Grimpar cable UTP con conectores RJ-45'), 'border:LTR');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0');
        $table->easyCell(utf8_decode('Grimpar cable UTP con conectores RJ-11'), 'border:LR');
        $table->easyCell(utf8_decode('Armado de Rosetas para conectores RJ-11'), 'border:LR');
        $table->easyCell(utf8_decode('Instalación de Sistema Operativo(Windows)'), 'border:LR');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0');
        $table->easyCell(utf8_decode('Instalación de office y utilitarios'), 'border:LRB');
        $table->easyCell(utf8_decode('Antivirus'), 'border:LRB');
        $table->easyCell(utf8_decode('Otros'), 'border:LRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0');
        $table->printRow();
        $table->endTable(0);

        $x = 12;
        $y = 100;
        for ($i = 1; $i <= 9; $i++) {
            $pdf->Image('assets/img/' . ($checkProArray[$i - 1] == $dataProArray[array_search($checkProArray[$i - 1], $dataProArray)] ? 'checked' : 'area-checked') . '.png', $x, $y, 4, 4);
            $x += 64.6;
            if ($i % 3 == 0) {
                $x = 12;
                $y += 6.9;
            }
        }

        $pdf->Cell(10, 7, '', 0, 0, 'L');
        $pdf->Cell(185, 7, utf8_decode('1.3  MATERIAL IMPLEMENTADO.'), 0, 1, 'L');

        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $table = new easyTable($pdf, '%{30, 20,50} ', 'width:195; bgcolor:#000; line-height:1.2; border-width:0.1; border:1; border-color:#000;font-size:7;paddingX:6;align:L;');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Cable de Red UTP-Cat.6'), ';border:LTB');
        $table->easyCell(utf8_decode($met ? $met . ' Mts.' : ''), 'align:C;border:TRB');
        $table->easyCell(utf8_decode('Observaciones: ' . $observaciones), 'rowspan:7;valign:T;paddingX:2;');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Conectores RJ-45 Cat.6'), ';border:LTB');
        $table->easyCell(utf8_decode($co4U ? $co4U . ' Unid.' : ''), 'align:C;border:TRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Conectores RJ-11'), ';border:LTB');
        $table->easyCell(utf8_decode($co1U ? $co1U . ' Unid.' : ''), 'align:C;border:TRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Jack para RJ-45 Cat.6'), ';border:LTB');
        $table->easyCell(utf8_decode($jU ? $jU . ' Unid.' : ''), 'align:C;border:TRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Capuchones'), ';border:LTB');
        $table->easyCell(utf8_decode($cU ? $cU . ' Unid.' : ''), 'align:C;border:TRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Cintas Adhesivas'), ';border:LTB');
        $table->easyCell(utf8_decode(''), ';border:TRB');
        $table->printRow();
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;border:1;');
        $table->easyCell(utf8_decode('Otros'), ';border:LTB');
        $table->easyCell(utf8_decode(''), ';border:TRB');
        $table->printRow();

        $table->endTable(0);

        $y = 126.5;
        for ($i = 1; $i <= 7; $i++) {
            $pdf->Image('assets/img/' . ($checkMatArray[$i - 1] == $dataMatArray[array_search($checkMatArray[$i - 1], $dataMatArray)] ? 'checked' : 'area-checked') . '.png', 12, $y, 4, 4);
            $y += 5.4;
        }

        $pdf->Cell(5, 7, '', 0, 0, 'L');
        $pdf->Cell(190, 7, '2. CONFORMIDAD DE SERVICIO POR EL SOLICITANTE.', 0, 1, 'L');
        $pdf->Cell(175, 7, 'Fecha: ', 0, 0, 'R');
        $pdf->Cell(20, 7, $fecha_fin, 0, 1, 'R');

        $y = $pdf->GetY();

        $pdf->SetY($y + 40);

        $table = new easyTable($pdf, '%{50,50} ', ' width:195; bgcolor:#000; line-height:1.2; border-width:0.1; border:0; border-color:#000;font-size:7;paddingX:6;align:{C};');
        $table->rowStyle('bgcolor:#fff; font-style:B; font-color:#000; min-height:0;');
        $table->easyCell(utf8_decode('CONFORMIDAD DEL (SOLICITANTE)'));
        $table->easyCell(utf8_decode('TECNICO UNIDAD SIE (TÉCNICO S.I.E.)'), 'align:C');
        $table->printRow();


        $table->endTable(20);

        $pdf->SetDash(0.2, 0.6);
        $pdf->Line(32, $y + 40, 89, $y + 40);
        $pdf->Line(128, $y + 40, 186, $y + 40);

        /**
         * end::Contenido
         */
        /**
         * init::footer
         */


        $table = new easyTable($pdf, '%{100} ', ' width:195; font-size:7');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;');
        $table->easyCell(utf8_decode('NOTA: La Unidad no se hará responsable de la información o datos, estos deberán ser resguardados por el solicitante en la Unidad'));
        $table->printRow();
        $table->endTable(0);

        $table = new easyTable($pdf, '%{13,87} ', ' width:195; font-size:7;border:0');
        $table->rowStyle('bgcolor:#fff; font-style:; font-color:#000; min-height:0;');
        $table->easyCell(utf8_decode('Codigo documento: '));

        $table->printRow();
        $table->endTable(0);

        /**
         * end::footer
         */

        $name = uniqid();
        $ruta = 'uploads/archivos/' . $name . '.pdf';
        $pdf->Output('F', $ruta);

        $hash = hash_file('sha256', $ruta);

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
        $pdf->SetY(248.5);
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
        $this->q->insertarTabla('r_multimedia_redes', ['id_formulario' => $id, 'id_multimedia' => $idMultimedia]);
    }
}
