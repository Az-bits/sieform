<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Rutas del proyecto sin mapeo
 */

$route['default_controller'] = 'Inicio';
$route['login'] = 'auth/login';
//$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['backend'] = 'backend/dashboard';
$route['sali'] = 'auth/logout';
$route['entro'] = 'auth/login';



$route['formularios'] = 'inicio/formularios';
$route['publicaciones'] = 'frontend/formularios/publicaciones';
$route['redes'] = 'frontend/formularios/redes';
$route['software'] = 'frontend/formularios/software';
$route['mantenimiento'] = 'frontend/formularios/mantenimiento';
$route['cuentasUsuario'] = 'frontend/formularios/cuentasUsuario';
$route['reporte'] = 'backend/reportes/ReporteMantenimiento';


require_once APPPATH . "/libraries/Hasher.php";
$route['u/([a-zA-Z0-9]+)'] = function ($hash) {
	return Hasher::callController($hash);
};
