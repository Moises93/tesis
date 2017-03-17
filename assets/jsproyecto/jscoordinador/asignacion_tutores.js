/**
 * Created by Moises on 04-03-2017.
 */
/*Atencion: etsar atennto a los comentario las funciones aqui cumplen un papel importante y especifico*/
$(document).ready(function(e) {
/*Llenado de la tabla Asignar Tutores Academicos*/
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
                        if(row.orgaca == null|| row.orgaca =='0' || row.orgaca == 'undefined' || row.orgaca == 0){
                            return '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorO" ' +
                                'onClick="selTutorOrg(\'' + null + '\',\'' + row.id_pasantia + '\',\'' + row.empresa_id + '\',\'' + row.empresa + '\');">Asignar</a>';
                        }else if(row.orgaca != 0){
                            return '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorOp" ' +
                                'onClick="selTutorOrgAca(\'' + null + '\',\'' + row.id_pasantia + '\');">Asignar</a>';
                        }
                    } else {
                        if(row.orgaca == null || row.orgaca =='0' || row.orgaca == 'undefined' || row.orgaca == 0) {
                            return '<span>' + row.integrantes.organizacional.info.nombre + ' ' + row.integrantes.organizacional.info.apellido + '</span>&emsp;' +
                                '<a href="#"  data-toggle="modal" ' +
                                'data-target="#modalAsignarTutorO" ' +
                                'onClick="selTutorOrg(\'' + row.integrantes.organizacional.info.id + '\',\'' + row.id_pasantia + '\',\'' + row.empresa_id + '\',\'' + row.empresa + '\');">Cambiar</a>';
                        }else if(row.orgaca != 0 ){
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
/************************Asignar Tutor Academico*******************************/
/*con esta funcion pasamos los paremtros a los text del modal.
  - se carga los profesores que pertenecen a la escuela del pasante
  - tomar en cuenta que un coordinador de escuela puede ser tutor academico
  */
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
/*Accion del boton Actualizar en el modal asignar Tutores Academicos.
 - nota: Siempre va ser Tipo 1 que significa tutor acadmeico en la tabla integrantes_pasantias
 - la funcion coordinador/agregarTutorA aplica para insert y update en la tabla integrantes pasantias
   por esta razon se llama al mismo modal ya se que se inserte tutor o se cambie.
 */

$('#mbtnUpdTutor').click(function () {
    var idPasantia = $('#idPasantia').val();
    var tutorA =$('select[name=cbTutorA]').val();
    var tipo= 1; // nota
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

/**************************Asignar Tutor Organizacional***************************************************/

/*En caso de que la pasania sea en la universidad, se carga un modal epecifico para este caso*/
function cargarTutorOp() {
    idEscu = $("#cbEscuela option:selected").val();
    $('#cbTutorOp').empty().append('<option value="-1">seleccione:</option>');
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
/*se inicializa el valor de idPasantia en el modal*/
selTutorOrgAca = function(idPro,idPasantia){
    $('#idPasantia').val(idPasantia); //imput oculto en el modal

}
/*asignamos un profesor como tutor organizacional */
$('#mbtnUpdTutorOp').click(function () {
    var idPasantia = $('#idPasantia').val();
    var tutorA =$('select[name=cbTutorOp]').val();
    var tipo= 2; // siempre va ser 2 porque 2 significa tutorAcademico en la tabla integrantes_pasantias(aplica para esta funcion)
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

/**Para el caso donde el tutor organizacional pertenece a una empresa*/
$('#mbtnUpdTutorO').click(function () {
    var idPasantia = $('#idPasantia').val();
    var tutorO =$('select[name=cbTutorO]').val();
    var tipo= 2; // siempre va ser 2 porque 2 significa tutorOrganizacional en la tabla integrantes_pasantias(aplica para esta funcion)
    if(tutorO=='-1'){
        alert('Debe ingresar un tutor o cancelar la operación');
    }else{
        $.post(baseurl + "coordinador/agregarTutorO",
            {
                idPasantia: idPasantia,
                tutorO: tutorO,
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

/*se inicializan los campos del modal tomando en cuenta la empresa donde se realiza la pasantia para cargar los tutores*/
selTutorOrg =function (idOrg, idPasantia,idEmp,empresa) {
    $('#idPasantia').val(idPasantia);
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



