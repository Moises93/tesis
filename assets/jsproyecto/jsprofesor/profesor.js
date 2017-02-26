function showEdit(editableObj) {
            $(editableObj).css("background","#CCDCE6");
        } 
function saveToDatabase(editableObj,column,id) {
            $(editableObj).css("background","#FFFFFF no-repeat right");
            $.ajax({
                url: baseurl+"profesor/update_profesor",
                type: "POST",
                data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
                success: function(data){
                    $(editableObj).css("background","#FDFDFD");
                }        
           });
}

$(document).ready(function(e) {
//Lleno el datacombo de Tipo Profesor
$.post(baseurl + "profesor/get_tipoProfesor",
    function(data) {
        var p = JSON.parse(data);
       // console.log(p);
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


