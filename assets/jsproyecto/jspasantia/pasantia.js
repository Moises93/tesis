/**
 * Created by Moises on 28-02-2017.
 */
$(document).ready(function(e) {

    document.getElementById('escuelao').style.display='none';
    document.getElementById('labOrg').style.display='none';
    document.getElementById('cbEmpresa').style.display='none';

$.post(baseurl + "empresa/getEmpresa",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbEmpresa').append('<option value="'+item.emp_id+'">'+item.emp_nombre+'</option>'

            );
        });
    });


//$('#cbPostulados').empty().append('<option value="-1">seleccione:</option>');
/*muestro el login de acces del pasante que es Unico y evitar confuncion por nombres repetidos*/


    $.post(baseurl + "cpasante/getPostulados",
        function(data) {
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbPostulados').append('<option value="'+item.pas_id+'">'+item.usu_login+'</option>'

                );
            });
        });

    $('#duracion').daterangepicker(
        {
            locale: {
                format: 'DD/MM/YYYY'
            }
        },
        function(start, end, label) {
            alert("A new date range was chosen: " + start.format('DD-MM-YYY') + ' to ' + end.format('DD-MM-YYY'));
        });



$('#agregarPasantia').click(function () {

    var modalidad = $('#modalidad').val();
    var escuela = $('select[name=escuela]').val();
    var estudiante =$('select[name=cbPostulados]').val();
    var empresa = $('select[name=cbEmpresa]').val();
    var orgaca =$('select[name=escuelao]').val();
    var fecha = $('#reservation').val().split('-');
    var fechaIni=fecha[0];
    var fechaFin=fecha[1];
    /*var fechaIni=fecha[0].replace("/","-");
    var fechaFin=fecha[1].replace("/","-");*/

    
    
        if(orgaca<0){
            orgaca=null;
        }
    
        $.post(baseurl + "cpasantia/agregarPasantia",
            {
                modalidad: modalidad,
                empresa: empresa,
                orgaca: orgaca,
                escuela: escuela,
                estudiante: estudiante,
                fechaIni: fechaIni,
                fechaFin: fechaFin
            },
            function (data) {
                if (data) {
                    alert("Insercion exitosa");
                    location.reload();
                }
            });

});

    $('#tabPasantias').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,

        'ajax': {
            "url":baseurl+"cpasantia/getPasantia",
            "type":"POST",
            dataSrc: ''
        },'columns': [
            {data: 'id_pasantia','sClass':'dt-body-center'},
            {data: 'estatus'},
            {"render": function ( data, type, row ) {
                return '<span>' + row.pas_nombre +' ' +row.pas_apellido+'</span>';
            }},
            {"render": function ( data, type, row ) {
                return '<span>' + row.fecha_inicio +'-' +row.fecha_final+'</span>';
            }},
            
            {"render": function ( data, type, row ) {
                if(row.orgaca == null || row.orgaca =='0' || row.orgaca == 'undefined' || row.orgaca == 0){
                    return '<span>' + row.emp_nombre +'</span>';
                }else{
                    return '<span>Universidad de Carabobo </span>&emsp;' ;
                }
            }},
            
            {data: 'esc_nombre'},
            {
                orderable: 'true',
                render: function (data, type, row) {
                      
                    return '<a href="#"  data-toggle="modal" ' +
                        'data-target="#modalEditPasantia" ' +
                        'onClick="selPasantia(\'' + row.id_pasantia + '\');">' +
                        '<span class="glyphicon glyphicon-edit" </span></a>' +

                        '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                        'data-target="#modalInfoPasantia" ' +
                        'onClick="selInfo(\'' + row.pas_nombre + '\',\'' + row.pas_apellido + '\',\'' + row.fecha_inicio + '\',\'' + row.fecha_final + '\',\'' + row.emp_nombre + '\');"><i class="fa fa-search" aria-hidden="true"></i></a>';
                        
                }
            }

        ],

    });


});

selPasantia = function(idPas){

    $('#idPasantia').val(idPas);

    document.getElementById('escuelam').style.display='none';
    document.getElementById('labOrgm').style.display='none';
    document.getElementById('cbEmpresam').style.display='none';


};

selInfo = function(nombre,apellido,fechaI,fechaF,empresa){

    //$('#idPasantia').val(idPas);
    $("#empresaInfo").html("<span>"+empresa+"</span>");
    

};

$.post(baseurl + "empresa/getEmpresa",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbEmpresam').append('<option value="'+item.emp_id+'">'+item.emp_nombre+'</option>'

            );
        });
    });

function  mostrarOrg() {
    idOrg=$("#cbOrganizacion option:selected").val();
    if(idOrg == 1){
        document.getElementById('escuelao').style.display='none';
        document.getElementById('cbEmpresa').style.display='block';
        document.getElementById('labOrg').style.display='block';
    }else if(idOrg == 2){
        document.getElementById('cbEmpresa').style.display='none';
        document.getElementById('escuelao').style.display='block';
        document.getElementById('labOrg').style.display='block';
    }else if(idOrg<0){
        document.getElementById('escuelao').style.display='none';
        document.getElementById('labOrg').style.display='none';
        document.getElementById('cbEmpresa').style.display='none';
    }
}
/*esta funcion la uso para el modal de edicion*/
function  mostrarOrgm() {
    idOrg=$("#cbOrganizacionm option:selected").val();
    if(idOrg == 1){
        document.getElementById('escuelam').style.display='none';
        document.getElementById('cbEmpresam').style.display='block';
        document.getElementById('labOrgm').style.display='block';
    }else if(idOrg == 2){
        document.getElementById('cbEmpresam').style.display='none';
        document.getElementById('escuelam').style.display='block';
        document.getElementById('labOrgm').style.display='block';
    }else if(idOrg<0){
        document.getElementById('escuelam').style.display='none';
        document.getElementById('labOrgm').style.display='none';
        document.getElementById('cbEmpresam').style.display='none';
    }
}

$('#actualizarPasantia').click(function(){
    var idPasantia = $('#idPasantia').val();

    var empresa = $('select[name=cbEmpresam]').val();
    var orgaca =$('select[name=escuelam]').val();
    var fecha = $('#duracion').val().split('-');
    var fechaIni=fecha[0];
    var fechaFin=fecha[1];

    

    if(orgaca<0){
        orgaca=null;
    }

    $.post(baseurl + "cpasantia/actualizarPasantia",
        {
            empresa: empresa,
            orgaca: orgaca,
            fechaIni: fechaIni,
            fechaFin: fechaFin,
            idPasantia:idPasantia
        },
        function(data){
            alert(data);
            $('#mbtnCerrarModal').click();
            location.reload();
        });
});






function cargarTutorE() {

    idEmp = $("#cbEmpresa option:selected").val();
    $('#cbTEmpresa').empty().append('<option value="-1">seleccione:</option>'); //la solucion para limpiar los data combos
    $.post(baseurl+"empresa/getUsuarioDeEmpresa",
        {
            empId: idEmp,
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTEmpresa').append('<option value="'+item.idusuario_empresa+'">'+item.uem_nombre+' '+item.uem_apellido+'</option>'
                );
            });
        });

    //  $('#buscarPermiso').attr("disabled", false);


}

function cargarTutorA() {

    // idEsc = $("#cbEmpresa option:selected").val(); OJO como el caso de uso era solo para computacion el IdEscuela va ser 1
    idEsc=1;
    idTipo=1; //este es el tipo de profesor en este caso queremos buscar tutores academicos , que son prof. tipo 1
    //$('#cbTEmpresa').empty().append('<option value="-1">seleccione:</option>'); //la solucion para limpiar los data combos
    $.post(baseurl+"profesor/get_ProfesoresTipo",
        {
            idEscuela: idEsc,
            idTipo: idTipo
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTutorA').append('<option value="'+item.pro_id+'">'+item.pro_nombre+' '+item.pro_apellido+'</option>'
                );
            });
        });

    //  $('#buscarPermiso').attr("disabled", false);


}