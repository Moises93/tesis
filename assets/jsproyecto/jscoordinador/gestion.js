/**
 * Created by Moises on 11-03-2017.
 */
/**
 * Created by Moises on 04-03-2017.
 */
/*Atencion: etsar atennto a los comentario las funciones aqui cumplen un papel importante y especifico*/
$(document).ready(function(e) {
    /*Llenado de la tabla Asignar Tutores Academicos*/
    $('#tblCoordinadores').DataTable({
        "language": {
            "url": baseurl + "/assets/json/Spanish.json"
        },
       // "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        //'paging': true,
        "bPaginate": false,
        'info': false,
        'filter': true,
        'stateSave': true,
        'autoWidth': false, //esta es a opcion que hace que la tabla sea adaptativa

        'ajax': {
            "url": baseurl + "coordinador/obtProfesoresInfo/",
            "type": "POST",
            "data": {'tipo':'2' },
            dataSrc: ''
        }, 'columns': [
            {
                "render": function (data, type, row) {
                    return '<span>' + row.nombre + ' ' + row.apellido + '</span>';
                }
            },
            {data: 'esc_nombre', 'sClass': 'dt-body-center'},
            {
                "render": function (data, type, row) {

                    return '<a href="#" ' +
                        'onClick="quitarCoordinador(\'' + row.id_escuela + '\',\'' + row.pro_id + '\',\'' + row.id_usuario + '\');">Quitar</a>';

                }
            }
       

        ]

    });

     $('#tblProfesores').DataTable({
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
            "url": baseurl + "coordinador/obtProfesoresInfo/",
            "type": "POST",
            "data": {'tipo':'1' },
            dataSrc: ''
        }, 'columns': [
            {
                "render": function (data, type, row) {
                    return '<span>' + row.nombre + ' ' + row.apellido + '</span>';
                }
            },
            {data: 'esc_nombre', 'sClass': 'dt-body-center'},
            {
                "render": function (data, type, row) {
                    
                        return '<a href="#" ' +
                            'onClick="asignarCoordinador(\'' + row.id_escuela + '\',\'' + row.pro_id + '\',\'' + row.id_usuario + '\');">Asignar</a>';
                    
                }
            }


        ]

    });



});
asignarCoordinador = function(idEscuela,proId,idUser){

    idEsc=idEscuela;
    idPro=proId; 
    user=idUser;
    
    $.post(baseurl+"profesor/asignarCoordinador",
        {
            idEscuela: idEsc,
            idPro: idPro,
            idUser:user
        },
        function(data){
            alert(data);
            location.reload();
        });

};
quitarCoordinador = function(idEscuela,proId,idUser){

    idPro=proId;
    user=idUser;

    $.post(baseurl+"profesor/quitarCoordinador",
        {
            idPro: idPro,
            idUser:user
        },
        function(data){
            alert(data);
            location.reload();
        });

};