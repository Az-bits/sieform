<?php

if (!defined('BASEPATH'))
    exit('No tiene acceso a esta pagina');

function fecha_literal($Fecha, $Formato = 2) {
    $dias = array(0 => 'Domingo', 1 => 'Lunes', 2 => 'Martes', 3 => 'Mièrcoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sàbado');
    $meses = array(1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
        7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre');
    $aux = date_parse($Fecha);
    switch ($Formato) {
        case 1:  // 04/10/10
            return date('d/m/y', strtotime($Fecha));
        case 2:  //04/oct/10
            return sprintf('%02d/%s/%02d', $aux['day'], substr($meses[$aux['month']], 0, 3), $aux['year'] % 100);
        case 3:   //octubre 4, 2010
            return $meses[$aux['month']] . ' ' . sprintf('%.2d', $aux['day']) . ', ' . $aux['year'];
        case 4:   // 4 de octubre de 2010
            return $aux['day'] . ' de ' . $meses[$aux['month']] . ' de ' . $aux['year'];
        case 5:   //lunes 4 de octubre de 2010
            $numeroDia= date('w', strtotime($Fecha));
            return $dias[$numeroDia].' '.$aux['day'] . ' de ' . $meses[$aux['month']] . ' de ' . $aux['year'];
        case 6:
            return date('d/m/Y', strtotime($Fecha));
        default:
            return date('d/m/Y', strtotime($Fecha));
    }
}
function grado_nivel($string){
    switch ($string) {
        case '1':
            return "PRIMERO";
        break;
        case '2':
            return "SEGUNDO";
        break;
        case '3':
            return "TERCER";
        break;
        case '4':
            return "CUARTO";
        break;
        case '5':
            return "QUINTO";
        break;
        case '6':
            return "SEXTO";
        break;
        case '7':
            return "SEPTIMO";
        break;
        case '8':
            return "OCTAVO";
        break;
        case '9':
            return "NOVENO";
        break;
        case '10':
            return "DECIMO";
        break;
        
        default:
            return "NO EXISTE";
        break;
    }
}

/* ! 
  @function num2letras ()
  @abstract Dado un n?mero lo devuelve escrito.
  @param $num number - N?mero a convertir.
  @param $fem bool - Forma femenina (true) o no (false).
  @param $dec bool - Con decimales (true) o no (false).
  @result string - Devuelve el n?mero escrito en letra.

 */

function numero_letra($num, $fem = false, $dec = true, $moneda = true) {
    $matuni[2] = "dos";
    $matuni[3] = "tres";
    $matuni[4] = "cuatro";
    $matuni[5] = "cinco";
    $matuni[6] = "seis";
    $matuni[7] = "siete";
    $matuni[8] = "ocho";
    $matuni[9] = "nueve";
    $matuni[10] = "diez";
    $matuni[11] = "once";
    $matuni[12] = "doce";
    $matuni[13] = "trece";
    $matuni[14] = "catorce";
    $matuni[15] = "quince";
    $matuni[16] = "dieciseis";
    $matuni[17] = "diecisiete";
    $matuni[18] = "dieciocho";
    $matuni[19] = "diecinueve";
    $matuni[20] = "veinte";
    $matunisub[2] = "dos";
    $matunisub[3] = "tres";
    $matunisub[4] = "cuatro";
    $matunisub[5] = "quin";
    $matunisub[6] = "seis";
    $matunisub[7] = "sete";
    $matunisub[8] = "ocho";
    $matunisub[9] = "nove";

    $matdec[2] = "veint";
    $matdec[3] = "treinta";
    $matdec[4] = "cuarenta";
    $matdec[5] = "cincuenta";
    $matdec[6] = "sesenta";
    $matdec[7] = "setenta";
    $matdec[8] = "ochenta";
    $matdec[9] = "noventa";
    $matsub[3] = 'mill';
    $matsub[5] = 'bill';
    $matsub[7] = 'mill';
    $matsub[9] = 'trill';
    $matsub[11] = 'mill';
    $matsub[13] = 'bill';
    $matsub[15] = 'mill';
    $matmil[4] = 'millones';
    $matmil[6] = 'billones';
    $matmil[7] = 'de billones';
    $matmil[8] = 'millones de billones';
    $matmil[10] = 'trillones';
    $matmil[11] = 'de trillones';
    $matmil[12] = 'millones de trillones';
    $matmil[13] = 'de trillones';
    $matmil[14] = 'billones de trillones';
    $matmil[15] = 'de billones de trillones';
    $matmil[16] = 'millones de billones de trillones';

    //Zi hack
    $numeroFloat = explode('.', $num);
    $num = $numeroFloat[0];
    
    //exclusiion regis 
    if($num == '0') return 'Cero';

    $num = trim((string) @$num);
    if ($num[0] == '-') {
        $neg = 'menos ';
        $num = substr($num, 1);
    } else
        $neg = '';
    while ($num[0] == '0')
        $num = substr($num, 1);
    if ($num[0] < '1' or $num[0] > 9)
        $num = '0' . $num;
    $zeros = true;
    $punt = false;
    $ent = '';
    $fra = '';
    for ($c = 0; $c < strlen($num); $c++) {
        $n = $num[$c];
        if (!(strpos(".,'''", $n) === false)) {
            if ($punt)
                break;
            else {
                $punt = true;
                continue;
            }
        } elseif (!(strpos('0123456789', $n) === false)) {
            if ($punt) {
                if ($n != '0')
                    $zeros = false;
                $fra .= $n;
            } else
                $ent .= $n;
        } else
            break;
    }
    $ent = '     ' . $ent;
    if ($dec and $fra and !$zeros) {
        $fin = ' coma';
        for ($n = 0; $n < strlen($fra); $n++) {
            if (($s = $fra[$n]) == '0')
                $fin .= ' cero';
            elseif ($s == '1')
                $fin .= $fem ? ' una' : ' un';
            else
                $fin .= ' ' . $matuni[$s];
        }
    } else
        $fin = '';
    if ((int) $ent === 0)
        return 'Cero ' . $fin;
    $tex = '';
    $sub = 0;
    $mils = 0;
    $neutro = false;
    while (($num = substr($ent, -3)) != '   ') {
        $ent = substr($ent, 0, -3);
        if (++$sub < 3 and $fem) {
            $matuni[1] = 'una';
            $subcent = 'as';
        } else {
            $matuni[1] = $neutro ? 'un' : 'uno';
            $subcent = 'os';
        }
        $t = '';
        $n2 = substr($num, 1);
        if ($n2 == '00') {
            
        } elseif ($n2 < 21)
            $t = ' ' . $matuni[(int) $n2];
        elseif ($n2 < 30) {
            $n3 = $num[2];
            if ($n3 != 0)
                $t = 'i' . $matuni[$n3];
            $n2 = $num[1];
            $t = ' ' . $matdec[$n2] . $t;
        }else {
            $n3 = $num[2];
            if ($n3 != 0)
                $t = ' y ' . $matuni[$n3];
            $n2 = $num[1];
            $t = ' ' . $matdec[$n2] . $t;
        }
        $n = $num[0];
        if ($n == 1) {
            $t = ' cien' . $t;
        } elseif ($n == 5) {
            $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
        } elseif ($n != 0) {
            $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
        }
        if ($sub == 1) {
            
        } elseif (!isset($matsub[$sub])) {
            if ($num == 1) {
                $t = ' mil';
            } elseif ($num > 1) {
                $t .= ' mil';
            }
        } elseif ($num == 1) {
            $t .= ' ' . $matsub[$sub] . '&oacute;n';
        } elseif ($num > 1) {
            $t .= ' ' . $matsub[$sub] . 'ones';
        }
        if ($num == '000')
            $mils++;
        elseif ($mils != 0) {
            if (isset($matmil[$sub]))
                $t .= ' ' . $matmil[$sub];
            $mils = 0;
        }
        $neutro = true;
        $tex = $t . $tex;
    }
    $tex = $neg . substr($tex, 1) . $fin;
    //Zi hack --> return ucfirst($tex);
    if (empty($numeroFloat[1]))
        $numeroFloat[1] = ' ';
    $monedaTxt = '';
    if ($moneda)
        $monedaTxt = ' ' . $numeroFloat[1] . '';
    $end_num = ucfirst($tex) . $monedaTxt;
    return $end_num;
}



function formatoFecha($fecha, $tipo = 'latino') {
    switch ($tipo) {
        case 'mysql':
            //el formato va acorde a la fecha como string
            $objetoFecha = DateTime::createFromFormat("d/m/Y", $fecha);
            //el formato ahora es acorde a lo que ocupamos, segun mysql
            $mi_fecha = $objetoFecha->format("Y-m-d");
            break;
            
        case 'mysql_rgs':
            //el formato va acorde a la fecha como string
            $objetoFecha = DateTime::createFromFormat("m/d/Y", $fecha);
            //el formato ahora es acorde a lo que ocupamos, segun mysql
            $mi_fecha = $objetoFecha->format("Y-m-d");
            break;
        
        case 'latino':
            //el formato va acorde a la fecha como string
            $objetoFecha = DateTime::createFromFormat("Y-m-d", $fecha);
            //el formato ahora es acorde a lo que ocupamos, segun mysql
            $mi_fecha = $objetoFecha->format("d-m-Y");
            break;
    }
    
    return ($mi_fecha);

    //imprime 1989-12-19
}

?>