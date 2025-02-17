/**
 * Script principal de  Publicaciones
 */

import { guardarFormulario } from './nuevo.js';
import { editarFormulario } from './editar.js';
import { DataTable } from "./table.js";
import { getDatosParaFormulario } from './actions.js';
import estado from './estado.js';
import data from './data.js';

// import { submitForm, editForm } from './api.js';
import Validation from './validation.js';
$(document).ready(function () {

    // variables
    var form, modalEl, modalTitle, btnNew, btnCancel, btnSubmit, btnTextSubmit, btnState, table, id;

    // Seleccionando elementos
    form = document.querySelector('#formulario_modal');
    modalEl = $('#main_modal');
    modalTitle = $('.modal-title')[0];
    btnNew = $('#nuevo');
    btnCancel = $('#btnCancel');
    btnSubmit = $('#btnSubmit');
    btnTextSubmit = $('.btnTextSubmit');
    btnState = {
        add: function () {
            modalTitle.innerHTML = 'PUBLICACIONES';
            $(btnSubmit).removeAttr('data-id-soft');
            $(btnTextSubmit).text('CREAR FORMULARIO');
        },
        edit: function (id) {
            modalTitle.innerHTML = 'EDITAR PUBLICACIÓN';
            $(btnSubmit).attr('data-id-soft', id);
            $(btnTextSubmit).text('ACTUALIZAR FORMULARIO');
        },
    }

    //iniciando datatable
    table = DataTable();
    // modalEl.modal("show");

    getDatosParaFormulario(data);

    //Crear nuevo formulario
    btnNew.on('click', function (e) {
        btnState.add();
        $('.fileinput').fileinput('clear');
        resetForm(form);
        getDatosParaFormulario(data);
    })

    //Guardar nuevo formulario o actualizarlo
    btnSubmit.on("click", function (e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        guardarFormulario(form, modalEl, btnState);
    })

    //Cancelar fomulario
    btnCancel.on('click', function () {
        az.showSwal('mensage-pracaucion-cancelar', modalEl);
    });

    // Editar formulario
    table.on('click', '.editar', function () {
        // getDatosParaFormulario(data);
        $('.fileinput').fileinput('clear');
        editarFormulario($(this).data('id'), modalEl, btnState);
    });

    // Eliminar formulario
    table.on('click', '.eliminar', function (e) {
        e.preventDefault();
        az.showSwal('eliminar-formulario', modalEl, $('#ud').data('url'), $(this).data('id'));
    });

    //Like record
    table.on('click', '.pdf', function () {
        var url = $('#pdf').data('url');
        var id = $(this).data('id');
        // alert('asd');
        $.get(url, { id: id })
    });
    table.on('click', '.revisiones', function (e) {
        e.preventDefault();
        $('#main').empty();

    });

    table.on('click', '.estado', function () {
        estado($(this).data('id'));
    });

    // $('#').on('mouseover', function () {
    //     alert();
    // })

    //Inicializando elementos
});