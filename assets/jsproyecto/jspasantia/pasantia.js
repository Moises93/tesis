/**
 * Created by Moises on 28-02-2017.
 */
$(document).ready(function(e) {
$.post(baseurl + "empresa/getEmpresa",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbEmpresa').append('<option value="'+item.emp_id+'">'+item.emp_nombre+'</option>'

            );
        });
    });
//$('#cbPostulados').empty().append('<option value="-1">seleccione:</option>');
/*muestro el login de acces del pasante que es Unico y evitar confuncion por nombres repetidos*/


    $.post(baseurl + "cpasante/getPostulados",
        function(data) {
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbPostulados').append('<option value="'+item.pas_id+'">'+item.usu_login+'</option>'

                );
            });
        });




$('#agregarPasantia').click(function () {

    var modalidad = $('#modalidad').val();
    var empresa = $('select[name=cbEmpresa]').val();
    var tutorE = $('select[name=cbTEmpresa]').val();
    var escuela = $('select[name=escuela]').val();
    var tutorA =$('select[name=cbTutorA]').val();
    var estudiante =$('select[name=cbPostulados]').val();
    var fecha = $('#reservation').val().split('-');
    var fechaIni=fecha[0].replace("/","-");
    var fechaFin=fecha[1].replace("/","-");
  /*  $.post(baseurl + "cpasante/esPasante",
        {
            estudiante: estudiante,

        },
        function (data) {
            console.log(data);
            if(data == 0){
                alert("Ya el estudiante esta realizando una Pasantia");
            }else if(data == 1){*/
                $.post(baseurl + "cpasantia/agregarPasantia",
                    {
                        modalidad: modalidad,
                        empresa: empresa,
                        tutorE: tutorE,
                        tutorA: tutorA,
                        escuela: escuela,
                        estudiante: estudiante,
                        fechaIni: fechaIni,
                        fechaFin: fechaFin
                    },
                    function (data) {
                        console.log(data);
                        if (data) {
                            //$('#mbtnCerrarModalP').click();
                            alert("Insercion exitosa");
                            location.reload();
                        }
                    });
            //}
        //});

});

    $('#tabPasantias').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,

        'ajax': {
            "url":baseurl+"cpasantia/getPasantia",
            "type":"POST",
            dataSrc: ''
        },'columns': [
            {data: 'id_pasantia','sClass':'dt-body-center'},
            {data: 'estatus'},
            {data: 'usu_login'},
            {data: 'fecha_inicio'},
            {data: 'fecha_final'},
            {data: 'modalidad'},
            {data: 'emp_nombre'},//,
            {data: 'uem_nombre'},//,
            {data: 'pro_nombre'},
            {data: 'esc_nombre'}//,
            /*{orderable: 'true',
             render: function (data,type,row) {

             return '<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
             'data-target="#modalEditUsuario" ' +
             'onClick="selPersona(\'' + row.id_usuario + '\',\'' + row.id_tipo + '\',\'' + row.usu_login + '\',\'' + row.usu_clave + '\',\'' + row.usu_correo + '\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editar</a>';


             }
             }*/
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


});
function cargarTutorE() {

    idEmp = $("#cbEmpresa option:selected").val();
    $('#cbTEmpresa').empty().append('<option value="-1">seleccione:</option>'); //la solucion para limpiar los data combos
    $.post(baseurl+"empresa/getUsuarioDeEmpresa",
        {
            empId: idEmp,
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTEmpresa').append('<option value="'+item.idusuario_empresa+'">'+item.uem_nombre+' '+item.uem_apellido+'</option>'
                );
            });
        });

    //  $('#buscarPermiso').attr("disabled", false);


}

function cargarTutorA() {

    // idEsc = $("#cbEmpresa option:selected").val(); OJO como el caso de uso era solo para computacion el IdEscuela va ser 1
    idEsc=1;
    idTipo=1; //este es el tipo de profesor en este caso queremos buscar tutores academicos , que son prof. tipo 1
    //$('#cbTEmpresa').empty().append('<option value="-1">seleccione:</option>'); //la solucion para limpiar los data combos
    $.post(baseurl+"profesor/get_ProfesoresTipo",
        {
            idEscuela: idEsc,
            idTipo: idTipo
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTutorA').append('<option value="'+item.pro_id+'">'+item.pro_nombre+' '+item.pro_apellido+'</option>'
                );
            });
        });

    //  $('#buscarPermiso').attr("disabled", false);


}