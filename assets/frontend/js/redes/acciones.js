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
            let r = JSON.parse(res);
            defectosReportados(r.data.defectos);

        });
}

function defectosReportados(data) {
    let content = ``
    let item = ``;
    let cont = 0;
    data.map(d => {
        cont % 3 === 0 ? item = '' : null;
        // console.log(cont);
        item += `
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="defectos[${d.tag}]" value="${d.id_defecto}">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">${d.titulo}</span>
            </label>
        `
        cont++;
        cont % 3 === 0 ? content += `<div class="col-lg-4">${item}</div>` : null;
    });
    $('#defectos').empty();
    $('#defectos').append(content);
}