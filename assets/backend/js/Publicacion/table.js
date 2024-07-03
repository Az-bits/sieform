var url, table, id, urlPdf;

export function DataTable() {
    url = $('#upf').data('url');
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
            { data: 'id_publicacion', },
            {
                targets: 1,
                orderable: false,
                render: function (data, type, row) {
                    return `
                        <div>
                            <img src="${row.banner}" alt="Miniatura" width="80"></td>
                        </div>
                        `;
                }

            },
            { data: 'tipo' },
            { data: 'fecha_inicio' },
            { data: 'fecha_fin' },
            {
                targets: 1,
                orderable: false,
                render: function (data, type, row) {
                    // console.log(row);
                    let id = row.visibilidad; let btn;
                    row.visibilidad === '0' ?
                        btn = `<span class="text-warning">NO PUBLICADO</span>` :
                        btn = `<span class="text-success">PUBLICADO</span>`;
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
                    id = row.id_publicacion;
                    url = $('#pdf').data('url');
                    row.estado === 'A' ?
                        btns = `
                        <a data-id="${id}" href="#" class="btn btn-link btn-info btn-just-icon editar" data-toggle="tooltip" title="Editar"><i class="material-icons">edit</i></a>
                            <a data-id="${id}" href="#" class="btn btn-link btn-danger btn-just-icon eliminar" data-toggle="tooltip" title="Eliminar"><i class="material-icons">close</i></a>
                        `: btns = '';
                    return `
                        <div class="text-right">
                            <!--<a href="${url}?id=${id}" target="_blank" class="btn btn-link btn-warning btn-just-icon pdf" data-toggle="tooltip" title="Pdf"><i class="material-icons">picture_as_pdf</i></a>-->
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