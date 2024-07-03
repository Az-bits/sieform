<form id="formulario_modal" method="post" action="<?= base_url(Hasher::make(82)) ?>">
    <div class="row d-flex container">
        <input type="hidden" id="id_formulario" name="id_formulario">
        <h4>1. Datos Solicitante</h4>
        <div class="col-md-12 mt-2" id="person">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">

                        <label for="ci">Buscar por Nr. CI</label>
                        <input type="text" class="form-control input-reset" id="ci" name="ci" placeholder="Cedula Identidad">
                        <small class="text-danger" id="message"></small>
                        <input type="hidden" class="form-control" name="idpersona">
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
                        <label for="email">Correo</label>
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

        <h4 class="mt-2">2. Datos Técnico</h4>
        <div class="col-md-12 mt-2" id="person2">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group fl">
                        <label for="ci2">Buscar por Nr. CI</label>
                        <input type="text" class="form-control " id="ci2" name="ci2" placeholder="Cedula Identidad">
                        <input type="hidden" class="form-control" name="idpersona2">
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
        </div>
        <h4 class="mt-2">3. Operación</h4>
        <div class="col-lg-12" style="padding-right: 0;">
            <div class="row mt-2" id="sistemas">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sistema">Sistema <span class="az-r">( * )</span></label>
                        <select class="selectpicker" data-style="btn btn-primary btn-round" data- title="Seleccione" name="id_sistema" id="sistema"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="ci">Acciones</label>
                </div>
            </div>
            <div class="row mt-2" id="operaciones">
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 mt-2">
                    <div class="form-group">
                        <label for="obs ">Observaciones </label>
                        <textarea name="observaciones" id="obs" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
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