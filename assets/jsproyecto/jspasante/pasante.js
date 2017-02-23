/**
 * Created by eheredia on 23/02/2017.
 */
/*$('#pasanteForm').bootstrapValidator({

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

});*/

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


    if(cedula != '' && nombre != '') {
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
        "url":baseurl+"cpasante/get_pasantes",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'pas_id','sClass':'dt-body-center'},
        {data: 'pas_cedula'},
        {data: 'pas_nombre'},
        {data: 'pas_apellido'},
        {data: 'pas_sexo'},
        {data: 'id_usuario'},//,
        {data: 'id_escuela'}//,
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

