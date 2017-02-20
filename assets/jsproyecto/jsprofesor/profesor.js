$('#tblProfesor').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,

    'ajax': {
        "url":baseurl+"profesor/get_profesores",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'pro_id','sClass':'dt-body-center'},
        {data: 'pro_cedula'},
        {data: 'pro_nombre'},
        {data: 'pro_apellido'},
        {data: 'pro_sexo'},
        {data: 'esc_nombre'},
        {data: 'pro_tipo'},
        {data: 'id_usuario'}//,
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
$(document).ready(function(e) {
//Lleno el datacombo de Tipo Profesor
$.post(baseurl + "profesor/get_tipoProfesor",
    function(data) {
        var p = JSON.parse(data);
        console.log(p);
        $.each(p, function (i, item) {

            $('#tProfesor').append('<option value="'+item.id_tipo+'">'+item.pro_tipo+'</option>'
            );
        });
});
});

$('#agregarProfesor').click(function () {

   var cedula = $('#cedulaP').val();
   var nombre = $('#nombreP').val();
   var apellido = $('#apellidoP').val();
   var sexo = $('#sexo').val();
   var escuela = $('#escuela').val();
   var tipo = $('#tProfesor').val();
   var email = $('#emailP').val();
   var login = $('#loginP').val();
   var password = $('#pswP').val();
   //alert(nombre);
   /* alert(padre);
    alert(clase);
    alert(url);*/
    $.post(baseurl + "profesor/crearProfesor",
        {
            cedula: cedula,
            nombre: nombre,
            apellido: apellido,
            sexo: sexo,
            escuela: escuela,
            tipo: tipo,
            email: email,
            login: login,
            password: password,
        },
        function (data) {
            if (data == 1) {
                //$('#mbtnCerrarModalP').click();

                location.reload();
            }
        });

});