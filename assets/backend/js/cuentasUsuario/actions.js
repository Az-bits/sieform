let res, url, item;

export function getDatosParaFormulario(data) {
    operaciones(data.operaciones);
    sistemas(data.sistemas);
}

function operaciones(data) {
    item = ``;
    data.map(d => {
        item += `
        <div class="col-md-3">
            <div class="form-check">
                <div class="row az-checkbox">
                    <div class="col-lg-12 az-col justify-content-between">
                        <div class="form-group">
                            <label class="form-check-label">
                                ${d.operacion} <input name="operaciones[${d.tag}]" class="form-check-input" type="checkbox" value="${d.id_tipo_operacion}">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div >
                </div >
            </div >
        </div >
        `

    });
    $('#operaciones').empty();
    $('#operaciones').append(item);
}

function sistemas(data) {
    var opt = '';
    data.map((d) => {
        opt += `<option value="${d.id_sistema}" >${d.sistema}</option>`;
    })
    $('#sistema').empty();
    $('#sistema').append(opt).selectpicker('refresh');;
}
function limpiar(item, name = null) {
    $(item).val('');
    name !== 'ci2' && $(item).prop('disabled', true);
}