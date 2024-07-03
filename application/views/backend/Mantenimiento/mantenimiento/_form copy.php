<!-- <= form_open(current_url()); ?> -->
<form id="modal_form" method="post" action="<?= base_url(Hasher::make(72)) ?>">
    <div class="row d-flex container">
        <input type="hidden" id="id_formulario_mantenimiento" name="id_formulario_mantenimiento">
        <h4>1. Datos Solicitante</h4>
        <div class="col-12 mt-2" id="person">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group fl">
                        <label for="ci">Buscar por Nr. CI</label>
                        <input type="text" class="form-control input-reset" id="ci" name="ci" placeholder="Cedula Identidad">
                        <span id="valid_sol" class="text-danger az-text-s"></span>
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
                        <span id="valid_tec" class="text-danger az-text-s"></span>
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
    let inputCI = document.getElementById('ci');
    let inputCI2 = document.getElementById('ci2');

    function searchByCI(ci, foco = '') {
        $.post("<?= base_url(Hasher::make(77)) ?>", {
                ci,
                foco
            },
            function(r) {
                var r = eval(r)[0];
                console.log(r);
                if (r[0] !== 0) {

                    foco ? $("#valid_tec").empty() :
                        $("#valid_sol").empty();

                    // !$('#valid_sol')[0].hasChildNodes() ? $('#btnSubmit').prop("disabled", false) : null;
                    $('form#modal_form :input').each(function() {
                        let name = $(this).attr('name');
                        if (r[name]) {
                            $(this).val(r[name]);
                            // if (!(name === 'ci' + foco || name === 'celular' || name === 'email' || name === 'idpersona' || name === 'idpersona2')) document.getElementById(name).disabled = true;
                            if (name === 'nombreCompleto' + foco || name === 'celular2' || name === 'email2') document.getElementById(name).disabled = true;
                        }
                    });
                } else {
                    $('#person' + foco + ' :input').each(function() {
                        !foco ?
                            verify('#valid_sol', 'Solicitante no encontrado.', '#ci') :
                            verify('#valid_tec', 'Tecnico no encontrado.', '#ci2');

                        let name = $(this).attr('name');
                        if (name != 'ci' && name != 'ci2' && name !== undefined) {
                            $(this).val('');
                            $(name).prop("disabled", false);
                        }
                    });
                }
            }
        );
    }
    inputCI.addEventListener("keyup", function() {
        searchByCI(this.value);
    });
    inputCI2.addEventListener("keyup", function() {
        searchByCI(this.value, '2');
    });


    function verify(idText, message, id) {
        if ($(id).val().length > 6) {
            $(idText).empty()
            $(idText).append(message);
        } else {
            $(idText).empty()
        }

    }
    $('#clear').click(function() {
        $('#ide').val('').trigger('change');
    });
</script>