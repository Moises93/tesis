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

$('#tblEmpresa').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,

    'ajax': {
        "url":baseurl+"empresa/getEmpresa",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'emp_id','sClass':'dt-body-center'},
        {data: 'emp_rif'},
        {data: 'emp_nombre'},
        {data: 'emp_telefono'},
        {
            "render": function (data, type, row) {
                return '<span>' + row.paisnombre + '/' + row.estadonombre + '/' + row.ciudad + '</span>';
            }
        },
        {data: 'emp_email_contacto'},
        {orderable: 'true',
            render: function (data,type,row) {
                console.log(row);
                return '<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                    'data-target="#modalEditEmpresa" ' +
                    'onClick="selEmpresa(\'' + row.emp_id + '\',\'' + row.emp_rif + '\',\'' + row.emp_nombre + '\',\'' + row.emp_foto + '\',\'' + row.emp_email_contacto + '\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editars</a>';


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

//con esta funcion pasamos los paremtros a los text del modal.
selEmpresa= function(id,rif, nombre, foto, correo){
  
    $('#idEmpresa').val(id);
    $('#rifE').val(rif);
    $('#nameE').val(nombre);
   // $('#fotoE').val(nombre);//error con foto
    $('#correoE').val(correo);

};
