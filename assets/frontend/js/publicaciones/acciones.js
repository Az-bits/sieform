import { loadInit } from "../components/change.js";
let content;
export function inicializarFormulario() {
    getPublicaciones($('#url').data('url'));
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
export function getPublicaciones(url) {
    $.get(
        url,
        { buscarString: 1 }
    )
        .done(function (response) {
            let r = JSON.parse(response);
            contentPublicacion(r);
        });
}
function contentPublicacion(data) {


    content = ``;
    // console.log(data.length == '0');
    // console.log(data);

    if (data.length == '0') {
        content = `<div class="text-center" style="width:100%;"><img src="assets/img/no-result.png" alt=""  /><div>`;
    } else {
        data.publicaciones.map((d => {
            if (d.visibilidad === '1') {
                content += `
                <div class="col-lg-4">
                    <div class="card course-card ${revificarFecha(d.fecha_inicio) ? 'new' : ''}">
                        <div class="course-head">
                            <img src="${d.banner}" class="img-fluid course-img" alt="">
                            <a href="javaScript:void(0)" class="course-link"><i class="fa fa-link" aria-hidden="true"></i></a>
                        </div>
                        <div class="course-detail">
                            <h4 class="heading">${d.tipo}</h4>
                            <span class="brief">${d.detalle}</span>
                            <ul class="course-features">
                                <li><i class="fa fa-map-marker"></i> La Paz</li>
                                <li><i class="fa fa-calendar-check-o"></i> ${formatDate(d.fecha_inicio)}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                 `;
            }
        }));
    }

    $('#publicaciones').empty();
    $('#publicaciones').append(content);
    // console.log(data.paginate.page);
    paginate(data.paginate);

}
export function searchPublicacion(string) {
    $.get(
        $('#urlP').data('url'),
        { buscarString: string }
    )
        .done(function (response) {
            let r = JSON.parse(response);
            contentPublicacion(r);
        });
}
function paginate(data) {
    let num = Math.ceil(data.cantidad.cantidad / 3), content = ``, page = $('#paginas'), prox = $('#proximo');
    page.empty();
    page.append(paginas(content, num, data.page));
    prox.addClass('disabled');

}
function paginas(content, numero, page) {
    // console.log(page);
    if (numero == 0) {
        return content;
    }
    // console.log($('#url').data('url') + '?page=' + numero);
    content = ` <li class="page-item  ${numero == page && 'active'}">
                   <a class="page-link" data-url="${$('#url').data('url') + '?page=' + numero}" href="${$('#url').data('url') + '?page=' + numero}">${numero}</a>
                </li>`+ content;
    return paginas(content, numero - 1, page);
}



function formatDate(date) {
    const meses = [
        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
    ];
    const fecha = new Date(date);
    const mes = fecha.getMonth();
    const nombreMes = meses[mes];
    const formatoConNombreMes = `${fecha.getDate()} de ${nombreMes} de ${fecha.getFullYear()}`;

    return formatoConNombreMes;
}
function revificarFecha(fecha) {
    const fechaActual = new Date();
    const fechaInicio = new Date(fecha);

    const esIgual = fechaActual.getFullYear() === fechaInicio.getFullYear() &&
        fechaActual.getMonth() === fechaInicio.getMonth() &&
        fechaActual.getDate() === fechaInicio.getDate();
    return esIgual;
}