<div id="url_data_form" data-url="<?= base_url(Hasher::make(200)) ?>"></div>
<div id="uv" data-url="<?= base_url(Hasher::make(202)) ?>"></div>
<section class="page-header">
    <div class="container">
        <h1 class="heading">Mantenimiento y Soporte</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="#">Mantenimiento y Soporte</a></li>
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
                    <h4>1. Datos Solicitante</h4>
                    <div class="col-12 mt-2" id="person">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="ci">Cédula de Identidad</label>
                                    <input class="form-control" type="text" name="ci" id="ci">
                                    <input type="hidden" id="idpersona" name="idpersona">
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
                                    <label for="aor">Area de origen</label>
                                    <input type="text" id="aor" name="area_origen" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>2. Datos del equipo</h4>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="ite">Equipo <span class="text-danger text-bold">( * )</span></label><br>
                                    <select class="form-control w-auto d-inline-block" name="id_tipo_equipo" id="ite">
                                        <option>31</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="marcas">Marca</label><br>
                                    <select class="form-control w-auto d-inline-block" name="id_marca_equipo" id="marcas"></select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="modelos">Modelo</label><br>
                                    <select class="form-control w-auto d-inline-block" name="id_modelo_equipo" id="modelos"></select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado equipo</label><br>
                                    <div id="estado"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>3. defectos reportados por solicitante</h4>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ide">Defecto <span class="font-weight-bold">( * )</span></label><br>
                                    <select class="form-control w-auto d-inline-block" name="id_defecto" id="ide">
                                    </select>
                                    <!-- <button type="button" class="clear" id="clear" data-toggle="tooltip" data-placement="top" title="quitar elección">x</button> -->
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="otros">Otros</label>
                                    <input type="text" id="otros" name="descripcion" class="form-control">
                                </div>
                            </div>
                        </div>
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


            </form>
        </div>
    </div>
</section>

<!-- Subscribe Modal -->
<div class="modal fade" id="modal_ci" data-open-onload="false" data-open-delay="500" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
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