<!-- <= form_open(current_url()); ?> -->
<form id="formulario_modal" method="post" action="<?= base_url(Hasher::make(72)) ?>">
    <div class="row d-flex container">
        <input type="hidden" id="id_formulario" name="id_formulario">
        <h4>1. Datos Solicitante</h4>
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
                        <label for="aor">Area de origen</label>
                        <input type="text" id="aor" name="area_origen" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <h4 class="mt-2">Datos técnico</h4>
        <div class="col-12 mt-2" id="person2">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group fl">
                        <label for="ci2">Buscar por Nr. CI</label>
                        <input type="text" class="form-control " id="ci2" name="ci2" placeholder="Cedula Identidad">
                        <input type="hidden" class="form-control" id="idpersona2" name="idpersona2">
                        <small class="text-danger" id="message"></small>
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
        </div>
        <h4>2. datos del equipo</h4>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="ite">Equipo <span class="az-r">( * )</span></label>
                        <select class="selectpicker" data-style="btn btn-primary btn-round" data- title="Seleccione" name="id_tipo_equipo" id="ite"></select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Marca</label>
                        <select class="selectpicker" data-style="btn btn-primary btn-round" data- title="Seleccione" name="id_marca_equipo" id="marcas"></select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Modelo</label>
                        <select class="selectpicker" data-style="btn btn-primary btn-round" data- title="Seleccione" name="id_modelo_equipo" id="modelos"></select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Estado equipo</label>
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
                        <label for="ide">Defecto ( * )</label>
                        <div class="az-area">
                            <select class="selectpicker" data-style="btn btn-primary btn-round" title="Seleccione" name="id_defecto" id="ide">
                            </select>
                            <button type="button" class="clear" id="clear" data-toggle="tooltip" data-placement="top" title="quitar elección">x</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="">Otros</label>
                        <input type="text" id="" name="descripcion" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <h4>4. revision</h4>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tipo_man">Tipo mantenimiento</label>
                        <select class="selectpicker" data-style="btn btn-primary btn-round" data-title="Seleccione" name="tipo_mantenimiento" id="tipo_man">
                            <option value="C">Correctivo</option>
                            <option value="P">Preventivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="f_i">Fecha Ini</label>
                        <input type="text" id="f_i" name="fecha_ini" class="form-control datepicker" placeholder="mm-dd-aaaa">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="f_f">Fecha Fin</label>
                        <input type="text" id="f_f" name="fecha_fin" class="form-control datepicker" placeholder="mm-dd-aaaa">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="def">Descripcion defecto</label>
                        <textarea name="defecto" id="def" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    </iv>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="def">Descripcion solución</label>
                        <textarea name="solucion" id="def" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    </iv>
                </div>
            </div>
        </div>
        <div class="col-12">
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
        minChars: 1,
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
        minChars: 1,
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