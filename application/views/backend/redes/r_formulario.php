<!-- <= form_open(current_url()); ?> -->
<form id="formulario_modal" method="post" action="<?= base_url(Hasher::make(62)) ?>">
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
        </div>
        <h4 class="mt-2">Datos Técnico</h4>
        <div class="col-lg-12 mt-2">
            <div class="row" id="person2">
                <div class="col-lg-3">
                    <div class="form-group fl">
                        <label for="ci2">Buscar por Nr. CI</label>
                        <input type="text" class="form-control input-reset" id="ci2" name="ci2" placeholder="Cedula Identidad">
                        <input type="hidden" class="form-control" id="idpersona2" name="idpersona2">
                        <small class="text-danger" id="message2"></small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="nombreCompleto2">Nombre Completo</label>
                        <input type="text" id="nombreCompleto2" name="nombreCompleto2" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="celular2">Celular</label>
                        <input type="text" id="celular2" name="celular2" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="email2">Email</label>
                        <input type="text" id="email2" name="email2" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="padding-right: 0;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <h4>Material Utilizado</h4>
                            </div>
                            <div class="row" style="border-right: 1px solid #d2d2d2;">
                                <div class="col-sm-10 checkbox-radios" id="materiales">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <h4>Procedimientos</h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 checkbox-radios" id="procedimientos">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <h5>Soporte y Mantenimiento de redes a nivel Lógico</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 ">
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" data-title="Seleccione" name="soporte_nivel_logico" id="tipo_man">
                                        <option value="C">Correctivo</option>
                                        <option value="P">Preventivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <h5>Soporte y Mantenimiento de redes a nivel Físico</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 ">
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" data-title="Seleccione" name="soporte_nivel_fisico" id="tipo_man">
                                        <option value="C">Correctivo</option>
                                        <option value="P">Preventivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding: 0;">
                        <div class="form-group">
                            <label for="obs ">Observaciones</label>
                            <textarea name="observaciones" id="obs" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="f_i">Fecha Ini</label>
                        <input type="text" id="f_i" name="fecha_ini" class="form-control datepicker" placeholder="mm-dd-aaaa">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="f_f">Fecha Fin</label>
                        <input type="text" id="f_f" name="fecha_fin" class="form-control datepicker" placeholder="mm-dd-aaaa">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-3">
                    <div class="row justify-content-center">
                        <div class="form-group">
                            <button type="button" id="btnCancel" class="btn btn-danger mr-2" data-dismiss=""><i class="material-icons"><?= Mapping::icon()[14] ?></i>{lang_cancel}</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary ">
                                <div class="load" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <i class="material-icons icon-load"><?= Mapping::icon()[15] ?></i> <span class="btnTextSubmit">Crear formulario</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var ci = $("#ci")
    var ci2 = $("#ci2")
    ci.autocomplete({
        serviceUrl: '<?= base_url(Hasher::make(30)) ?>',
        paramName: 'buscarString',
        transformResult: function(response) {
            var res = JSON.parse(response);
            return {
                suggestions: $.map(res, function(r) {
                    return {
                        value: r.ci + ' ' + r.nombreCompleto,
                        idpersona: r.id,
                        ci: r.ci,
                        nombreCompleto: r.nombreCompleto,
                        celular: r.celular,
                        email: r.email

                    };
                })
            };
        },
        minChars: 5,
        onSearchStart: function() {
            $('#person :input').each(function() {
                let name = $(this).attr('name');
                name !== 'ci' && limpiar(this);
            });
            $('#nombreCompleto').prop('disabled', true);
        },
        onSearchComplete: function(e) {
            $('#message').html() === "" ? $('#message').html('Persona no encontrada.') : "";
        },
        onSelect: function(r) {
            $('#message').html('')
            $('form#formulario_modal #person :input').each(function() {
                let name = $(this).attr('name');
                if (r[name]) {
                    $(this).val(r[name]);
                }
            });
            $('#nombreCompleto').prop('disabled', true);
        }

    });
    ci2.autocomplete({
        serviceUrl: '<?= base_url(Hasher::make(30)) ?>',
        paramName: 'buscarString',
        transformResult: function(response) {
            var res = JSON.parse(response);
            return {
                suggestions: $.map(res, function(r) {
                    return {
                        value: r.ci + ' ' + r.nombreCompleto,
                        idpersona2: r.id,
                        ci2: r.ci,
                        nombreCompleto2: r.nombreCompleto,
                        celular2: r.celular,
                        email2: r.email
                    };
                })
            };
        },
        minChars: 5,
        onSearchStart: function() {
            $('#person2 :input').each(function() {
                let name = $(this).attr('name');
                name !== 'ci2' && limpiar(this);
            });
            $('#nombreCompleto2').prop('disabled', true);
        },
        onSearchComplete: function(e) {
            $('#message2').html() === "" ? $('#message2').html('Persona no encontrada.') : "";
        },
        onSelect: function(r) {
            $('#message2').html('')
            $('form#formulario_modal #person2 :input').each(function() {
                let name = $(this).attr('name');
                if (r[name]) {
                    $(this).val(r[name]);
                }
                name !== 'ci2' && name !== 'idpersona2' && $(this).prop('disabled', true);
            });

        }
    });


    ci2.on("keyup", function() {
        ci2.val().length < 5 && $('#message2').html('')
    });
    ci.on("keyup", function() {
        ci.val().length < 5 && $('#message').html('')
    });

    function limpiar(item) {
        $(item).val('');
    }
</script>