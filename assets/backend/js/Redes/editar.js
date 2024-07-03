
var url, r, name, res;
export function editarFormulario(id, modalEl, btnState) {
    btnState.edit(id);
    url = $('#ue').data('url');
    $("#btnSubmit").prop('disabled', false);
    $.get(url, { id: id })
        .done(function (response) {
            modalEl.modal('show');
            res = JSON.parse(response);
            r = res.formulario;
            // console.log(res.data.materiales);

            $('form#formulario_modal :input').each(function () {
                name = $(this).attr('name');
                if ($(this).prop('tagName') === 'SELECT') $(this).val(r[name]).trigger('change');
                else if ($(this).prop('type') === 'checkbox') {
                } else {
                    $(this).val(r[name]);
                }
                if (name === 'nombreCompleto' || name === 'nombreCompleto2' || name === 'celular2' || name === 'email2') document.getElementById(name).disabled = true;
            });
            $('#procedimientos :input').each(function () {
                name = $(this).attr('name');
                $(this).prop('checked', false);
                res.data.procedimientos.filter(function (p) {
                    return `procedimientos[${p.tag}]` === name;
                }).length !== 0 && $(this).prop('checked', true)
            });
            $('#defectos :input').each(function () {
                $(this).prop('checked', false);
                name = $(this).attr('name');
                res.data.defectos.filter(function (d) {
                    return `defectos[${d.tag}]` === name;
                }).length !== 0 && $(this).prop('checked', true);
            });
            $('#materiales :input').each(function () {
                name = $(this).attr('name');
                $(this).prop('checked', false);
                res.data.materiales.map(m => {
                    `materiales[${m.tag}][cantidad]` === name && $(this).val(m.cantidad);
                    `materiales[${m.tag}][id]` === name && $(this).prop('checked', true);
                })
            });
        });
}