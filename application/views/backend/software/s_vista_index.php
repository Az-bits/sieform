<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php if ($this->ion_auth->in_group('admin')) : ?>
    <div class="row">
        <div id="usf" data-url="<?= base_url(Hasher::make(50)) ?>"></div>
        <div id="ue" data-url="<?= base_url(Hasher::make(43)) ?>"></div>
        <div id="ud" data-url="<?= base_url(Hasher::make(44)) ?>"></div>
        <div id="pdf" data-url="<?= base_url(Hasher::make(45)) ?>"></div>
        <div id="ues" data-url="<?= base_url(Hasher::make(46)) ?>"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon d-flex justify-content-between">
                    <div class="w-100">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Formularios de Software</h4>
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
                                    <th>Solicitante</th>
                                    <th>Técnico</th>
                                    <th>Modulo</th>
                                    <th>Tipo trabajo</th>
                                    <th>Estado</th>
                                    <th class="disabled-sorting text-right">{lang_actions}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Solicitante</th>
                                    <th>Técnico</th>
                                    <th>Modulo</th>
                                    <th>Tipo trabajo</th>
                                    <th>Estado</th>
                                    <th class="disabled-sorting text-right">{lang_actions}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->parser->parse('backend/software/s_modal', [], true); ?>
<?php endif ?>