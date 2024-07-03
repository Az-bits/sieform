import { loadInit } from "../components/change.js";
export function inicializarFormulario() {
    getDatosParaFormulario();
    $("#ciSearch").focus(function () {
        $("#messageVerifi").empty();
    });
    $('#modal_ci').modal({
        keyboard: false
    });
}

export function verificarCI(btnVerificar) {
    let url, ci, name;
    ci = $('#ciSearch').val();
    url = $('#uv').data('url');
    loadInit();
    $("#messageVerifi").empty();
    $.get(url, { buscarString: ci })
        .done(function (response) {
            let r = JSON.parse(response);
            loadInit();
            if (r) {
                $("#modal_ci").modal("hide");
                $("#aor").focus();
                $('#person :input').each(function () {
                    name = $(this).attr('name');
                    if ($(this).prop('tagName') === 'SELECT') $(this).val(r[name]).trigger('change');
                    else $(this).val(r[name]);
                    if (name === 'nombreCompleto' || name === 'ci') $(`#${name}`).prop('disabled', true)
                });
            } else {
                $("#messageVerifi").append("Persona no encontrada.");
            }
            btnVerificar.prop('disabled', false);
        });
}
function getDatosParaFormulario() {
    var url = $('#url_data_form').data('url');
    $.get(url)
        .done(function (res) {
            let r = JSON.parse(res)[0];
            $('#ite').empty();
            $('#ite').append(equipos_select_opt(r.tipos));
            $('#marcas').empty();
            $('#marcas').append(marcas_equipo(r.marcas));
            $('#modelos').empty();
            $('#modelos').append(modelos_equipo(r.modelos));
            estado_equipo();
            $('#ide').empty();
            $('#ide').append(defectos_equipo(r.defectos));
        });
}
function equipos_select_opt(data) {
    var opt = '<option value="" >seleccione</option>';
    data.map((d) => {
        opt += `<option value="${d.id_tipo_equipo}" >${d.equipo}</option>`;
    })
    return opt;
}
function defectos_equipo(data) {
    var opt = '<option value="" >seleccione</option>';
    data.map((d) => {
        opt += `<option value="${d.id_defecto}" >${d.descripcion}</option>`;
    })
    return opt;
}
function marcas_equipo(data) {
    var opt = '<option value="" >seleccione</option>';
    data.map((d) => {
        opt += `<option value="${d.id_marca}" >${d.marca}</option>`;
    })
    return opt;
}
function modelos_equipo(data) {
    var opt = '<option value="" >seleccione</option>';
    data.map((d) => {
        opt += `<option value="${d.id_modelo}" >${d.modelo}</option>`;
    })
    return opt;
}
function estado_equipo() {
    var data = [
        { 'estado': 'Bueno', 'sigla': 'B' },
        { 'estado': 'Regular', 'sigla': 'R' },
        { 'estado': 'Malo', 'sigla': 'M' },
    ]
    var estado = '';
    data.map((d) => {
        estado += `
        <div class="form-check">
            <label class="custom-control custom-radio">
                <input id='' class="custom-control-input" type="radio" name="estado_equipo" value="${d.sigla}"> 
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">${d.estado}</span>
            </label>
        </div>
        `;
    })
    $('#estado').empty();
    $('#estado').append(estado);
    return estado;
} 