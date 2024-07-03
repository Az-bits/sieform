
import { estado_equipo } from "./actions.js";

var url, r, name;
export function editarFormulario(id, modalEl, btnState) {
    btnState.edit(id);
    $("#btnSubmit").prop('disabled', false);
    // estado_equipo();
    url = $('#ue').data('url');
    console.log(id);
    $.get(url, { id: id })
        .done(function (response) {
            modalEl.modal('show');
            r = JSON.parse(response);
            console.log(r);
            $('form#formulario_modal :input').each(function () {
                name = $(this).attr('name');
                if ($(this).prop('tagName') === 'SELECT') $(this).val(r[name]).trigger('change');
                else if ($(this).is(':radio')) {
                    //     $(this).filter(`[value='${r[name]}']`).prop('checked', true)
                } else {
                    $(this).val(r[name]);
                }
                if (name === 'nombreCompleto' || name === 'nombreCompleto2' || name === 'celular2' || name === 'email2') document.getElementById(name).disabled = true;
            });
            $('[name="estado_equipo"]').prop('checked', false);
            $('[name="estado_equipo"]').filter(`[value="${r['estado_equipo']}"]`).prop('checked', true);
        });
}