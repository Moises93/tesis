/**
 * Created by Moises on 19-02-2017.
 */

/**
 * Created by eheredia on 23/02/2017.
 */
$('#nuevaClave').bootstrapValidator({

    message: 'Este valor no es valido',

    feedbackIcons: {

        valid: 'glyphicon glyphicon-ok',

        invalid: 'glyphicon glyphicon-remove',

        validating: 'glyphicon glyphicon-refresh'

    },
    excluded: ':disabled', //limpia las validaciones al cerrar el modal
    fields: {

        clave: {

            validators: {
                notEmpty: {

                    message: 'El clave es requerida'

                },
                identical: {
                    field: 'clavec',
                    message: 'La clave debe ser la misma'
                },
                stringLength: {

                    min: 8,

                    message: 'La clave debe contener al menos 8 caracteres'

                }
            }

        },
        clavec: {

            validators: {
                notEmpty: {

                    message: 'La clave es requerida'

                },
                identical: {
                    field: 'clave',
                    message: 'La clave debe ser la misma'
                },


            }

        }
    }
});

$.post(baseurl + "empresa/getEmpresa",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#empresaUe').append('<option value="'+item.emp_id+'">'+item.emp_nombre+'</option>'
            );
        });
    });


$('#agregarUe').click(function () {
    //console.log(tipo);
    var cedula = $('#cedulaUe').val();
    var nombre = $('#nombreUe').val();
    var apellido = $('#apellidoUe').val();
    var sexo = $('#sexoUe').val();
    var email = $('#emailUe').val();
    var login = $('#loginUe').val();
    var clave = $('#claveUe').val();
    var tipo = $('#tipoUe').val();
    var empresa = $('#empresaUe').val();
    var telefono = $('#telefonoUe').val();
    //var clase = $('#mtxtClase').val();
   /* alert(cedula);
    alert(apellido);
    alert(nombre);
    alert(sexo);
    alert(email);
    alert(login);
    alert(clave);
    alert(tipo);
    alert(empresa);*/


    if(cedula != '' && nombre != '' && login != '') {
        $.post(baseurl + "empresa/agregarUsuarioE",
            {
                cedula: cedula,
                nombre: nombre,
                apellido: apellido,
                sexo: sexo,
                email: email,
                empresa: empresa,
                tipo: tipo,
                login: login,
                clave: clave,
                telefono:telefono
                
            },
            function (data) {
                console.log(data);
                if (data) {
                    //$('#mbtnCerrarModalP').click();

                    location.reload();
                }
            });
    }/*else{
        alert("debe rellenar todos los datos!");
    }*/

});


$('#tblUsuarioE').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,

    'ajax': {
        "url":baseurl+"empresa/getUsuarioEmpresa",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'idusuario_empresa','sClass':'dt-body-center'},
        {data: 'uem_cedula'},
        {data: 'uem_nombre'},
        {data: 'uem_apellido'},
        {data: 'uem_telefono'},
        {data: 'usu_correo'},
        {data: 'emp_nombre'},
        {data: 'usu_estatus'},
        {orderable: 'true',
            render: function (data,type,row) {

                return '<a href="#"  data-toggle="modal" ' +
                    'data-target="#modalEditUsuarioE" ' +
                    'onClick="selUsuarioEmpresa(\'' + row.id_usuario + '\',\'' + row.idusuario_empresa + '\',\'' + row.uem_cedula + '\',\'' + row.uem_nombre + '\',\'' + row.uem_apellido + '\',\'' + row.uem_telefono + '\',\'' + row.usu_correo + '\');"><span class="glyphicon glyphicon-edit" </span></a>'+

                    '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                    'data-target="#modalEditClave" ' +
                    'onClick="selClave(\'' + row.id_usuario + '\');"><i class="fa fa-key" aria-hidden="true"></i></a>';


            }
        }
    ],
    "columnDefs": [
        {
            "targets": [7],
            "data": "usu_estatus",
            "render": function(data, type, row) {

                if (data == 0) {
                    return '<a href="#" title="Habilitar Usuario" onClick="cambioEstatus(' + row.id_usuario + ',' + 1 + ')"><span class="label label-danger">Inactivo &nbsp;</span><i style="color:green; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';
                }else if (data == 1) {
                    return '<a href="#" title="Deshabilitar Usuario" onClick="cambioEstatus(' + row.id_usuario + ',' + 0 + ')"><span class="label label-success">Activo</span><i style="color:red; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';

                }

            }
        }],

    "order": [[ 1, "asc" ]],
});


selUsuarioEmpresa= function(idUser,id,cedula, nombre, apellido, telefono,correo){
    $('#idUEmpresam').val(id);
    $('#idUsuario').val(idUser);
    $('#cedulaUem').val(cedula);
    $('#nameUem').val(nombre);
    $('#apellidoUem').val(apellido);
    $('#uemTelefono').val(telefono);
    $('#uemCorreo').val(correo);

};


cambioEstatus = function(id,estatus){
    $.post(baseurl+"cadministrador/cambiaEstatus",
        {
            idUsuario:id,
            estatus:estatus,

        },
        function(data){
            if (data) {
                location.reload();
            }
        });

};


$('#UpdUsuarioEmpresa').click(function(){
    var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var id = $('#idUEmpresam').val();
    var idUsuario = $('#idUsuario').val();
    var telefono= $('#uemTelefono').val();
    var cedula = $('#cedulaUem').val();
    var nombre = $('#nameUem').val();
    var apellido = $('#apellidoUem').val();
    var correo = $('#uemCorreo').val();

            if(correo == "" || !expr.test(correo)) {
                $("#correoUem").html("<span>Debe ingresar un correo valido</span>");
                selUsuarioEmpresa(id,cedula, nombre, apellido, telefono,correo);
            }else {
                $.post(baseurl + "empresa/updUsuarioE",
                    {
                        id: id,
                        telefono: telefono,
                        cedula: cedula,
                        nombre: nombre,
                        apellido: apellido,
                        correo: correo,
                        usuario: idUsuario
                    },
                    function (data) {
                        alertify.success("Operación realizada con éxito");
                        $('#mbtnCerrarModalUe').click();
                        location.reload();

                    });
            } 
           
   

});

selClave = function(idUser){
    $('#idUsuarioc').val(idUser);
    $('#nuevaClave').bootstrapValidator('resetForm', true);
    $("input[type='password']").val(''); //asignacion de clave a un input tipo ppassword , le asigno vacio para limpiar

};

$('#mbtnCerrarModalUe').click(function(){
    $("#sexoUeM").html("<span></span>");
    $("#cedulaUeM").html("<span></span>");
    $("#nameUeM").html("<span></span>");
    $("#apellidoUeM").html("<span></span>");
});

$('#mbtnUpdClave').click(function(){
    var idUsuario = $('#idUsuarioc').val();
    var clave = $('#clave').val();
    var clavec = $('#clavec').val();

    if((clave==clavec)&&(clave!='')&&(clave.length>6)) {
        $.post(baseurl + "cusuario/cambiarClave",
            {
                id: idUsuario,
                clave: clave
            },
            function (data) {
                alertify.success("Operación realizada con éxito");
                $('#mbtnCerrarModal').click();
                location.reload();

            });
    }
});