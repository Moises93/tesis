function showEdit(editableObj) {
            $(editableObj).css("background","#CCDCE6");
        } 

function saveToDatabaseSexo(obj,editableObj,column,id) {
            $(obj).css("background","#FFFFFF no-repeat right");
             
           var sexo = document.getElementById(editableObj).value;      
            $.ajax({
                url: baseurl+"profesor/update_profesor",
                type: "POST",
                data:'column='+column+'&editval='+sexo+'&id='+id,
                success: function(data){
                  
                  $(obj).css("background","#FDFDFD");
                     $('td:nth-child(7)').hide();
                     $('th:nth-child(7)').hide(); 
                     $('td:nth-child(6)').show();
                     $('th:nth-child(6)').show(); 
                 location.reload();//Recargar Pagina 
                }        
           });
}
function saveToDatabaseTipo(obj,editableObj,column,id) {
            $(obj).css("background","#FFFFFF no-repeat right");
             
           var tipo = document.getElementById(editableObj).value;      
            $.ajax({
                url: baseurl+"profesor/update_profesor",
                type: "POST",
                data:'column='+column+'&editval='+tipo+'&id='+id,
                success: function(data){
                  
                  $(obj).css("background","#FDFDFD");
                     $('td:nth-child(10)').hide();
                     $('th:nth-child(10)').hide(); 
                     $('td:nth-child(9)').show();
                     $('th:nth-child(9)').show(); 
                 location.reload();//Recargar Pagina 
                }        
           });
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
        var cantidad = 5;//cantidad de profesores
       // console.log(p);
        $.each(p, function (i, item) {

            $('#tProfesor').append('<option value="'+item.id_tipo+'">'+item.pro_tipo+'</option>'
            );
            for (var i = 0; i < cantidad; i++) {
              $('#'+i+'tipoProfesor').append('<option value="'+item.id_tipo+'">'+item.pro_tipo+'</option>'
              );
            }
           /* $('#'+j+'tipoProfesor').append('<option value="'+item.id_tipo+'">'+item.pro_tipo+'</option>'
            );
           */
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


