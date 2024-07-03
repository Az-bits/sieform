import { loadInit } from "../components/change.js";

var response, datosFormulario;
export function guardarFormulario(form, modalEl, btnState) {
    loadInit();
    btnState.add();
    datosFormulario = new FormData($('#formulario_modal')[0]);
    $.ajax({
        url: form.action,
        type: 'POST',
        data: datosFormulario,
        cache: false,
        processData: false,
        contentType: false,
        success: function (r) {
            response = JSON.parse(r);
            console.log(response);
            modalEl.modal('hide');
            swal({
                title: '¡Exito!',
                text: response.message,
                type: 'success',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success',
            });
        },
        error: function (xhr, textStatus, errorThrown) {
            loadInit();
            loadInit();
            az.showErrorHTML(xhr.responseText);
            $("#btnSubmit").prop('disabled', false);
        },
        complete: function () {
            loadInit();
            $('#datatables').DataTable().ajax.reload();
            $("#btnSubmit").prop('disabled', false);
        },
    });
}
