<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<!-- <meta http-equiv="content-type" content="text/html;charset=utf-8" />/Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <meta charset="{charset}" />
    <link rel="icon" type="image/png" href="{theme_url}assets/img/sieof.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{pagetitle}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->
    <link rel="stylesheet" type="text/css" href="{theme_url}assets/css/css.css" />
    <link rel="stylesheet" href="<?= base_url('assets/frontend/educomp/v2.1/css/font-awesome.min.css') ?>">
    <link rel="shortcut icon" href="https://previews.123rf.com/images/annsunnyday/annsunnyday1205/annsunnyday120500006/13747191-casquillo-de-la-graduaci%C3%B3n-negro-birrete-y-el-diploma-de-pergamino-hecho-con-malla-de-degradado.jpg" />
    <!-- CSS Files -->
    <link href="{theme_url}assets/css/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
    <link href="{theme_url}assets/css/animate.css" rel="stylesheet" />
    <link href="<?= base_url('assets/backend/css/global.styles.css') ?>" rel="stylesheet" />
    <link href="{theme_url}plugins/formvalidation/dist/css/formValidation.min.css" rel="stylesheet" />
    <link href="{theme_url}assets/demo/demo.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css" /> -->

    <style>
        .sidebar .nav i {

            color: #00bcd2;
        }

        .sidebar .logo .simple-text {

            color: #00bcd2;

        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: rgb(156, 39, 176);
        }
    </style>

    <script src="{theme_url}assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="{theme_url}assets/js/plugins/jquery.autocomplete.min.js"></script>

</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="rose" data-background-color="black" data-image="{theme_url}assets/img/sidebar-2.jpg">
            <div class="logo">
                <a href="">
                    <img src="{theme_url}assets/img/sieof.png" alt="" width="120" height="100">
                </a>
                <!-- <a href="<php echo site_url(Hasher::make(20)) ?>" class="simple-text logo-mini">
                    SIE
                </a>
                <a href="#" class="simple-text logo-normal">{sistema}</a> -->
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img style="background-color: white;" src="<?= base_url('assets/backend/material-dashboard/assets/img/faces/persona.jpg') ?>" />
                    </div>
                    <div class="user-info">
                        <a data-toggle="collapse" href="#collapseExample" class="username">
                            <span>
                                {user_fullname}
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <?php $dato = $this->ion_auth->user()->row(); ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(Hasher::make(6, $dato->id)); ?>">
                                        <span class="sidebar-mini"> AC </span>
                                        <span class="sidebar-normal"> Administrar Contraseña </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url(Hasher::make(3)); ?>">
                                        <span class="sidebar-mini"> S </span>
                                        <span class="sidebar-normal"> Salir </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item <?= 'Menu' == $title ? 'active' : '' ?> ">
                        <a class="nav-link" href="<?= site_url(Hasher::make(20)) ?>">
                            <i class="material-icons">home</i>
                            <p> Menú </p>
                        </a>
                    </li>
                    {menu}
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            {header}
            <!-- End Navbar -->

            <div class="content">
                <div class="content">
                    <div class="container-fluid" id="main">
                        {content}
                    </div>

                </div>

            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <!-- <ul>
                        <li>
                            <a href="https://www.creative-tim.com/"> Creative Tim </a>
                        </li>
                    </ul> -->
                </nav>
                <div class="copyright float-right">
                    UPEA &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , Desarrollado con <i class="material-icons">favorite</i> por <a href="https://edar.bo/" target="_blank">Dev. Edwin Alanoca Ramirez</a> para una mejor web.
                </div>
            </div>
        </footer>
    </div>





    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog "> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Filters</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger active-color">
                        <div class="badge-colors ml-auto mr-auto">
                            <span class="badge filter badge-purple" data-color="purple"></span>
                            <span class="badge filter badge-azure" data-color="azure"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-warning" data-color="orange"></span>
                            <span class="badge filter badge-danger" data-color="danger"></span>
                            <span class="badge filter badge-rose active" data-color="rose"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>


                <li class="header-title">Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="ml-auto mr-auto">
                            <span class="badge filter badge-black active" data-background-color="black"></span>
                            <span class="badge filter badge-white" data-background-color="white"></span>
                            <span class="badge filter badge-red" data-background-color="red"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>

                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger">
                        <p>Sidebar Mini</p>
                        <label class="ml-auto">
                            <div class="togglebutton switch-sidebar-mini">
                                <label>
                                    <input type="checkbox">
                                    <span class="toggle"></span>
                                </label>
                            </div>
                        </label>
                        <div class="clearfix"></div>
                    </a>
                </li>

                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger">
                        <p>Sidebar Images</p>
                        <label class="switch-mini ml-auto">
                            <div class="togglebutton switch-sidebar-image">
                                <label>
                                    <input type="checkbox" checked="">
                                    <span class="toggle"></span>
                                </label>
                            </div>
                        </label>
                        <div class="clearfix"></div>
                    </a>
                </li>

                <li class="header-title">Images</li>

                <li class="active">
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="{theme_url}assets/img/sidebar-1.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="{theme_url}assets/img/sidebar-2.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="{theme_url}assets/img/sidebar-3.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="{theme_url}assets/img/sidebar-4.jpg" alt="">
                    </a>
                </li>
                <li class="button-container text-center">
                    <br>
                </li>
            </ul>
        </div>
    </div>
    <!--   Core JS Files   -->
    <!-- <script src="{theme_url}assets/js/core/jquery.min.js" type="text/javascript"></script> -->
    <script src="{theme_url}assets/js/plugins/jquery.dataTables.min.js"></script>

    <script src="{theme_url}assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{theme_url}assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>

    <script src="{theme_url}assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <!-- Plugin for the momentJs  -->
    <script src="{theme_url}assets/js/plugins/moment.min.js"></script>

    <!--  Plugin for Sweet Alert -->
    <script src="{theme_url}assets/js/plugins/sweetalert2.js"></script>

    <!-- Forms Validations Plugin -->
    <script src="{theme_url}assets/js/plugins/jquery.validate.min.js"></script>

    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{theme_url}assets/js/plugins/jquery.bootstrap-wizard.js"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{theme_url}assets/js/plugins/bootstrap-selectpicker.js"></script>

    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{theme_url}assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->


    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{theme_url}assets/js/plugins/bootstrap-tagsinput.js"></script>

    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{theme_url}assets/js/plugins/jasny-bootstrap.min.js"></script>

    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{theme_url}assets/js/plugins/fullcalendar.min.js"></script>

    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{theme_url}assets/js/plugins/jquery-jvectormap.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{theme_url}assets/js/plugins/nouislider.min.js"></script>

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <!-- <script src="{theme_url}cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> -->

    <!-- Library for adding dinamically elements -->
    <script src="{theme_url}assets/js/plugins/arrive.min.js"></script>


    <!--  Google Maps Plugin    -->

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script> -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <!-- <script async defer src="{theme_url}buttons.github.io/buttons.js"></script> -->


    <!-- Chartist JS -->
    <script src="{theme_url}assets/js/plugins/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="{theme_url}assets/js/plugins/bootstrap-notify.js"></script>





    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{theme_url}assets/js/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{theme_url}assets/demo/demo.js"></script>
    <!-- Sharrre libray -->
    <script src="{theme_url}assets/demo/jquery.sharrre.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script> -->


    <script src="{theme_url}assets/demo/jquery.sharrre.js"></script>

    <!-- <script src="{theme_url}plugins/formvalidation/dist/js/FormValidation.min.js"></script>
  <script src="{theme_url}plugins/formvalidation/dist/js/locales/es_ES.js"></script>
  <script src="{theme_url}plugins/formvalidation/dist/js/plugins/Tachyons.min.js"></script> -->

    <script src="<?= base_url('assets/backend/js/global.script.js') ?>"></script>
    <script src="<?= base_url('assets/backend/js/test.js') ?>"></script>
    <?php if ($data['page']) : ?>
        <script src="<?= base_url('assets/backend/js/{page}/index.js') ?>" type="module"></script>
    <?php endif ?>
    <script src="<?= base_url('assets/backend/js/components/alerts.js') ?>"></script>

    <!-- Sharrre libray -->
</body>

</html>