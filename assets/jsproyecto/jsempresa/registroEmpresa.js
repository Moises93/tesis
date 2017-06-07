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
        {data: 'emp_correo'},
        {orderable: 'true',
            render: function (data,type,row) {
                //console.log(row);
                return '<a href="#" data-toggle="modal" ' +
                    'data-target="#modalEditEmpresa" ' +
                    'onClick="selEmpresa(\'' + row.emp_id + '\',\'' + row.emp_rif + '\',\'' + row.emp_nombre + '\',\'' + row.emp_telefono + '\',\'' + row.emp_correo + '\');"><span class="glyphicon glyphicon-edit" </span></a>';


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
selEmpresa= function(id,rif, nombre, telefono, correo){
  
    $('#idEmpresa').val(id);
    $('#rifE').val(rif);
    $('#nameE').val(nombre);
    $('#correoE').val(correo);
    $('#telefonoE').val(telefono);

};

$('#actualizarEmpresa').click(function(){
    var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var id =   $('#idEmpresa').val();
    var telefono= $('#telefonoE').val();
    var rif = $('#rifE').val();
    var nombre =  $('#nameE').val();
    var correo = $('#correoE').val();

    if(correo == "" || !expr.test(correo)) {
        $("#correoeM").html("<span>Debe ingresar un correo valido</span>");
        selEmpresa(id,rif, nombre, telefono,correo);
    }else {
        $.post(baseurl + "empresa/actualizarEmpresa",
            {
                id: id,
                telefono: telefono,
                rif: rif,
                nombre: nombre,
                correo: correo,
            },
            function (data) {
                $('#mbtnCerrarModal1').click();
                alertify.success("Operación realizada con éxito");

                location.reload();

            });
    }



});