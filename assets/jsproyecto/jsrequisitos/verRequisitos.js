/**
 * Created by eheredia on 02/03/2017.
 */
$('#verRequisitos').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,
    'autoWidth': false,

    'ajax': {
        "url":baseurl+"cadministrador/getRequisitos",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'usu_login'},
        {data: 'requisito'},
        {"render": function ( data, type, row ) {
            return '<span>' + row.nombre_archivo +'</span>&emsp;' +

           ' <a href='+ baseurl+'cpasante/downloads/'+row.nombre_archivo+''+row.formato+'  /> Descargar</a>';
        }}
    ]
    /*,
        {orderable: 'true',
         render: function (data,type,row) {
     '<a href="#" onClick="descargarArchivo(\'' + row.nombre_archivo + '\');">Descargar</a>';
         return '<a href= "baseurl + '/cpasante/downloads/'+row.nombre_archivo +" >hola</a>';

         }
        }
    ]//,
    /*"columnDefs": [
     {
     "targets": [4],
     "data": "usu_estatus",
     "render": function(data, type, row) {

     if (data == 0) {
     return '<a href="#" title="Habilitar Usuario" onClick="cambioEstatus(' + row.pro_id + ',' + 1 + ')"><span class="label label-danger">Inactivo &nbsp;</span><i style="color:green; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';
     }else if (data == 1) {
     return '<a href="#" title="Deshabilitar Usuario" onClick="cambioEstatus(' + row.pro_id + ',' + 0 + ')"><span class="label label-success">Activo</span><i style="color:red; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';

     }

     }
     }
     ],
     "order": [[ 1, "asc" ]],*/
});

descargarArchivo = function(nombre){
    $.post(baseurl+"coordinador/downloads",
        {
            archivo: nombre,
        },
        function(data){

        });

}

