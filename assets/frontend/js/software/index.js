
import { verificarCI, inicializarFormulario } from './acciones.js';
import { guardarFormulario } from "./nuevo.js";

$(document).ready(function () {
    let form = document.querySelector('#formulario_modal');
    let btnVerificar = $('#btnVerificar');
    let btnSubmit = $('#btnSubmit');

    //Datos para mostrar al formulario
    inicializarFormulario();

    //verificar si persona existe
    btnVerificar.on('click', function (e) {
        e.preventDefault();
        btnVerificar.prop('disabled', true);
        verificarCI(btnVerificar);
    });

    //Guardar el formulario
    btnSubmit.on('click', function (e) {
        e.preventDefault();
        guardarFormulario(form);
    });




});