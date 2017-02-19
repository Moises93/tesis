/**
 * Created by Moises on 24-01-2017.
 */

//Aqui lleno el data Combo de tipoUsuario
$.post(baseurl + "cadministrador/get_tipo",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbTipos').append('<option value="'+item.id_tipo+'">'+item.tipo+'</option>'
            );
        });
    });

function valor_select() {
    //var valor = document.getElementById('cbTipos').value;
    var valor = $("#cbTipos option:selected").text();
    if(valor== "pasante"){
        $('#userOption').append('   <div class="col-sm-5">'+
        '<label for="email" class="control-label">Email</label>'+
            '<input type="email" class="form-control" id="email" name="email" placeholder="Email">'+
            '</div>'+
            '<div class="col-sm-5">'+
            '<div class="form-group">'+
            '<label>Tipo</label>'+
            '<select id="cbTipos" class="form-control" name="tipo" onchange="valor_select();">'+
            '<option value="">seleccione:</option>'+
        '</select>'+
       ' </div>'+
        '</div>' );
    }


}
/*$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );*/


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

    // Valida algun cambio en Sucursal
    $('#paisId').change(function(e) {
        var idsuc = $(this).val();
        if (idsuc == ''){
            idsuc = null;
        }

        $.post (baseurl  + "empresa/EstdadosxPais", { pais : idsuc }, function(res) {

            // Parsea
            var json = $.parseJSON(res);

            // Muestra los resultados
            var estados = json;
            var lp = estados.length;
            $('#estadoId').html('<option value="">Seleccione Estado</option>');
            for (var i = 0; i < lp; i++) {
                var opt = '<option value=' + '"'+estados[i].id + '"'+'>' + estados[i].estadonombre  +'</option>';
                $('#estadoId').append(opt);
            }

            // Refresca
          //  $('#estadoId').selectpicker('refresh');

        });
    });

/*$('#agregarEmpresa').click(function () {
/*esta validando el formulario porque la etiqueta form de la vista sigue siendo pasanteForm cambiarlo y validar nuevo o 
colocar etiqueta generica*/
  /*  var rif = $('#rif').val();
    var nombre = $('#nombreE').val();
    var email = $('#emailE').val();
    var login = $('#loginE').val();
    var clave = $('#claveE').val();
    var foto = $('#foto').val();
    //var clase = $('#mtxtClase').val();
alert(foto);
/*alert(nombre);
alert(email);
alert(login);
alert(clave);*/

    /*if(cedula != '' && nombre != '') {
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
    }*/

//});