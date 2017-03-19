/**
 * Created by Moises on 16-03-2017.
 */
$(document).ready(function(e) {
    $('#tblEvaluar').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,

        'ajax': {
            "url": baseurl + "profesor/evaluarPasantes",
            "type": "POST",
            dataSrc: ''
        }, 'columns': [
            {
                "render": function (data, type, row) {
                    return '<span>' + row.pas_apellido + ' ' + row.pas_nombre + ' </span>';
                }
            },
            {
                "render": function (data, type, row) {
                    if(row.orgaca >0){
                        return '<span> Universidad de Carabobo </span>';

                    }else{
                        return '<span>' + row.emp_nombre +  '</span>';
                    }
                }
            },
            {data: 'pas_nombre'},
            {
                orderable: 'true',
                render: function (data, type, row) {
                    console.log(row.estatus!=2);
                    if(row.estatus<3){
                        return '<a href="#" data-toggle="modal" ' +
                            'data-target="#modalEditProfesor" ' +
                            'onClick="aprobarPasante(\'' + row.id_pasantia + '\',\'' + row.estatus + '\',\'' + row.requisitos + '\');"><span  class="fa fa-check-circle-o" </span></a>' +

                            '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                            'data-target="#modalInfoPasantia" ' +
                            'onClick="selInfo(\'' + row.pas_nombre + '\',\'' + row.pas_apellido + '\',\'' + row.fecha_inicio + '\',\'' + row.fecha_final + '\',\'' + row.emp_nombre + '\');"><i class="fa fa-search" aria-hidden="true"></i></a>';
                    }else{
                        return '<span style="color:green" class="fa fa-check" </span>' +

                            '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                            'data-target="#modalInfoPasantia" ' +
                            'onClick="selInfo(\'' + row.fecha_inicio + '\',\'' + row.fecha_final + '\',\'' + row.emp_nombre + '\');"><i class="fa fa-search" aria-hidden="true"></i></a>';
                    }

                }
            }
        ],

        /* "columnDefs": [
         {
         "targets": [4],
         "data": "emp_acceso",
         "render": function(data, type, row) {

         if (data == 0) {
         return '<a href="#" title="Habilitar Usuario" onClick="cambioEstatus(' + row.emp_id + ',' + 1 + ')"><span class="label label-danger">Inactivo &nbsp;</span><i style="color:green; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';
         }else if (data == 1) {
         return '<a href="#" title="Deshabilitar Usuario" onClick="cambioEstatus(' + row.emp_id + ',' + 0 + ')"><span class="label label-success">Activo</span><i style="color:red; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';

         }

         }
         }
         ],*/
        "order": [[1, "asc"]],
    });

});

aprobarPasante = function(idPas,estatus,requisitos){

    if(estatus < 3){
        alert('El Tutor empresarial aun no ha Evaluado');
    }else{
        $.post(baseurl + "cpasantia/aprobarPasantia",
            {

                idPasantia:idPas
            },
            function(data){
                alert(data);
                location.reload();
            });
    }
};
