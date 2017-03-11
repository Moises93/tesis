/**
 * Created by Moises on 04-03-2017.
 */
$(document).ready(function(e) {

    $('#tblAsignarTutores').DataTable({
        "language": {
            "url": baseurl + "/assets/json/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,
        'autoWidth': false, //esta es a opcion que hace que la tabla sea adaptativa

        'ajax': {
            "url": baseurl + "cpasantia/getIntegrantesPasantia",
            "type": "POST",
            dataSrc: ''
        }, 'columns': [
            {data: 'cedula', 'sClass': 'dt-body-center'},
            {
                "render": function (data, type, row) {
                    return '<span>' + row.nombre + ' ' + row.apellido + '</span>';
                }
            },
            {data: 'escuela', 'sClass': 'dt-body-center'},
            {
                "render": function (data, type, row) {
                    if (row.integrantes.academico == null) {
                        return '<a href="#"  data-toggle="modal" ' +
                            'data-target="#modalAsignarTutor" ' +
                            'onClick="selTutor(\'' + null + '\',\'' + row.id_pasantia + '\',\'' + row.id_escuela + '\');">Asignar</a>';
                    } else {
                        return '<span>' + row.integrantes.academico.info.pro_nombre + ' ' + row.integrantes.academico.info.pro_apellido + '</span>&emsp;' +
                            '<a href="#"  data-toggle="modal" ' +
                            'data-target="#modalAsignarTutor" ' +
                            'onClick="selTutor(\'' + row.integrantes.academico.info.pro_id + '\',\'' + row.id_pasantia + '\',\'' + row.id_escuela + '\');">Cambiar</a>';
                    }
                }
            }

        ]

    });


    $('#tblAsignarTutorO').DataTable({
        "language": {
            "url": baseurl + "/assets/json/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,
        'autoWidth': false, //esta es a opcion que hace que la tabla sea adaptativa

        'ajax': {
            "url": baseurl + "cpasantia/getIntegrantesPasantia",
            "type": "POST",
            dataSrc: ''
        }, 'columns': [
            {data: 'cedula', 'sClass': 'dt-body-center'},
            {
                "render": function (data, type, row) {
                    return '<span>' + row.nombre + ' ' + row.apellido + '</span>';
                }
            },
            {data: 'escuela', 'sClass': 'dt-body-center'},
            {
                "render": function (data, type, row) {
                    if (row.integrantes.organizacional == null) {
                        if(row.orgaca == null){
                            return '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorO" ' +
                                'onClick="selTutorOrg(\'' + null + '\',\'' + row.id_pasantia + '\',\'' + row.empresa_id + '\',\'' + row.empresa + '\');">Asignar</a>';
                        }else if(row.orgaca != null){
                            return '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorOp" ' +
                                'onClick="selTutorOrgAca(\'' + null + '\',\'' + row.id_pasantia + '\');">Asignar</a>';
                        }
                    } else {
                        if(row.orgaca == null) {
                            return '<span>' + row.integrantes.organizacional.info.nombre + ' ' + row.integrantes.organizacional.info.apellido + '</span>&emsp;' +
                                '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorO" ' +
                                'onClick="selTutorOrg(\'' + row.integrantes.organizacional.info.id + '\',\'' + row.id_pasantia + '\',\'' + row.empresa_id + '\',\'' + row.empresa + '\');">Cambiar</a>';
                        }else if(row.orgaca != null){
                            return '<span>' + row.integrantes.organizacional.info.nombre + ' ' + row.integrantes.organizacional.info.apellido + '</span>&emsp;' +
                                '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorOp" ' +
                                'onClick="selTutorOrgAca(\'' + row.integrantes.organizacional.info.id + '\',\'' + row.id_pasantia + '\');">Cambiar</a>';
                        }
                    }
                }
            }

        ]

    });
});
function cargarTutorOp() {
    idEscu = $("#cbEscuela option:selected").val();

    $.post(baseurl+"profesor/obtProfesorPorEscuela",
        {
            idEscuela: idEscu,
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTutorOp').append('<option value="'+item.pro_id+'">'+item.pro_nombre+' '+item.pro_apellido+'</option>'
                );
            });

        });

}
selTutorOrgAca = function(idPro,idPasantia){

}
//con esta funcion pasamos los paremtros a los text del modal.
selTutor = function(idPro,idPasantia,escuela){

    idEsc=escuela;
    idTipo=1; //este es el tipo de profesor en este caso queremos buscar tutores academicos , que son prof. tipo 1
    //ahora solo por escuela me traigo todos los tipos ya que coordinador puede ser tutor
    $('#cbTutorA').empty().append('<option value="-1">seleccione:</option>'); //la solucion para limpiar los data combos
    $('#idPasantia').val(idPasantia); //imput oculto en el modal
    $.post(baseurl+"profesor/obtProfesorPorEscuela",
        {
            idEscuela: idEsc,
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTutorA').append('<option value="'+item.pro_id+'">'+item.pro_nombre+' '+item.pro_apellido+'</option>'
                );
            });
            if(idPro != "null" && idPro != '' ){
                $('#cbTutorA').val(idPro);
            }
        });

};

selTutorOrg =function (idOrg, idPasantia,idEmp,empresa) {
    
    $('#organizacion').val(empresa);
    idEmpre= idEmp;

         $.post(baseurl+"empresa/getUsuarioDeEmpresa",
        {
            empId: idEmpre,
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbTutorO').append('<option value="'+item.idusuario_empresa+'">'+item.uem_nombre+' '+item.uem_apellido+'</option>'
                );
            });
            if(idOrg != "null" && idOrg != '' ){
                $('#cbTutorO').val(idOrg);
            }
        });
   
}
/*Accion del boton Actualizar en el modal asignarTutores*/
$('#mbtnUpdTutor').click(function () {
    var idPasantia = $('#idPasantia').val();
    var tutorA =$('select[name=cbTutorA]').val();
    var tipo= 1; // siempre va ser 1 porque 1 significa tutorAcademico en la tabla integrantes_pasantias(aplica para esta funcion)
    if(tutorA=='-1'){
        alert('Debe ingresar un tutor o cancelar la operación');
    }else{
        $.post(baseurl + "coordinador/agregarTutorA",
            {
                idPasantia: idPasantia,
                tutorA: tutorA,
                tipo:tipo
            },
            function (data) {
                if (data) {
                    $('#mbtnCerrarModal').click();
                    alert(data);
                    location.reload();
                }
            });
    }

});

