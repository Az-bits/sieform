
var az = {
    showSwal: function (type, modalEl, url, id) {
        if (type == 'eliminar-formulario') {
            swal({
                title: '¿Está seguro de eliminar?',
                text: '¡No podrá recuperar los datos!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Eliminar",
                cancelButtonText: "No, retornar",
                confirmButtonClass: "btn btn-danger",
                cancelButtonClass: "btn btn-default",
                buttonsStyling: false
            }).then(function () {
                swal.noop;
                modalEl.modal('hide');
                $.get(url, { id })
                    .done(function (response) {
                        var r = JSON.parse(response);
                        swal({
                            title: '!Eliminado!',
                            text: r.message,
                            type: 'success',
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-success',
                        });
                        $('#datatables').DataTable().ajax.reload();

                    });
            }, function (dismiss) {
                dismiss === 'cancel' ? swal.noop : null;
            })
        } else if (type == 'mensage-pracaucion-cancelar') {
            swal({
                title: '¿Está seguro de cancelar?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "¡Sí, cancelalo!",
                cancelButtonText: "No, retornar",
                confirmButtonClass: "btn btn-danger",
                cancelButtonClass: "btn btn-default",
                buttonsStyling: false
            }).then(function () {
                swal.noop;
                modalEl.modal('hide');
            }, function (dismiss) {
                dismiss === 'cancel' ? swal.noop : null;
            })
        }
    },
    showErrorHTML: function (data) {
        swal({
            title: '!Error¡',
            type: 'error',
            buttonsStyling: false,
            confirmButtonClass: "btn btn-primary",
            html: data
        }).catch(swal.noop)
    }
}