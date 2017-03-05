/**
 * Created by Moises on 04-03-2017.
 */

$('#tblAsignarTutores').DataTable({
    "language": {
        "url": baseurl +"/assets/json/Spanish.json"
    },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,
    'autoWidth': false, //esta es a opcion que hace que la tabla sea adaptativa

    'ajax': {
        "url":baseurl+"cpasantia/getPasantia",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {data: 'pas_cedula','sClass':'dt-body-center'},
        {"render": function ( data, type, row ) {
            return '<span>' + row.pas_nombre +' ' +row.pas_apellido+'</span>';
                            }},
        {data: 'esc_nombre','sClass':'dt-body-center'},
        {"render": function ( data, type, row ) {
            if(row.pro_id == null){
                return '<a href="#"  data-toggle="modal" ' +
                'data-target="#modalAsignarTutor" ' +
                'onClick="selTutor(\'' + row.pro_id  + '\',\'' + row.id_pasantia + '\',\'' + row.id_escuela + '\');">Asignar</a>';
            }else{
                return '<span>' + row.pro_nombre +' ' +row.pro_apellido+'</span>&emsp;' +
                    '<a href="#"  data-toggle="modal" ' +
                    'data-target="#modalAsignarTutor" ' +
                    'onClick="selTutor(\'' + row.pro_id + '\',\'' + row.id_pasantia + '\',\'' + row.id_escuela + '\');">Cambiar</a>';
            }
        }}

    ]

});

//con esta funcion pasamos los paremtros a los text del modal.
selTutor = function(idPro,idPasantia,escuela){

    idEsc=escuela;
    idTipo=1; //este es el tipo de profesor en este caso queremos buscar tutores academicos , que son prof. tipo 1
    $('#cbTutorA').empty().append('<option value="-1">seleccione:</option>'); //la solucion para limpiar los data combos
    $('#idPasantia').val(idPasantia); //imput oculto en el modal
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
            if(idPro != "null" && idPro != '' ){
                $('#cbTutorA').val(idPro);
            }
        });

};
/*Accion del boton Actualizar en el modal asignarTutores*/
$('#mbtnUpdTutor').click(function () {
    var idPasantia = $('#idPasantia').val();
    var tutorA =$('select[name=cbTutorA]').val();
    if(tutorA=='-1'){
        alert('Debe ingresar un tutor o cancelar la operación');
    }else{
        $.post(baseurl + "coordinador/agregarTutorA",
            {
                idPasantia: idPasantia,
                tutorA: tutorA,
                
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

