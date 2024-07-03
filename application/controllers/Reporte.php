<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporte extends Frontend
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        $ancho_pagina = 216;
        $alto_pagina = 280;

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', [$ancho_pagina, $alto_pagina]);
        $pdf->AddPage('P', [$ancho_pagina, $alto_pagina]);
        $pdf->Header111();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, '¡Hola, Mundo!');
        $pdf->Output();
    }

    public function index1()
    {

        $ancho_pagina = 216;
        $alto_pagina = 280;

        //Creación de PDF
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', [$ancho_pagina, $alto_pagina]);

        //SACANDO 0 COPIAS
        foreach (range(1, 1) as $i) {

            $pdf->AddPage('P', [$ancho_pagina, $alto_pagina]);

            //margen izquierdo de 54 puntos, un margen superior de 15 puntos y un margen derecho de 15 puntos.
            //$pdf->SetMargins(margen izquierdo, margen superior, margen);
            $pdf->SetMargins(15, 15, 15); // Establecer márgenes de 15 mm en todos los lados
            $pdf->SetAutoPageBreak(true, 5);

            $pdf->Header111();
            //$pdf->Cell(ANCHO, ALTURA,TEXTO, BORDE, SALTO DE LINEA, CENTRADO, FONDO CELDA); 
            // $pdf->Image(site_url('img/upea.jpg'), X, Y,ANCHO, ALTO, 'JPG');
            // $pdf->Image(site_url('img/upea.jpg'), 15, 8, 20, 0, 'JPG');
            // $pdf->Image(site_url('img/ssue-upea-logo.png'), 175, 7, 30, 0, 'PNG');

            $pdf->Ln(5);

            $pdf->SetFont('Arial', 'B', 5);
            $pdf->Cell(30, 5, utf8_decode('PRE AFILIACIÓN SSUE-UPEA'), 0, 0, 'C');

            $pdf->Cell(126);

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(30, 5, 'Numero Solicitud # ' . "1", 0, 1, 'C');




            $pdf->Ln(6);

            $pdf->SetFont('Arial', 'B', 12); // Establecer la fuente en negrita
            // Relleno
            $pdf->SetFillColor(230, 230, 230);
            // Contorno
            $pdf->SetDrawColor(64, 64, 64);
            $pdf->Cell(186, 5, utf8_decode('DATOS PERSONALES:'), 0, 1, 'L'); // Establecer alineación a la izquierda (L)

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Nombre(s)'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("juan"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Apellido Paterno'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("Laura"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Apellido Materno'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("Martinez"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('N° de Cédula de Identidad'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("9205705" . ' ' . "LP"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Celular'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("12345678"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Correo'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("09alanocaramirz200@"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Dirección / Domicilio'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("Por ahi"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('N° de Registro Universitario'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(93, 5, utf8_decode("20019309"), 1, 1, 'L');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(93, 5, utf8_decode('Carrera'), 1, 0, 'L');
            $pdf->SetFont('Arial', '', 8);

            $pdf->Cell(93, 5, utf8_decode("213233"), 1, 1, 'L');

            // $pdf->SetFont('arial', 'B', 8);
            // if ($i == 1) {
            // 	$pdf->SetTextColor(255, 0, 0);
            // 	$pdf->Cell(50, 1, utf8_decode(""), 0, 1, 'R');
            // 	$pdf->SetTextColor(0, 0, 0);
            // } else {
            // 	$pdf->Cell(50, 1, utf8_decode("COPIA " . ($i - 1)), 0, 1, 'R');
            // }

            $pdf->Ln(5);

            $pdf->SetFont('Arial', 'B', 12); // Establecer la fuente en negrita
            $pdf->Cell(186, 5, utf8_decode('DOCUMENTOS PRESENTADOS:'), 0, 1, 'L'); // Establecer alineación a la izquierda (L)

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('DOCUMENTO'), 1, 0, 'L', true); // Agregar celda con relleno
            $pdf->Cell(36, 5, utf8_decode('REVISION'), 1, 1, 'C', true); // Agregar celda con relleno
            $pdf->SetFillColor(230, 230, 230); // Establecer color de relleno (gris claro)


            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('Cédula de Identidad'), 1, 0, 'L');
            // $pdf->Image(site_url('img/logos/cheque.png'), 180, 125, 5, 5, 'PNG');
            $pdf->Cell(36, 5, utf8_decode(''), 1, 1, 'C');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('Matricula Universitaria'), 1, 0, 'L');
            // $pdf->Image(site_url('img/logos/cheque.png'), 180, 130, 5, 5, 'PNG');
            $pdf->Cell(36, 5, utf8_decode(''), 1, 1, 'C');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('Certificado de No Afiliación'), 1, 0, 'L');
            // $pdf->Image(site_url('img/logos/cheque.png'), 180, 135, 5, 5, 'PNG');
            $pdf->Cell(36, 5, utf8_decode(''), 1, 1, 'C');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('AFP Futuro'), 1, 0, 'L');
            // $pdf->Image(site_url('img/logos/cheque.png'), 180, 140, 5, 5, 'PNG');
            $pdf->Cell(36, 5, utf8_decode(''), 1, 1, 'C');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('AFP Prevision'), 1, 0, 'L');
            // $pdf->Image(site_url('img/logos/cheque.png'), 180, 145, 5, 5, 'PNG');
            $pdf->Cell(36, 5, utf8_decode(''), 1, 1, 'C');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(150, 5, utf8_decode('Fotografía'), 1, 0, 'L');
            // $pdf->Image(site_url('img/logos/cheque.png'), 180, 150, 5, 5, 'PNG');
            $pdf->Cell(36, 5, utf8_decode(''), 1, 1, 'C');


            $pdf->Cell(0, 0, '', 0, 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->Ln(0.25);
            /**
             * @param int $numero_fila Contador para definir numeracion en  filas 
             * @param int $limite_rompe_pagina  Rompe la pagina para saltar el contenido a una siguiente pagina
             */

            /**
             * FIN DEL CIERRE DE CONTENIDO
             */
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(145);
            $pdf->Cell(41, 10, utf8_decode('El Alto, ' . date('d-m-Y')), 0, 1, 'R');

            $pdf->Ln(1);
        }

        $pdf->Ln(10);

        $pdf->SetFillColor(255, 255, 255); // Establecer el color de fondo blanco

        $pdf->SetFont('Arial', 'B', 12); // Establecer la fuente en negrita


        $anioActual = date('Y');

        $pdf->MultiCell(186, 5, utf8_decode('Nota:'), 0, 'L', true); // Establecer alineación a la izquierda (L)
        $pdf->SetFont('Arial', '', 12); // Establecer la fuente normal
        $pdf->MultiCell(186, 5, utf8_decode('Mediante el presente formulario de pre afiliación acepto los términos y condiciones según el reglamento interno de S.S.U.E. - UPEA establecido y aprobado y me someto a sus condiciones de los servicios establecidos.'), 0, 'J', false); // Establecer sin relleno (false)

        $pdf->SetFont('Arial', 'B', 12); // Establecer la fuente en negrita

        $pdf->MultiCell(186, 5, utf8_decode('Recomendaciones:'), 0, 'L', true); // Establecer alineación a la izquierda (L)
        $pdf->SetFont('Arial', '', 12); // Establecer la fuente normal
        $pdf->MultiCell(186, 5, utf8_decode('El presente formulario debe remitirse a las oficinas de S.S.U.E. - UPEA, adjuntando en un folder amarillo tamaño oficio los siguientes documentos: Certificado de nacimiento actualizado, Fotocopia de Cédula de Identidad, Matrículas vigentes ' . $anioActual . ' emitidas por Registro y Admisiones, Certificado de no afiliación a corto plazo conforme a normativa (Declaración Jurada) y timbre de 10 Bs.'), 0, 'J', false); // Establecer sin relleno (false)


        $pdf->Ln(20);

        $pdf->Cell(186, 5, '...................................................', 0, 1, 'C'); // celda para número
        $pdf->Cell(186, 5, utf8_decode("Edwin" . ' ' . "Alanoca" . ' ' . "Ramirez"), 0, 1, 'C'); //
        $pdf->Cell(186, 5, utf8_decode('C.I.: ' . "29032323"), 0, 1, 'C'); // celda para CI
        $pdf->Cell(186, 5, utf8_decode('R.U.: ' . "12312313"), 0, 1, 'C'); // celda para CI

        $pdf->Ln(10);

        $fecha_actual = date('Y-m-d'); // Obtener la fecha actual en formato YYYY-MM-DD
        $nombre_pdf = 'Formulario_Pre_Afiliación_' . "123123123" . '_' . $fecha_actual . '_' . "1" . '.pdf';
        $ruta_destino = './uploads/pre_afiliation/' . "123123123" . '/' . $nombre_pdf;

        if (!file_exists($ruta_destino)) {
            $pdf->Output('F', $ruta_destino); // Guardar el archivo en el servidor

            // Guardar el nombre del archivo en la base de datos
        } else {
            // El archivo ya existe, tomar medidas apropiadas
            echo "El archivo ya existe en la ubicación especificada.";
        }

        // Previsualizar el archivo en el navegador
        if (file_exists($ruta_destino)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $nombre_pdf . '"');
            readfile($ruta_destino);

            // // Descargar el archivo
            // header('Content-Type: application/pdf');
            // header('Content-Disposition: attachment; filename="' . $nombre_pdf . '"');
            // readfile($ruta_destino);
        }
    }

    public function Impresion_Formulario()
    {
        // $data['ci'] = $ci;

        $this->data['page_content'] = 'frontend/formularios/vista_impresion_formulario';
        $this->render();
    }
}
