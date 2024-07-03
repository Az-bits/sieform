var url, table, id, urlPdf;

export function DataTable() {
    url = $('#ucf').data('url');
    table = $('#datatables').DataTable({
        order: [[0, "desc"]],
        lengthMenu: [
            [5, 25, 50, -1],
            [10, 25, 50, 'Todos'],
        ],
        responsive: true,
        language: languageTable,
        'ajax': {
            "url": url,
        },
        'columns': [
            { data: 'id_formulario', },
            { data: 'nombreCompleto' },
            { data: 'nombreCompleto2' },
            { data: 'sistema' },
            { data: 'operacion' },
            {
                targets: -2,
                orderable: false,
                render: function (data, type, row) {
                    // console.log(row);
                    let id = row.id_formulario; let btn;
                    row.estado === 'A' ?
                        btn = `<a href="#" data-id="${id}" class="btn btn-warning btn-sm az-b estado" data-toggle="modal" data-target="#modalEstado">ACTIVO</a>` :
                        btn = `<a href="#" data-id="${id}" class="btn btn-success btn-sm az-b az-p estado" data-toggle="modal" data-target="#modalEstado">FINALIZADO</a>`;
                    // console.log(id);id_revision_realizada
                    // var url = $('[name="pdf"]').val();

                    return `
                        <div>
                            ${btn}
                        </div>
                        `;
                }

            },
            {
                targets: -1,
                orderable: false,
                render: function (data, type, row) {
                    let btns;
                    id = row.id_formulario;
                    url = $('#pdf').data('url');
                    row.estado === 'A' ?
                        btns = `
                        <a data-id="${id}" href="#" class="btn btn-link btn-info btn-just-icon editar" data-toggle="tooltip" title="Editar"><i class="material-icons">edit</i></a>
                            <a data-id="${id}" href="#" class="btn btn-link btn-danger btn-just-icon eliminar" data-toggle="tooltip" title="Eliminar"><i class="material-icons">close</i></a>
                        `: btns = `<a href="${url}?id=${id}" target="_blank" class="btn btn-link btn-warning btn-just-icon pdf" data-toggle="tooltip" title="Pdf"><i class="material-icons">picture_as_pdf</i></a>`;
                    return `
                        <div class="text-right">
                           ${btns}
                        <div>
                        `;
                }

            },

        ],
        drawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
    return table;
}