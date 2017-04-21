/**
 * Created by Moises on 16-03-2017.
 */
$(document).ready(function(e) {
    var estatus=0;
    var tutorA='';
    var tutorE='';

    $('#qid2').fadeOut();
    $('#pid2').fadeOut();
    $('#qid3').fadeOut();
    $('#pid3').fadeOut();
    $('#finish').fadeOut();
    $('#guardar').fadeOut();
    $('#resultado').fadeOut();
    $('#volver').fadeOut();

    /*Creacion de la Tabla Evaluar */
    var table=$('#tblEvaluar').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
        'filter': true,
        'stateSave': true,

        'ajax': {
            "url": baseurl + "profesor/obtenerPasantesDeTutor",
            "type": "POST",
            dataSrc: ''
        }, 'columns': [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            {"render": function ( data, type, row ) {
                var estatus=parseInt(row.estatus);
                if(estatus==1){
                    /*pasante consigue pasantias y carga plan*/
                    return '<div class="progress progress-sm active" style="background-color: #adbcad; height: 20px;" >'+
                        '<div style="width: 10%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:10px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">10%</span> </div> </div>';
                }else if(estatus==2){
                    //pasante sube Cv y foto
                    return '<div class="progress progress-sm active" style="background-color: #adbcad; height: 20px;" >'+
                        '<div style="width: 30%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:10px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">30%</span> </div> </div>';
                }else if(estatus==3){
                    //pasante sube informe final
                    return '<div class="progress progress-sm active" style="background-color: #adbcad; height: 20px;" >'+
                        '<div style="width: 60%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:10px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">60%</span> </div> </div>';
                }else if(estatus==4){
                    //tutor empresarial evalua
                    return '<div class="progress progress-sm active" style="background-color: #adbcad; height: 20px;" >'+
                        '<div style="width: 80%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:80px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">80%</span> </div> </div>';
                }else if(estatus==5){
                    //tutor academico aprueba
                    return '<div class="progress progress-sm active" style="background-color: #adbcad; height: 20px;" >'+
                        '<div style="width: 100%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" ' +
                        'class=" progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:10px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">100%</span> </div> </div>';
                }
            }},
            {
                "render": function (data, type, row) {
                    return '<span>' + row.apellido + ' ' + row.nombre + ' </span>';
                }
            },
            {
                "render": function (data, type, row) {
                    if(row.orgaca >0){
                        return '<span> '+row.universidad+' </span>';

                    }else{
                        return '<span>' + row.empresa +  '</span>';
                    }
                }
            },
            {data: 'escuela'},
            {
                orderable: 'true',
                render: function (data, type, row) {

                   /*Valido aqui los quienes son los tutores de la pasantia, y pasar el valor para ser mostrado en el modal de informacion*/
                    if(row.integrantes.academico!=null){
                        tutorA=row.integrantes.academico.info.pro_apellido +' '+ row.integrantes.academico.info.pro_nombre;
                    }else{
                        tutorA="No asignado";
                    }
                    if(row.integrantes.organizacional!=null){
                        tutorE=row.integrantes.organizacional.info.apellido +' '+ row.integrantes.organizacional.info.nombre;
                    }else{
                        tutorE="No asignado";
                    }

                    var masInfo=  '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                        'data-target="#modalInfoPasantia" ' +
                        'onClick="selInfo(\'' + row.cedula + '\',\'' + row.nombre + '\',\'' + row.apellido + '\',\'' + row.sexo + '\',' +
                        '\'' + row.fecha_inicio + '\',\'' + row.fecha_final + '\',\'' + row.correo + '\',\'' + row.empresa + '\',' +
                        '\'' + tutorA + '\',\'' + tutorE + '\',\'' + row.telefono + '\',\'' + row.escuela + '\',' +
                        '\'' + row.universidad + '\',\'' + row.modalidad + '\',\'' + row.estatus + '\',\'' + row.foto + '\');">'+
                        '<i class="fa fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                    if(row.estatus<=4 ){
                        var evaluar='';
                        var tutor=parseInt(row.TutorEmp);
                        //tutor.trim()
                        if(tutor >0 ){
                             evaluar='<a href="#" title="Evaluar Pasante" data-toggle="modal" ' +
                                 'data-target="#modalEvaluacion" ' +
                                 'onClick="evaluarPasante(\'' + row.id_pasantia + '\',\'' + row.estatus + '\',' +
                                 '\'' + row.pas_id + '\');"><span  class="fa fa-flag-checkered" </span></a>' ;
                            return evaluar + masInfo;
                        }else{
                             evaluar ='<a href="#" title="Aprobar Pasante"  ' +
                                 'onClick="aprobarPasante(\'' + row.id_pasantia + '\',\'' + row.estatus + '\',' +
                                 '\'' + row.requisitos + '\');"><span  class="fa fa-check-circle-o" </span></a>' ;

                            return evaluar + masInfo+

                                '&nbsp;<a href="#" onclick="window.open(\''+baseurl+'cdocumentos/generarConstancia/' + row.id_pasantia + '\',\'_blank\',\'fullscreen=yes\'); return false;\"><i class="fa fa-print" aria-hidden="true"></i></a>';

                        }

                    }else{
                        return '<span style="color:green" title="Pasante Aprobado" class="fa fa-check" </span>' +
                                 masInfo+
                                '<a href="#" onclick="window.open(\''+baseurl+'cdocumentos/generarConstancia/' + row.id_pasantia + '\',\'_blank\',\'fullscreen=yes\'); return false;\"><i class="fa fa-print" aria-hidden="true"></i></a>';

                    }

                }
            }
        ],

        "order": [[1, "asc"]],
    });
/*Esta funcion abre y cierra el menu de requisitos*/
    $('#tblEvaluar tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this rowf
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

});

/*aqui programamos la vista de los requisitos*/
function format ( d ) {
    // `d` is the original data object for the row
    var actividades = 'No se encuentra';
    var descarga = '#';
    var descargaInf = '#';
    var informeFinal = 'No se encuentra';
    var sizeAct='';
    var sizeActI='';
    var forAct='';
    var forIn='';
    if(d.requisitos != null) {
        for(var i=0;i<d.requisitos.length;i++){
            if(d.requisitos[i].requisito == 'planActividades'){
                actividades=d.requisitos[i].nombre_archivo+d.requisitos[i].formato
                sizeAct='['+d.requisitos[i].size+'KB]';
                forAct=d.requisitos[i].formato;
               /* descarga=baseurl+'/documentos/'+actividades;*/
                descarga=baseurl+'cpasante/downloads/'+actividades;
            }
            if(d.requisitos[i].requisito == 'informeFinal'){
                informeFinal=d.requisitos[i].nombre_archivo+d.requisitos[i].formato
                sizeActI='['+d.requisitos[i].size+'KB]';
                forIn=d.requisitos[i].formato;
                /* descarga=baseurl+'/documentos/'+actividades;*/
                descargaInf=baseurl+'cpasante/downloads/'+informeFinal;
            }

        }

    }
    /*   descarga=baseurl+'cpasante/downloads/'+actividades;*/
    /* PDFObject.embed(baseurl+"/documentos/"+actividades,"#aqui"); ya no lo uso*/
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td><strong>Plan de Actividades:<strong> &nbsp;</td>'+
                    '<td>'+actividades+'&nbsp;'+sizeAct+' &nbsp;<a id="aqui" class= "view-pdf" href="'+ descarga+'"target="_blank">'+
                            '<span  class="fa fa-download" </span></a>' +
                    '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td><strong>Informe Final:<strong></td>'+
                    '<td>'+informeFinal+'&nbsp;'+sizeActI+' &nbsp;<a id="aqui" class= "view-pdf" href="'+ descargaInf+'"target="_blank">'+
                            '<span  class="fa fa-download" </span></a>' +
                    '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td><strong>Resultado de Evaluación:<strong></td>'+
                    '<td>&nbsp;<a href="#" title="mostrar" data-toggle="modal" ' +
                            'data-target="#modalResultado" ' +
                            'onClick="mostrarResultado(\'' + d.pas_id + '\');">' +
                            '<span  class="fa fa-bookmark" </span> </a>' +
        '           </td>'+
                '</tr>'+

            '</table>';

}

aprobarPasante = function(idPas,estatus,requisitos){

    if(estatus < 4){
        alert('El Tutor empresarial aun no ha Evaluado');
    }else{
        $.post(baseurl + "cpasantia/aprobarPasantia",
            {
                estatus:estatus,
                idPasantia:idPas
            },
            function(data){
                alert(data);
                location.reload();
            });
    }
};

mostrarResultado = function(idPa){
    $('#p1').empty().append('');
    $('#r1').empty().append('');
    $('#p2').empty().append('');
    $('#r2').empty().append('');
    $('#p3').empty().append('');
    $('#r3').empty().append('');
        $.post(baseurl + "cpasantia/mostrarResultado",
            {
                paId:idPa
            },
            function(data){
                var p = JSON.parse(data);
                var pre='#p';
                var res='#r';
                if(p.length>1) {
                    for (var i = 0; i < p.length; i++) {
                        pre = pre.concat(p[i].id);
                        res = res.concat(p[i].id);
                        $(pre).html(p[i].id + ')' + p[i].test + '</br>');
                        $(res).html('R-' + p[i].valor + '</br>');
                        pre = '#p';
                        res = '#r';
                    }
                }else{
                    $('#p1').html('<strong>Este Pasante aun no ha sido evaluado por su tutor Empresarial</strong>');
                }


            });


};

/*Este metodo gestiona el Quiz*/
evaluarPasante = function(idPas,estatus,pas){
    var contador=1;
    var loading = $('#loadbar').hide();
    var choice='';
    var respuesta= new Array();
    var preguntas= new Array();
    $(document)
        .ajaxStart(function () {
            loading.show();
        }).ajaxStop(function () {
        loading.hide();
    });
    $("label.btn").on('click',function () {
        if(contador == 1){
             choice = $(this).find('input:radio').val();
            $('#loadbar').show();
            $('#qid1').fadeOut();
            $('#pid1').fadeOut();

            $('#quiz').fadeOut();
            setTimeout(function(){
                $( "#answer" ).html(  $(this).checking(choice) );
                $('#qid2').show();
                $('#pid2').show();
                $('#quiz').show();
                $('#loadbar').fadeOut();
                /* something else */
            }, 1500);
            contador=contador+1;
        }else if(contador==2){
            choice = $(this).find('input:radio').val();
            $('#loadbar').show();
            $('#qid2').fadeOut();
            $('#pid2').fadeOut();
            $('#quiz').fadeOut();
            setTimeout(function(){
                $( "#answer" ).html(  $(this).checking(choice) );
                $('#qid3').show();
                $('#pid3').show();
                $('#quiz').show();
                $('#loadbar').fadeOut();
                /* something else */
            }, 1500);
            contador=contador+1;
        }else if(contador==3){
            choice = $(this).find('input:radio').val();
            $('#loadbar').show();
            $('#qid3').fadeOut();
            $('#pid3').fadeOut();
            $('#quiz').fadeOut();
            setTimeout(function(){
                $( "#answer" ).html(  $(this).checking(choice) );
                $('#finish').show();
                $('#guardar').show();
                $('#volver').show();
                $('#loadbar').fadeOut();
                /* something else */
            }, 1500);
        }



    });

    $("#guardar").on('click',function () {
        console.log(respuesta);
        console.log(preguntas);
        $('#loadbar').show();
        $('#guardar').fadeOut();

        var jsonResp = JSON.stringify(respuesta);
        var jsonP = JSON.stringify(preguntas);

        $.post(baseurl+"cpasantia/guardarTest",
            {
                respuesta: jsonResp,
                preguntas: jsonP,
                paId :pas,
                idpas: idPas,
                estatus: estatus
            },
            function(data){
                //var p = JSON.parse(data);
                //console.log("data",data);
                setTimeout(function(){
                    $('#resultado').html('<h3> El Resultado de la Evaluación Fue: '+ data+' </h3>');
                    $('#resultado').show();
                    $('#loadbar').fadeOut();
                    /* something else */
                }, 1500);
            });
        
       

    });

    $("#volver").on('click',function () {

        evaluarPasante(1,1,1);

    });

    $ques = 1;

    $.fn.checking = function(ck) {
        respuesta.push(parseInt(ck));
        preguntas.push($ques);
        $ques=$ques+1;
            return ck;

    };

};

selInfo = function(cedula,nombre,apellido,sexo,fechaI,fechaF,correo,empresa,tutorA,tutorE,telefono,escuela,universidad,modalidad,estatus,foto){
    var progreso=parseInt(estatus);
    var iconSexo='';
    var avance='';
    var pendiente='';
    var actividades='Plan de Actividades';
    var informe='Informe Final';
    var evaluaE='Evaluación Tutor Empresarial'; // Tutor Empresarial Aprobación Tutor Academico
    var evaluaP='Aprobación Tutor Academico.';
    if(sexo =='f' || sexo =='F'){
        iconSexo='fa fa-female';
    }else if (sexo == 'm' || sexo == 'M'){
        iconSexo='fa fa-male';
    }
    if(empresa == null || empresa =='null'){
        empresa=universidad;
    }
    if(progreso == 1){
        avance='10%';
        pendiente=actividades+','+informe+','+evaluaE+','+evaluaP;
    }else if(progreso == 2){
        avance='30%';
        pendiente=informe+','+evaluaE+','+evaluaP;
    }else if(progreso == 3){
        avance='60%';
        pendiente=evaluaE+','+evaluaP;
    }else if(progreso == 4){
        avance='80%';
        pendiente=evaluaP;
    }else if(progreso == 5){
        avance='100%';
        pendiente='Culminada';
    }

    if(foto =='null'){
        foto='http://lorempixel.com/150/150/technics/';
    }
    $('.modal-title').html('<i class="'+iconSexo+'"></i> <strong>'+apellido+' '+nombre+'</strong>');  //  $('strong.modal-title').text('text'+nombre+' ');
    $("#cedula").text(''+cedula+'');
    $("#correo").text(''+correo+'');
    $("#telefono").text(''+telefono+'');
    $("#escuelac").text(''+escuela+'');
    $("#empresa").text(''+empresa+'');
    $("#tutorA").text(''+tutorA+'');
    $("#tutorE").text(''+tutorE+'');
    $("#modalidadp").text(''+modalidad+'');
    $("#periodop").text(''+fechaI+'-'+fechaF+'');
    document.getElementById('img').setAttribute( 'src', ''+foto+'');
    $('#progreso').html('<strong>'+avance+'</strong>');
    $('#pendiente').html(''+pendiente+'');




};