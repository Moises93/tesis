/**
 * Created by Moises on 21-01-2017.
 */

//Aqui lleno el data Combo de tipoUsuario
$.post(baseurl + "cadministrador/get_tipo",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbTipo').append('<option value="'+item.id_tipo+'">'+item.tipo+'</option>'
                
            );
        });
    });
//Aqui lleno la Tabla de usuarios
$('#tblUsuarios').DataTable({
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,

    'ajax': {
        "url":baseurl+"cadministrador/get_usuario",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'id_usuario','sClass':'dt-body-center'},
        {data: 'tipo'},
        {data: 'usu_login'},
        {data: 'usu_clave'},
        {data: 'usu_estatus'},
        {data: 'usu_correo'},
        {orderable: 'true',
            render: function (data,type,row) {

                    return '<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                    'data-target="#modalEditUsuario" ' +
                    'onClick="selPersona(\'' + row.id_usuario + '\',\'' + row.tipo + '\',\'' + row.usu_login + '\',\'' + row.usu_clave + '\',\'' + row.usu_correo + '\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editar</a>';

                
            }
        }
    ],
    "columnDefs": [
        {
            "targets": [4],
            "data": "usu_estatus",
            "render": function(data, type, row) {

                if (data == 0) {
                    return '<a href="#" title="Habilitar Usuario" onClick="cambioEstatus(' + row.id_usuario + ',' + 1 + ')"><span class="label label-danger">Inactivo &nbsp;</span><i style="color:green; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';
                }else if (data == 1) {
                    return '<a href="#" title="Deshabilitar Usuario" onClick="cambioEstatus(' + row.id_usuario + ',' + 0 + ')"><span class="label label-success">Activo</span><i style="color:red; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';

                }

            }
        }
    ],
    "order": [[ 1, "asc" ]],
});



cambioEstatus=function(id,estatus){
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


//con esta funcion pasamos los paremtros a los text del modal.
selPersona = function(id,tipo, usu_login, usu_clave, usu_correo){
    $('#mhdnIdUsuario').val(id);
    $('#mtxtLogin').val(usu_login);
    $('#mtxtClave').val(usu_clave);
    $('#mtxtCorreo').val(usu_correo);

};

//metodo update del modal incluyendo su validacion
$('#mbtnUpdUsuario').click(function(){
    $("#loginM").html("<span></span>");
    $("#tipoM").html("<span></span>");
    $("#claveM").html("<span></span>");
    $("#correoM").html("<span></span>");

    var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var idUsuario = $('#mhdnIdUsuario').val();
    var tipo= $('select[name=tipo]').val();
    var login = $('#mtxtLogin').val();
    var clave = $('#mtxtClave').val();
    var correo = $('#mtxtCorreo').val();
   
    if (tipo == "-1"){
        $("#tipoM").html("<span>Debe agregar un Tipo</span>");
        selPersona(idUsuario,tipo,login,clave,correo);
    }else if(login == "") {
        $("#loginM").html("<span>Debe agregar un Login</span>");
        selPersona(idUsuario,tipo,login,clave,correo);
    }else if (login.length > 0){
        $.post(baseurl+"cadministrador/val_login",
            {
                login: login,
            },
            function(data){
                var p = JSON.parse(data);
                console.log(p);
                if (p.num_rows>1) {
                    $("#loginM").html("<span>Este Login ya esta en uso</span>");
                    selPersona(idUsuario,tipo,login,clave,correo);
                }else if(clave.length < 5 ) {
                    $("#claveM").html("<span>Debe ingresar una clave mayor a 4 caracteres</span>");
                    selPersona(idUsuario,tipo,login,clave,correo);
                    }else if(correo == "" || !expr.test(correo)) {
                        $("#correoM").html("<span>Debe ingresar un correo valido</span>");
                        selPersona(idUsuario,tipo,login,clave,correo);
                    }else{
                        $.post(baseurl+"cadministrador/updUsuario",
                            {
                                mhdnIdUsuario:idUsuario,
                                tipo:tipo,
                                mtxtLogin:login,
                                mtxtClave:clave,
                                mtxtCorreo:correo
                            },
                            function(data){
                                if (data == 1) {
                                    $('#mbtnCerrarModal').click();

                                    location.reload();
                                }
                            });
                    }
            });
    }

});
//funciones a hacer cuando cerramos el modal
$('#mbtnCerrarModal1').click(function(){
    $("#loginM").html("<span></span>");
    $("#tipoM").html("<span></span>");
    $("#claveM").html("<span></span>");
    $("#correoM").html("<span></span>");
});
$('#mbtnCerrarModal2').click(function(){
    $("#loginM").html("<span></span>");
    $("#tipoM").html("<span></span>");
    $("#claveM").html("<span></span>");
    $("#correoM").html("<span></span>");
});
