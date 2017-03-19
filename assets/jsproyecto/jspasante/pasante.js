/**
 * Created by eheredia on 23/02/2017.
 */
$('#pasanteForm').bootstrapValidator({

    message: 'Este valor no es valido',

    feedbackIcons: {

        valid: 'glyphicon glyphicon-ok',

        invalid: 'glyphicon glyphicon-remove',

        validating: 'glyphicon glyphicon-refresh'

    },

    fields: {

        cedula: {

            validators: {

                notEmpty: {

                    message: 'La Cedula es requerida'

                }

            }

        },

        nombre: {

            validators: {

                notEmpty: {

                    message: 'El nombre es requerido'

                }

            }

        },
        apellido: {

            validators: {

                notEmpty: {

                    message: 'El apellido es requerido'

                }

            }

        },
        email: {

            validators: {

                notEmpty: {

                    message: 'El correo es requerido y no puede ser vacio'

                },

                emailAddress: {

                    message: 'El correo electronico no es valido'

                }

            }

        },
        sexo: {

            validators: {

                notEmpty: {

                    message: 'El sexo es requerido'

                }

            }

        },
        escuela: {

            validators: {

                notEmpty: {

                    message: 'La Escuela es requerido'

                }

            }

        },
        login: {

            validators: {

                notEmpty: {

                    message: 'El sexo es requerido'

                }

            }

        },
        clave: {

            validators: {

                notEmpty: {

                    message: 'El password es requerido y no puede ser vacio'

                },

                stringLength: {

                    min: 6,

                    message: 'El password debe contener al menos 8 caracteres'

                }

            }

        }


    }

});
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

        clavee: {

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
                    field: 'clavee',
                    message: 'La clave debe ser la misma'
                },


            }

        }
    }
});

$('#agregarPasante').click(function () {

    var cedula = $('#cedula').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var sexo = $('select[name=sexo]').val();
    var email = $('#email').val();
    var escuela = $('#escuela').val();
    var login = $('#login').val();
    var clave = $('#clave').val();
    //var clase = $('#mtxtClase').val();


    if(cedula != '' && nombre != '' && nombre != 'clave') {
        $.post(baseurl + "cadministrador/agregarPasante",
            {
                cedula: cedula,
                nombre: nombre,
                apellido: apellido,
                sexo: sexo,
                email: email,
                escuela: escuela,
                login: login,
                clave: clave
            },
            function (data) {
                console.log(data);
                if (data) {
                    //$('#mbtnCerrarModalP').click();

                    location.reload();
                }
            });
    }else{
        alert("debe rellenar todos los datos!");
    }

});


$('#tblPasantes').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,

    'ajax': {
        "url":baseurl+"cpasante/getEstudiantes",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'pas_id','sClass':'dt-body-center'},
        {data: 'pas_cedula'},
        {
            "render": function (data, type, row) {
                return '<span>' + row.pas_apellido + ' ' + row.pas_nombre + ' </span>';
            }
        },
        {data: 'pas_sexo'},
        {data: 'esc_nombre'},
        {data: 'usu_correo'},
        {data: 'pas_telefono'},
        {orderable: 'true',
             render: function (data,type,row) {

             return '<a href="#"  data-toggle="modal" ' +
             'data-target="#modalEditEstudiante" ' +
             'onClick="selEstudiante(\'' + row.pas_id + '\',\'' + row.pas_telefono + '\',\'' + row.usu_correo + '\',\'' + row.id_usuario + '\');"><span class="glyphicon glyphicon-edit" </span></a>'+

             '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
             'data-target="#modalEditClave" ' +
             'onClick="selClave(\'' + row.id_usuario + '\');"><i class="fa fa-key" aria-hidden="true"></i></a>';/*+

             '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
             'data-target="#modalEditEstudiante" ' +
             'onClick="selEstudiante(\'' + row.pas_id + '\',\'' + row.pas_telefono + '\',\'' + row.usu_correo + '\',\'' + row.id_usuario + '\');"><span class="glyphicon glyphicon-edit" </span></a>';*/
            }
         }
    ]
});
selEstudiante = function(idPas,telefono,correo,idUser){

    $('#idPasante').val(idPas);
    $('#idUsuario').val(idUser);
    $('#correo').val(correo);
    $('#telefono').val(telefono);


};

selClave = function(idUser){
    $('#idUsuarioc').val(idUser);
    $('#nuevaClave').bootstrapValidator('resetForm', true);
    $("input[type='password']").val(''); //asignacion de clave a un input tipo ppassword , le asigno vacio para limpiar

};

$('#mbtnUpdEstudiante').click(function(){


    var expr        = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var idpas       = $('#idPasante').val();
    var telefono    = $('#telefono').val();
    var correo      = $('#correo').val();
    var usuario     = $('#idUsuario').val();

                if(correo == "" || !expr.test(correo)) {
                    $("#correoM").html("<span>Debe ingresar un correo valido</span>");
                    selEstudiante(idpas,telefono,correo);
                }else{
                    $.post(baseurl+"cpasante/updEstudiante",
                        {
                            usuario:usuario,
                            correo:correo,
                            telefono:telefono,
                            idpas:idpas
                        },
                        function(data){
                            alert(data);
                            $('#mbtnCerrarModal').click();
                            location.reload();
                        });
                }



});

$('#mbtnUpdClave').click(function(){
    var idUsuario = $('#idUsuarioc').val();
    var clave = $('#clavee').val();
    var clavec = $('#clavec').val();
    if((clave==clavec)&&(clave!='')&&(clave.length>6)){
        $.post(baseurl + "cusuario/cambiarClave",
            {
                id: idUsuario,
                clave: clave
            },
            function (data) {
                alert(data);
                $('#mbtnCerrarModal').click();
                location.reload();

            });
    }
});