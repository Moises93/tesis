/**
 * Created by Moises on 05-04-2017.
 */
$(document).ready(function(e) {

    $('#tblInformes').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,
        "ordering": false, //quito ordenamiento asc y desc

        'ajax': {
            "url":baseurl+"cdocumentos/obtenerInformes",
            "type":"POST",
            dataSrc: ''
        },'columns': [
            {
                "render": function (data, type, row) {
                        return '<span>' + row.pas_apellido + ' ' + row.pas_nombre +'</span>';

                }
            },
            {data: 'titulo'},
            {
                "render": function (data, type, row) {

                    var descarga=baseurl+'cdocumentos/visualizarInformes/'+row.nombre_archivo+row.formato;
                    return '<a href="'+ descarga+'"target="_blank" <span class="fa fa-search" aria-hidden="true"></span></a> ';
                }
            },

        ],

        ///  "order": [[ 1, "asc" ]],
    });
});