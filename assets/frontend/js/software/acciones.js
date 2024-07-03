import { loadInit } from "../components/change.js";

export function inicializarFormulario() {
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
