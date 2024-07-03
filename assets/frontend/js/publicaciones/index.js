
import { inicializarFormulario, searchPublicacion, getPublicaciones } from './acciones.js';

$(document).ready(function () {


    let search = $('#search');
    let page = $('#paginas');
    let prox = $('#proximo');
    //Datos para mostrar al formulario
    inicializarFormulario();

    search.on('keyup', function () {
        console.log($(this).val());
        searchPublicacion($(this).val())
    })
    page.on('click', 'a', function (e) {
        e.preventDefault();
        // window.history.pushState(null, null, nuevaUrl);
        getPublicaciones($(this).data("url"));
    })

    // proc.onClick
    //verificar si persona existe
    // btnVerificar.on('click', function (e) {
    //     e.preventDefault();
    //     btnVerificar.prop('disabled', true);
    //     verificarCI(btnVerificar);
    // });

    // //Guardar el formulario
    // btnSubmit.on('click', function (e) {
    //     e.preventDefault();
    //     guardarFormulario(form);
    // });





});