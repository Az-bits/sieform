
var url, r, name, res;
export function editarFormulario(id, modalEl, btnState) {
    btnState.edit(id);
    url = $('#ue').data('url');

    $.get(url, { id: id })
        .done(function (response) {
            modalEl.modal('show');
            res = JSON.parse(response);
            r = res.formulario;
            //console.log(res.data);
            $('form#formulario_modal :input').each(function () {
                name = $(this).attr('name');
                if ($(this).prop('tagName') === 'SELECT') $(this).val(r[name]).trigger('change');
                else if ($(this).prop('type') === 'checkbox') {
                    //importate esta condicion para que le quite sus value alos input:check
                } else {
                    $(this).val(r[name]);
                }
                if (name === 'nombreCompleto' || name === 'nombreCompleto2' || name === 'celular2' || name === 'email2') document.getElementById(name).disabled = true;
            });
            $('#operaciones :input').each(function () {
                name = $(this).attr('name');
                console.log(name);
                $(this).prop('checked', false);
                res.data.filter(function (d) {
                    return `operaciones[${d.tag}]` === name;
                }).length !== 0 && $(this).prop('checked', true)
            });
        });
}