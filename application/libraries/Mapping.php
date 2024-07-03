<?php

class Mapping
{

    public static function map()
    {
        return [
            "1" => "auth@login",
            "2" => "auth@choice",
            "3" => "auth@logout",
            "4" => "auth@logout",
            "5" => "backend/Users@edit",
            "6" => "backend/Password@editas",

            "7" => "home@index",

            ///******RUTAS PROYECTO------------------------------
            "20" => "backend/dashboard@index",
            "21" => "backend/users@index",
            "22" => "backend/groups@index",
            "23" => "backend/maintenance@index",
            "24" => "backend/users@add",
            "25" => "backend/users@export",
            "26" => "backend/groups@edit",
            "27" => "backend/groups@add",
            "28" => "backend/groups@export",
            "29" => "backend/users@buscar_persona",

            //init::routes generic
            "30" => "backend/SoftwareController@buscarPersona",
            "31" => "backend/reportes/lectorPdf@index",

            //end::routes generic

            //init::Software routes

            "40" => "backend/SoftwareController@index",
            "41" => "backend/SoftwareController@nuevo",
            "42" => "backend/SoftwareController@guardarFormulario",
            "43" => "backend/SoftwareController@editar",
            "44" => "backend/SoftwareController@eliminar",
            "45" => "backend/reportes/SoftwarePDF@index",
            "46" => "backend/SoftwareController@estado",
            "50" => "backend/SoftwareController@getFormulariosSoftwareAjax",

            //end::Software routes

            //begin::Redes routes

            "60" => "backend/RedesController@index",
            "61" => "backend/RedesController@nuevo",
            "62" => "backend/RedesController@guardarFormulario",
            "63" => "backend/RedesController@editar",
            "64" => "backend/RedesController@eliminar",
            "65" => "backend/reportes/RedesPDF@index",
            "66" => "backend/RedesController@getFormulariosRedesAjax",
            "67" => "backend/RedesController@estado",

            //end::Redes routes

            //init::mantenimiento routes

            "70" => "backend/MantenimientoController@index",
            "71" => "backend/MantenimientoController@nuevo",
            "72" => "backend/MantenimientoController@guardarFormulario",
            "73" => "backend/MantenimientoController@editar",
            "74" => "backend/MantenimientoController@eliminar",
            "75" => "backend/reportes/MantenimientoPDF@index",
            "76" => "backend/MantenimientoController@getFormulariosMantenimiento",
            "77" => "backend/MantenimientoController@estado",

            "78" => "frontend/Controller_form_mantenimiento@create_form_external",

            //end::mantenimiento routes

            // init::cuentas usuario routes
            "80" => "backend/CuentasUsuarioController@index",
            "81" => "backend/CuentasUsuarioController@nuevo",
            "82" => "backend/CuentasUsuarioController@guardarFormulario",
            "83" => "backend/CuentasUsuarioController@editar",
            "84" => "backend/CuentasUsuarioController@eliminar",
            "85" => "backend/reportes/CuentasUsuarioPDF@index",
            "86" => "backend/CuentasUsuarioController@getFormulariosCuentasUsuarioAjax",
            "87" => "backend/CuentasUsuarioController@estado",
            // end::cuentas usuario routes

            // init::publicación routes
            "90" => "backend/PublicacionController@index",
            "91" => "backend/PublicacionController@nuevo",
            "92" => "backend/PublicacionController@guardarFormulario",
            "93" => "backend/PublicacionController@editar",
            "94" => "backend/PublicacionController@eliminar",
            "95" => "backend/PublicacionController@pdf",
            "96" => "backend/PublicacionController@getPublicacionesAjax",
            "97" => "backend/PublicacionController@estado",
            // end::publicación routes

            //Rutas formularios frontend
            "200" => "frontend/Formularios@getDatosMantenimiento",
            "201" => "frontend/Formularios@guardarFormulario",
            "202" => "frontend/Formularios@buscarPersona",
            "203" => "frontend/Formularios@getDatosRedes",
            "204" => "frontend/Formularios@getPublicaciones",
            "205" => "frontend/Formularios@getPublicacionesSearch",



        ];
    }

    public static function menus()
    {
        $ion = new Ion_auth();
        if ($ion->in_group('members')) {
            $data["members"]["Te perdiste!!!"] = "00000";
        }
        if ($ion->in_group('user')) {
            $data = [];
        }

        if ($ion->in_group('admin')) {
            $data = [
                "Publicaciones" => [
                    "Publicaciones" => "90",
                ],

                "Software" => [
                    "Formularios" => "40",
                ],
                "Redes" => [
                    "Formularios" => "60",
                ],
                "Mantenimiento" => [
                    "Formularios" => "70",
                ],
                "Cuenta Usuarios" => [
                    "Formularios" => "80",
                ],
                "Administración" => [
                    "Usuarios" => "21",
                    "Grupos de usuario" => "22",
                    "Mantenimiento" => "23",
                ],

                // "test" => "40"
            ];
        }
        if ($ion->in_group('mantenimiento')) {
            $data = [
                "Mantenimiento" => [
                    "Solicitudes" => "70",
                    "Revisiónes" => "80",
                ],
            ];
        }

        return $data;
    }

    ////   MENUS DE SANTOS LIMACHI

    public static function icon()
    {
        $vec_iconos = array(
            'dashboard',
            'person',
            'wysiwyg',
            'lan',
            'engineering',
            'input',
            'assignment',
            'notifications',
            'mail_outline',
            'search',
            'place',
            'favorite',
            'image',
            'grid_on',
            'close',
            'done',
            'view_list',

        );
        return $vec_iconos;
    }
}
