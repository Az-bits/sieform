import { loadInit } from "../components/change.js";
var response, datosFormulario;
export function guardarFormulario(form, modalEl, btnState) {
    loadInit();
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
            swal({
                title: '¡Exito!',
                text: response.message,
                type: 'success',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success',
            }).then(function () {
                window.location = `${$("#baseUrl").data("base-url")}`;
            });
        },
        error: function (xhr, textStatus, errorThrown) {
            loadInit();
            loadInit();
            swal({
                title: '!Error¡',
                type: 'error',
                buttonsStyling: false,
                confirmButtonClass: "btn btn-primary",
                html: xhr.responseText
            }).catch(swal.noop)
            $("#btnSubmit").prop('disabled', false);
        },
        complete: function () {
            loadInit();
            // $('#datatables').DataTable().ajax.reload();
            $("#btnSubmit").prop('disabled', false);
        },
    });
}
