<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php if ($this->ion_auth->in_group('admin')) : ?>
    <div class="row">
        <div id="u_data" data-url="<?= base_url(Hasher::make(91)) ?>"></div>
        <div id="ue" data-url="<?= base_url(Hasher::make(93)) ?>"></div>
        <div id="ud" data-url="<?= base_url(Hasher::make(94)) ?>"></div>
        <div id="pdf" data-url="<?= base_url(Hasher::make(95)) ?>"></div>
        <div id="upf" data-url="<?= base_url(Hasher::make(96)) ?>"></div>
        <div id="ues" data-url="<?= base_url(Hasher::make(97)) ?>"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon d-flex justify-content-between">
                    <div class="w-100">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Publicaciones</h4>
                    </div>
                    <button id="nuevo" type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#main_modal">
                        <i class="material-icons">add</i> Nuevo formulario
                    </button>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>

                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="min-w-25">#</th>
                                    <th>Imagen</th>
                                    <th>Publicación</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Visibilidad</th>
                                    <th class="disabled-sorting text-right">{lang_actions}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Imagen</th>
                                    <th>Publicación</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Visibilidad</th>
                                    <th class="disabled-sorting text-right">{lang_actions}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->parser->parse('backend/publicacion/p_modal', [], true); ?>
<?php endif ?>