export function CancelButton(modalEl, form) {
    resetForm(form);
    az.showSwal('warning-cancel-simple', modalEl);
}
export function getDataForm() {
    var url = $('#url_data_form').data('url');
    $.get(url)
        .done(function (r) {
            var r = eval(r)[0];
            // console.log(r);
            $('#ite').empty();
            $('#ite').append(equipos_select_opt(r.tipos)).selectpicker('refresh');
            $('#marcas').empty();
            $('#marcas').append(marcas_equipo(r.marcas)).selectpicker('refresh');
            $('#modelos').empty();
            $('#modelos').append(modelos_equipo(r.modelos)).selectpicker('refresh');
            estado_equipo();
            $('#ide').empty();
            $('#ide').append(defectos_equipo(r.defectos)).selectpicker('refresh');
        });
}
function equipos_select_opt(data) {
    var opt = '';
    data.map((d) => {
        opt += `<option value="${d.id_tipo_equipo}" >${d.equipo}</option>`;
    })
    return opt;
}
function defectos_equipo(data) {
    var opt = '';
    data.map((d) => {
        opt += `<option value="${d.id_defecto}" >${d.descripcion}</option>`;
    })
    return opt;
}
function marcas_equipo(data) {
    var opt = '';
    data.map((d) => {
        opt += `<option value="${d.id_marca}" >${d.marca}</option>`;
    })
    return opt;
}
function modelos_equipo(data) {
    var opt = '';
    data.map((d) => {
        opt += `<option value="${d.id_modelo}" >${d.modelo}</option>`;
    })
    return opt;
}
export function estado_equipo() {
    let data = [
        { 'estado': 'Bueno', 'sigla': 'B' },
        { 'estado': 'Regular', 'sigla': 'R' },
        { 'estado': 'Malo', 'sigla': 'M' },
    ]
    let estado = '';
    data.map((d) => {
        estado += `
        <div class="form-check">
            <label class="form-check-label">
                <input id='est_eq' class="form-check-input" type="radio" name="estado_equipo" value="${d.sigla}"> ${d.estado}
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        `;
    })
    $('#estado').empty();
    $('#estado').append(estado);
}           