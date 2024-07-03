<div id="url_data_form" data-url="<?= base_url(Hasher::make(203)) ?>"></div>
<div id="uv" data-url="<?= base_url(Hasher::make(202)) ?>"></div>
<section class="page-header">
    <div class="container">
        <h1 class="heading">Redes</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="#">Redes</a></li>
        </ul>
    </div>
</section>

<section class="container mt-100 mb-100">
    <h2 class="heading"><span class="text-primary">FORMULARIO</span> DE SOLICITUD</h2>
    <p>Por favor, llenar todos los campos solicitados detallada y cuidadosamente para un procesamiento rápido.</P>
    <!-- En caso de duda, póngase en contacto con nosotros en info@example.com</a></p> -->
    <div class="card">
        <div class="card-body">
            <!-- <= form_open(current_url()); ?> -->
            <form id="formulario_modal" method="post" action="<?= base_url(Hasher::make(201)) ?>">
                <div class="row d-flex container">
                    <input type="hidden" id="id_formulario" name="id_formulario">
                    <h4>Datos Solicitante</h4>
                    <div class="col-12 mt-2" id="person">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group fl">
                                    <label for="ci">Buscar por Nr. CI</label>
                                    <input type="text" class="form-control input-reset" id="ci" name="ci" placeholder="Cedula Identidad">
                                    <input type="hidden" class="form-control" id="idpersona" name="idpersona">
                                    <small class="text-danger" id="message"></small>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nombreCompleto">Nombre Completo</label>
                                    <input type="text" id="nombreCompleto" name="nombreCompleto" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" id="celular" name="celular" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="un">Unidad</label>
                                    <input type="text" id="un" name="unidad" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-2">Defectos Reportados por el solicitante</h4>
                    <div class="col-lg-12" style="padding-right: 0;">
                        <div class="row" id="defectos">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group fl">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <small class="text-warning d-flex align-items-center flex-wrap"><i class="material-icons">warning</i> Verifique los datos antes de
                            guardar. </small>
                    </div>

                    <div class="col-lg-12 mt-2">
                        <div class="d-flex justify-content-between">
                            <button type="submit" id="btnSubmit" class="btn btn-primary d-flex">
                                <div class="load" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <i class="material-icons icon-load"><?= Mapping::icon()[15] ?></i> <span class="btnTextSubmit"> Enviar solicitud</span>
                            </button>
                            <a href="<?= base_url('formularios') ?>" class="btn btn-danger d-flex"><i class="material-icons"><?= Mapping::icon()[14] ?></i> Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Subscribe Modal -->
<div class="modal fade" id="modal_ci" data-open-onload="false" data-open-delay="500" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 nop d-flex align-items-end">
                            <img src="assets/img/mant.jpg" class="img-fluid" alt="" style="height: 100%;">
                        </div>
                        <div class="col-lg-6 pt-40 pb-40">
                            <h4 class="heading">Formulario de <span class="text-primary">Mantenimiento </span></h4>
                            <p>Por favor, ingrese su número de carnet.</p>
                            <form id="formulario_ci">
                                <div class="form-group">
                                    <label>Cédula de Identidad</label>
                                    <input id="ciSearch" type="text" class="form-control" name="ci-search" value="">
                                    <span class="text-danger font-weight-bold" id="messageVerifi" style="font-size: 12px;"></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" id="btnVerificar" class="btn btn-primary d-flex">
                                        <div class="load" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="material-icons icon-load"><?= Mapping::icon()[15] ?></i> <span class="btnTextSubmit"> Enviar solicitud</span>
                                    </button>
                                    <a href="<?= base_url('formularios') ?>" class="btn btn-danger d-flex"><i class="material-icons"><?= Mapping::icon()[14] ?></i> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>