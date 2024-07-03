var r, urlData, url;
export default function estado(id) {
    // $('#modalEstado').modal('show');
    urlData = $('#ue').data('url');
    url = $('#ues').data('url');
    $.get(urlData, { id: id })
        .done(function (res) {
            r = JSON.parse(res);
            console.log(r);
            $(`[name="estado"]`).filter(`[value=${r['estado']}]`).prop('checked', true)
        })
    swal({
        title: 'Cambiar estado',
        html: extructure(),
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function (result) {
        console.log(result);
        $.get(url, { id: id, estado: $('[name="estado"]:checked').val() })
            .done(function (r) {
                swal.noop;
                r = eval(r)[0];
                swal({
                    title: '!Realizado!',
                    text: r.message,
                    type: 'success',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-success',
                });
                $('#datatables').DataTable().ajax.reload();
            })
            .fail(function (res) {
                swal({
                    // title: res.responseText,
                    text: res.responseText,
                    type: 'warning',
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success"
                }).then(function (params) {
                    // console.log(params);
                    Estado();
                })
                    .catch(swal.noop)
                // Estado();
            });
    }).catch(swal.noop)
}
function extructure() {

    let div = `
            <div style='display: flex; justify-content: center; margin: 1rem;'>
                <div class="form-check">
                    <label class="form-check-label">
                        <input id='es' class="form-check-input" type="radio" name="estado" value="A"> ACTIVO
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input id='es' class="form-check-input" type="radio" name="estado" value="C"> COMPLETADO
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
                `;
    return div;

}