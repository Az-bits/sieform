
var url, r, name;
export function editarFormulario(id, modalEl, btnState) {
    btnState.edit(id);
    $("#btnSubmit").prop('disabled', false);
    url = $('#ue').data('url');

    $.get(url, { id: id })
        .done(function (response) {
            modalEl.modal('show');
            r = JSON.parse(response);
            $('form#formulario_modal :input').each(function () {
                name = $(this).attr('name');
                if ($(this).prop('tagName') === 'SELECT') $(this).val(r[name]).trigger('change');
                else {
                    $(this).val(r[name]);
                }
                if (name === 'nombreCompleto' || name === 'nombreCompleto2' || name === 'celular2' || name === 'email2') document.getElementById(name).disabled = true;
            });
        });
}