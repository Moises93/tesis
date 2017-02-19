/**
 * Created by Moises on 19-02-2017.
 */
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

/*$('#agregarUe').click(function () {

         var cedula = $('#cedulaUe').val();
         var nombre = $('#nombreUe').val();
         var apellido = $('#apellidoUe').val();
         var sexo = $('#sexoUe').val();
         var email = $('#emailUe').val();
         var login = $('#loginUe').val();
         var clave = $('#claveUe').val();
         var tipo = $('#tipoUe').val();
         var empresa = $('#empresaUe').val();
         //var clase = $('#mtxtClase').val();
         alert(cedula);
         alert(apellido);
         alert(nombre);
         alert(sexo);
         alert(email);
         alert(login);
         alert(clave);
         alert(tipo);
         alert(empresa);
});
*/