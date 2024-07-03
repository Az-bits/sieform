<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "libraries/Fpdf/Fpdf.php";

class Pdf  extends FPDF
{

    function __construct()
    {
        parent::__construct();
    }

    function HeaderConclu()
    {
        //$this->Image(base_url('uploads/').'upea.jpg',10,8,20,0,'JPG');
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
        //$this->Cell(80);
        // Título
        $this->Cell(45);
        //$this->Cell(30,10,'Res. 043/98 H.C.U',0,1,'C');
        //$this->Cell(40,20,'    ',1,0,'C');
        $this->AddFont('CopperplateGothic-Bold', '', 'CopperplateGothicBold.php');

        $this->AddFont('EdwardianScriptITC', '', 'edwardian-script-itc.php');
        $this->SetFont('EdwardianScriptITC', '', 30);
        $this->Cell(40);
        $this->Cell(30, 7, utf8_decode('Universidad Pública de El Altos'), 0, 1, 'C');
        $this->Ln(1);
        //        $this->Image('../../uploads/qr_image/'.$GLOBALS['nombre_imagen'],180,8,18);

        $this->SetFont('arial', '', 6);
        $this->Cell(0, 3, utf8_decode('Creada por Ley Nº 2115 de 05 de Septiembre de 2000 y Autónoma por Ley Nº 2556 de 12 de Noviembre de 2003'), 0, 1, 'C');
        $this->SetFont('arial', '', 6);
        $this->Cell(0, 3, utf8_decode('Incorporada al Sistema de la Universidad Boliviana por RESOLUCIÓN Nº 2/09 del XI - CONGRESO NACIONAL DE UNIVERSIDADES '), 0, 1, 'C');
        $this->SetFont('CopperplateGothic-Bold', '', 16);
        // $this->Cell(75);
        //$this->SetFont('arial','B',8);
        $this->Ln(5);
    }
    function CertConcHead()
    {
        $this->Ln(19);
    }
    function CertCalHead()
    {
        $this->AddFont('CopperplateGothic-Bold', '', 'CopperplateGothicBold.php');

        $this->Ln(14);
        $this->SetFont('CopperplateGothic-Bold', '', 16);
        $this->Cell(0, 10, utf8_decode('Formulario de Pre Afiliación SSUE-UPEA'), 0, 0, 'C');
        $this->Ln(5);
    }
    // Cabecera de página
    function Header111()
    {
        $this->Image('assets/img/' . 'upea.jpg', 10, 8, 20, 0, 'JPG');
        $this->Image('assets/img/' . 'sielogo.png', 10, 8, 20, 0, 'JPG');
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
        //$this->Cell(80);
        // Título
        $this->Cell(45);
        //$this->Cell(30,10,'Res. 043/98 H.C.U',0,1,'C');
        //$this->Cell(40,20,'    ',1,0,'C');
        $this->AddFont('CopperplateGothic-Bold', '', 'CopperplateGothicBold.php');
        $this->AddFont('EdwardianScriptITC', '', 'edwardian-script-itc.php');
        $this->SetFont('EdwardianScriptITC', '', 30);
        $this->Cell(40);
        $this->Cell(30, 7, utf8_decode('Universidad Pública de El Altos'), 0, 1, 'C');
        $this->Ln(1);
        //        $this->Image('../../uploads/qr_image/'.$GLOBALS['nombre_imagen'],180,8,18);

        $this->SetFont('arial', '', 6);
        $this->Cell(0, 3, utf8_decode('Creada por Ley Nº 2115 de 05 de Septiembre de 2000 y Autónoma por Ley Nº 2556 de 12 de Noviembre de 2003'), 0, 1, 'C');
        $this->SetFont('arial', '', 6);
        $this->Cell(0, 3, utf8_decode('Incorporada al Sistema de la Universidad Boliviana por RESOLUCIÓN Nº 2/09 del XI - CONGRESO NACIONAL DE UNIVERSIDADES '), 0, 1, 'C');
        $this->SetFont('CopperplateGothic-Bold', '', 16);
        // $this->Cell(75);
        $this->Cell(0, 10, utf8_decode('Formulario'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('de'), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('Pre Afiliación SSUE-UPEA'), 0, 0, 'C');
        //$this->SetFont('arial','B',8);
        $this->Ln(5);

        // Logo

    }
    // Pie de página
    function Footer111()
    {
        // Posición: a 1,5 cm del final
        /* $this->SetY(-15);*/
        // Arial italic 8
        // $this->SetY(-50);
        // $this->SetFont('Arial','I',8);
        // $this->Ln(25);
        // $this->Cell(55,5,utf8_decode('Tec. En Kardex Académico Universitario'),0,0,'C');
        // $this->Cell(45,5,utf8_decode('sello'),0,0,'C');
        // $this->Cell(45,5,utf8_decode('Director(a) de Carrera'),0,0,'C');
        // $this->Cell(45,5,utf8_decode('sello'),0,1,'C');
        // $this->Ln(25);
        // $this->Cell(45,5,utf8_decode('V°B° Decano(a) o Vicerrector(a)'),0,0,'C');
        // $this->Cell(65,5,utf8_decode('sello'),0,1,'C');
        // $this->Image('../barcode/images/'.$GLOBALS['im'],145,null,55);
        //$this->SetY(-60);
        //$this->Image('../barcode/images/'.$GLOBALS['nombre_imagen'],145,null,55);
        $this->SetFont('Arial', '', 6);
        $this->Cell(0, 3, utf8_decode('ADVERTENCIA: Este documento queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.'), 0, 1, 'L');
        // $pdf->Cell();
        $this->Cell(0, 3, utf8_decode('ESCALA DE CALIFICACIONES: 51 a 100 = Aprobado.'), 0, 1, 'L');

        //$this->Cell(55,3 ,utf8_decode('NOTA: Para trámites al exterior el certificado debe estar revisado por Vicerrectorado de la Universidad Pública de El Alto.'),0,1,'C');


    }
    function Footerhash($hash)
    {
        // $hash = hash('crc32',$ci.$correlativo_general);
        $this->SetFont('Arial', '', 6);
        $this->Cell(0, 3, utf8_decode('ADVERTENCIA: Este documento queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.         ESCALA DE CALIFICACIONES: 51 a 100 = Aprobado.'), 0, 1, 'L');
        // $pdf->Cell();
        $this->Cell(0, 3, utf8_decode('Este documento es firmado digitalmente por SIE, el documento digital puede ser verificado en https://validar.firmadigital.bo/  ') . $hash . utf8_decode(' para verificacion y obtencion de copia en http://kardex.upea.bo'), 0, 0, 'L');
        // $this->Cell(20,3,$hash,0,0,'C');
        // $this->Cell(30,3,utf8_decode(' para verificacion y obtencion de copia en http://kardex.upea.bo'),0,0,'L');
    }


    public function HeaderImg()
    {
        $this->ln(-2);
        $this->SetTextColor(0, 51, 102);
        $this->Image('img/upea1.png', 20, 3, 25, 25, 'PNG', '');
        $this->SetTextColor(0, 51, 102);
        $this->SetFont('Arial', 'BI', 23);
        $this->SetFont('monotypecorsiva', 'B', 23);
        $this->Cell(0, 5, ('Universidad Pública de El Alto'), 0, 1, 'C');
        $this->SetFont('Times', 'BI', 8);
        $this->Ln(2);
        $this->Cell(0, 3, ('Creada por Ley Nº 2115 de 05 de Septiembre de 2000'), 0, 1, 'C');
        $this->Cell(0, 3, ('Autónoma por Ley Nº 2556 de 12 de Noviembre de 2003'), 0, 1, 'C');
        $this->Ln(8);
        $this->Cell(0, 3, '', 'T', 1, 'L');
    }

    public function Titulo($Titulo, $Linea1 = '', $Linea2 = '', $Linea3 = '')
    {
        $this->SetFont('Arial', '', 10);
        $this->cell(60, 4, ($Linea1), 0, 1, 'C');
        $this->cell(60, 4, ($Linea2), 0, 1, 'C');
        $this->cell(60, 4, ($Linea3), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 18);
        $this->cell(0, 4, ($Titulo), 0, 1, 'C');
        $this->Ln(2);
    }

    function ClippingRect($x, $y, $w, $h, $outline = false)
    {
        $op = $outline ? 'S' : 'n';
        $this->_out(sprintf(
            'q %.2F %.2F %.2F %.2F re W %s',
            $x * $this->k,
            ($this->h - $y) * $this->k,
            $w * $this->k,
            -$h * $this->k,
            $op
        ));
    }

    function UnsetClipping()
    {
        $this->_out('Q');
    }

    function ClippedCell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        if ($border || $fill || $this->y + $h > $this->PageBreakTrigger) {
            $this->Cell($w, $h, '', $border, 0, '', $fill);
            $this->x -= $w;
        }
        $this->ClippingRect($this->x, $this->y, $w, $h);
        $this->Cell($w, $h, $txt, '', $ln, $align, false, $link);
        $this->UnsetClipping();
    }

    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if ($style == 'F')
            $op = 'f';
        elseif ($style == 'FD' || $style == 'DF')
            $op = 'B';
        else
            $op = 'S';
        $MyArc = 4 / 3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));
        $xc = $x + $w - $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));

        $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);
        $xc = $x + $w - $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
        $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x + $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
        $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);
        $xc = $x + $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $yc) * $k));
        $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf(
            '%.2F %.2F %.2F %.2F %.2F %.2F c ',
            $x1 * $this->k,
            ($h - $y1) * $this->k,
            $x2 * $this->k,
            ($h - $y2) * $this->k,
            $x3 * $this->k,
            ($h - $y3) * $this->k
        ));
    }

    function AjustaCelda($ancho, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true)
    {
        //$txt = utf8_decode($txt);
        $TamanoInicial = $this->FontSizePt;
        $TamanoLetra = $this->FontSizePt;
        $decremento = 0.5;
        while ($this->GetStringWidth($txt) > $ancho)
            $this->SetFontSize($TamanoLetra -= $decremento);
        $this->Cell($ancho, $h, $txt, $border, $ln, $align, $fill, $link, $scale, $force);
        $this->SetFontSize($TamanoInicial);
    }
}