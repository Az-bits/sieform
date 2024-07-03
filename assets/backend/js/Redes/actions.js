let res, url;

export function getDatosParaFormulario(data) {
    defectosReportados(data.defectos);
    materiales(data.materiales);
    procedimientos(data.procedimientos);

}
function limpiar(item, name = null) {
    $(item).val('');
    name !== 'ci2' && $(item).prop('disabled', true);
}
function materiales(data) {
    let item = ``;
    data.map(d => {
        item += `
            <div class="form-check">
                <div class="row az-checkbox">
                    <div class="col-lg-12 az-col justify-content-between">
                        <div class="form-group">
                            <label class="form-check-label">
                                ${d.nombre_material} <input name="materiales[${d.tag}][id]" class="form-check-input" type="checkbox" value="${d.id_material}">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        <div>
                            ${d.id_material !== '6' && d.id_material !== '7' ? '<input type="number" min="0" name="' + `materiales[${d.tag}][cantidad]" id="" > <label for="">` + (d.id_material !== '1' ? 'Unid.' : 'Mts.') + ' </label>' : ''}
                        </div >
                    </div >
                </div >
            </div >
        `

    });
    $('#materiales').empty();
    $('#materiales').append(item);
}
function procedimientos(data) {
    let item = ``;
    data.map(d => {
        item += `
            <div class="form-check">
                <div class="row az-checkbox">
                    <div class="col-lg-12 az-col justify-content-between">
                        <div class="form-group">
                            <label class="form-check-label">
                                ${d.titulo_procedimiento} <input name="procedimientos[${d.tag}]" class="form-check-input" type="checkbox" value="${d.id_procedimiento_redes}">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div >
                </div >
            </div >
        `

    });
    $('#procedimientos').empty();
    $('#procedimientos').append(item);
}
function defectosReportados(data) {
    let content = ``
    let item = ``;
    let cont = 0;
    data.map(d => {
        cont % 3 === 0 ? item = '' : null;
        // console.log(cont);
        item += `
            <div class="form-check">
                <div class="row az-checkbox">
                    <div class="col-lg-12 az-col justify-content-between">
                        <div class="form-group">
                            <label class="form-check-label az-size">
                                ${d.titulo} <input name="defectos[${d.tag}]" class="form-check-input" type="checkbox" value="${d.id_defecto}">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div >
                </div >
            </div >
        `
        cont++;
        cont % 3 === 0 ? content += `<div class="col-lg-4">${item}</div>` : null;
    });
    $('#defectos').empty();
    $('#defectos').append(content);
}