/**
 * Created by Moises on 30-03-2017.
 */
$(document).ready(function(e) {
$('#tblBiblioteca').DataTable({
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
        "url":baseurl+"cdocumentos/obtenerDocumentos",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {
            "render": function (data, type, row) {
                return '	<div class="media"> <a href="#" class="pull-left">'+
                    '<img src='+baseurl+'assets/img/book.png class="media-photo">'+
                    '</a>'+
                '<div class="media-body">'+
                            '<span class="media-meta pull-right"> <i class="glyphicon glyphicon-star"> </i></span>'+
                            '<h4 class="title">'+row.nombredoc +
                            '</h4>'+
                            '<p class="summary">Este libro te ayudara a redactar tu informe final</p>'+
                       '</div></div>';
            }
        },
        {
            "render": function (data, type, row) {
                var formato = row.formato.split("/");
                var extencion = formato[1];
                var descarga=baseurl+'cdocumentos/visualizarDocumentos/'+row.nombredoc+'.'+extencion;
                return '<a href="'+ descarga+'"target="_blank" <span class="fa fa-search" aria-hidden="true"></span></a> ';
            }
        },

    ],

  ///  "order": [[ 1, "asc" ]],
});
});