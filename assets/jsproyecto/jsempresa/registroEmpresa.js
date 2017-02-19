/**
 * Created by Moises on 19-02-2017.
 */

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