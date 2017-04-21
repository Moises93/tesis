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
            {
                "render": function (data, type, row) {
                    if(row.pro_tipo =='Coordinador'){
                        return '<span>' + row.Apellido + ' ' + row.Nombre +' ('+ row.pro_tipo +')</span>';
                    }else{
                        return '<span>' + row.Apellido + ' ' + row.Nombre +' </span>';
                    }
                }
            },
            {data: 'esc_nombre'},
            {data: 'usu_correo'},
            {data: 'Tel'},
            {orderable: 'true',
                render: function (data,type,row) {
                    return '<a href="#" data-toggle="modal" ' +
                        'data-target="#modalEditProfesor" ' +
                        'onClick="selProfesor(\'' + row.pro_id + '\',\'' + row.usu_correo + '\',\'' + row.pro_telefono + '\',\'' + row.id_usuario + '\');"><span class="glyphicon glyphicon-edit" </span></a>';


                }
            }
        ],

        /* "columnDefs": [
         {
         "targets": [4],
         "data": "emp_acceso",
         "render": function(data, type, row) {

         if (data == 0) {
         return '<a href="#" title="Habilitar Usuario" onClick="cambioEstatus(' + row.emp_id + ',' + 1 + ')"><span class="label label-danger">Inactivo &nbsp;</span><i style="color:green; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';
         }else if (data == 1) {
         return '<a href="#" title="Deshabilitar Usuario" onClick="cambioEstatus(' + row.emp_id + ',' + 0 + ')"><span class="label label-success">Activo</span><i style="color:red; padding-left: 1.8em;" class="glyphicon glyphicon-refresh"></i></a>';

         }

         }
         }
         ],*/
        "order": [[ 1, "asc" ]],
    });



    $('#exportar').click(function(e) {
      var path    =  baseurl + "profesor/profesor_list_csv";
      window.open(path,'_blank');
    });



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

selProfesor = function(idPro,correo,telefono,idUser){

    $('#idProfesor').val(idPro);
    $('#idUsuario').val(idUser);
    $('#correo').val(correo);
    if(telefono =="undefined"){
        $('#telefono').val('');
    }else{
        $('#telefono').val(telefono);
    }


};
$('#actualizarProfesor').click(function(){


    var expr        = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var idpro       = $('#idProfesor').val();
    var telefono    = $('#telefono').val();
    var correo      = $('#correo').val();
    var usuario     = $('#idUsuario').val();

    if(correo == "" || !expr.test(correo)) {
        $("#correoPro").html("<span>Debe ingresar un correo valido</span>");
        selEstudiante(idpas,telefono,correo);
    }else{
        $.post(baseurl+"profesor/actualizarProfesor",
            {
                usuario:usuario,
                correo:correo,
                telefono:telefono,
                idpro:idpro
            },
            function(data){
                alert(data);
                $('#mbtnCerrarModal').click();
                location.reload();
            });
    }



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


