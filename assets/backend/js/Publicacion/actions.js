let res, url, item;

export function getDatosParaFormulario(data) {
    url = $('#u_data').data('url');
    $.get(url)
        .done(function (r) {
            res = JSON.parse(r);
            tipoPublicacion(res);
        });
}


function tipoPublicacion(data) {
    var opt = '';
    data.map((d) => {
        opt += `<option value="${d.id_tipo_publicacion}" >${d.tipo}</option>`;
    })
    $('#tipo').empty();
    $('#tipo').append(opt).selectpicker('refresh');
}
