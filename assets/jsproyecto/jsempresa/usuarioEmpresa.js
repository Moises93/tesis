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
        {data: 'uem_sexo'},
        {data: 'tuem_id'},
        {data: 'emp_id'},
        {data: 'id_usuario'},
        {orderable: 'true',
            render: function (data,type,row) {
                return '<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                    'data-target="#modalEditUsuarioE" ' +
                    'onClick="selUsuarioEmpresa(\'' + row.idusuario_empresa + '\',\'' + row.uem_cedula + '\',\'' + row.uem_nombre + '\',\'' + row.uem_apellido + '\',\'' + row.uem_sexo + '\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editart</a>';


            }
        }
    ],


    "order": [[ 1, "asc" ]],
});


selUsuarioEmpresa= function(id,cedula, nombre, apellido, sexo){
    $('#idUEmpresam').val(id);
    $('#cedulaUem').val(cedula);
    $('#nameUem').val(nombre);
    $('#apellidoUem').val(apellido);
    $('#sexoUem').val(sexo);

};

$('#UpdUsuarioEmpresa').click(function(){
    var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var id = $('#idUEmpresam').val();
    var sexo= $('select[name=sexoUem]').val();
    var cedula = $('#cedulaUem').val();
    var nombre = $('#nameUem').val();
    var apellido = $('#apellidoUem').val();

  
                    $.post(baseurl+"empresa/updUsuarioE",
                        {
                            id:id,
                            sexo:sexo,
                            cedula:cedula,
                            nombre:nombre,
                            apellido:apellido
                        },
                        function(data){
                            if (data == 1) {
                                $('#mbtnCerrarModalUe').click();

                                location.reload();
                            }
                        });
           
   

});

$('#mbtnCerrarModalUe').click(function(){
    $("#sexoUeM").html("<span></span>");
    $("#cedulaUeM").html("<span></span>");
    $("#nameUeM").html("<span></span>");
    $("#apellidoUeM").html("<span></span>");
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