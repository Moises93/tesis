/**
 * Created by Moises on 16-03-2017.
 */
$(document).ready(function(e) {
    var estatus=0;
    var tutorA='';
    var tutorE='';
    $('#tblEvaluar').DataTable({
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
                    return '<div class="progress progress-sm active" style="background-color: burlywood; height: 20px;" >'+
                        '<div style="width: 30%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:10px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">30%</span> </div> </div>';
                }else if(estatus==3){
                    //pasante sube informe final
                    return '<div class="progress progress-sm active" style="background-color: burlywood; height: 20px;" >'+
                        '<div style="width: 60%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:10px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">60%</span> </div> </div>';
                }else if(estatus==4){
                    //tutor empresarial evalua
                    return '<div class="progress progress-sm active" style="background-color: burlywood; height: 20px;" >'+
                        '<div style="width: 80%; " aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" ' +
                        'class="progress-bar progress-bar-success progress-bar-striped">'+
                        '<span style=" margin-left:80px;color: #000; text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff, -1px 1px 0 #fff,1px 1px 0 #fff;">80%</span> </div> </div>';
                }else if(estatus==5){
                    //tutor academico aprueba
                    return '<div class="progress progress-sm active" style="background-color: burlywood; height: 20px;" >'+
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
            {
                orderable: 'true',
                render: function (data, type, row) {
                    var actividades = '';
                    var sizeAct='';
                    var forAct='';
                    if(row.requisitos != null) {
                        for(var i=0;i<row.requisitos.length;i++){
                            console.log(row.requisitos[i].requisito);
                            if(row.requisitos[i].requisito == 'planActividades'){
                                actividades=row.requisitos[i].nombre_archivo+row.requisitos[i].formato
                                sizeAct=row.requisitos[i].size;
                                forAct=row.requisitos[i].formato;
                            }

                        }
                        return '<a title="Descargar Plan de Actividades"  class= "view-pdf" href='+ baseurl+'cpasante/downloads/'+actividades+'' +
                            '><span  class="fa fa-download" </span>Actividades ['+sizeAct+'KB]'+forAct+'</a>' +

                            '&nbsp;&nbsp;&nbsp;<a href="http://portal.facyt.uc.edu.ve/pasantias/informes/P32454118.pdf"  ' +
                            'onClick="verPdf();"><i class="fa fa-download" aria-hidden="true"></i>Informe Final</a>';

                    }else{
                        return '<a>Falta Plan de Actividades</a>'+
                        '<a href="http://portal.facyt.uc.edu.ve/pasantias/informes/P32454118.pdf"  ' +
                        'onClick="verPdf();"><i class="fa fa-download" aria-hidden="true"></i>Informe Final</a>';
                    }
                }


            },
            {
                orderable: 'true',
                render: function (data, type, row) {
                    console.log(row.estatus!=2);
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
                    if(row.estatus<3 ){
                        return '<a href="#" title="Aprobar Pasante" data-toggle="modal" ' +
                            'data-target="#modalEditProfesor" ' +
                            'onClick="aprobarPasante(\'' + row.id_pasantia + '\',\'' + row.estatus + '\',\'' + row.requisitos + '\');"><span  class="fa fa-check-circle-o" </span></a>' +

                            '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                            'data-target="#modalInfoPasantia" ' +
                            'onClick="selInfo(\'' + row.cedula + '\',\'' + row.nombre + '\',\'' + row.apellido + '\',\'' + row.sexo + '\',' +
                            '\'' + row.fecha_inicio + '\',\'' + row.fecha_final + '\',\'' + row.correo + '\',\'' + row.empresa + '\',' +
                            '\'' + tutorA + '\',\'' + tutorE + '\',\'' + row.telefono + '\',\'' + row.escuela + '\',' +
                            '\'' + row.universidad + '\',\'' + row.modalidad + '\',\'' + row.estatus + '\',\'' + row.foto + '\');">'+
                            '<i class="fa fa-search" aria-hidden="true"></i></a>'+

                            '&nbsp;&nbsp;<a href="#" title="Generar Constancia" data-toggle="modal" ' +
                            'data-target="#modalInfoPasantia" ' +
                            'onClick="selInfo(\'' + row.fecha_inicio + '\',\'' + row.emp_nombre + '\');"><i class="fa fa-print" aria-hidden="true"></i></a>';
                    }else{
                        return '<span style="color:green" title="Pasante Aprobado" class="fa fa-check" </span>' +

                            '&nbsp;&nbsp;<a href="#"  data-toggle="modal" ' +
                            'data-target="#modalInfoPasantia" ' +
                            'onClick="selInfo(\'' + row.cedula + '\',\'' + row.nombre + '\',\'' + row.apellido + '\',\'' + row.sexo + '\',' +
                            '\'' + row.fecha_inicio + '\',\'' + row.fecha_final + '\',\'' + row.correo + '\',\'' + row.empresa + '\',' +
                            '\'' + tutorA + '\',\'' + tutorE + '\',\'' + row.telefono + '\',\'' + row.escuela + '\',' +
                            '\'' + row.universidad + '\',\'' + row.modalidad + '\',\'' + row.estatus + '\',\'' + row.foto + '\');">'+
                            '<i class="fa fa-search" aria-hidden="true"></i></a>'+

                            '&nbsp;&nbsp;<a href="#" title="Generar Constancia" data-toggle="modal" ' +
                            'data-target="#modalInfoPasantia" ' +
                            'onClick="selInfo(\'' + row.fecha_inicio + '\',\'' + row.emp_nombre + '\');"><i class="fa fa-print" aria-hidden="true"></i></a>';
                    }

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
        "order": [[1, "asc"]],
    });

});
(function(a)
{a.createModal=function(b){
    defaults={
        title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};
    var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";
    html='<div class="modal fade" id="myModal">';
    html+='<div class="modal-dialog">';
    html+='<div class="modal-content">';
    html+='<div class="modal-header">';
    html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";
    html+='<div class="modal-body" '+c+">";
    html+=b.message;html+="</div>";
    html+='<div class="modal-footer">';
    if(b.closeButton===true){
        html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'
    }
    html+="</div>";
    html+="</div>";
    html+="</div>";
    html+="</div>";
    a("body").prepend(html);
    a("#myModal").modal().on("hidden.bs.modal",function(){
        a(this).remove()
    })
}
})(jQuery);

$('.view-pdf').on('click',function(){
    var pdf_link = $(this).attr('href');
    //var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
    //var iframe = '<object data="'+pdf_link+'" type="application/pdf"><embed src="'+pdf_link+'" type="application/pdf" /></object>'
    var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="500">No Support</object>'
    $.createModal({
        title:'My Title',
        message: iframe,
        closeButton:true,
        scrollable:false
    });
    return false;
});

verPdf = function () {
    var pdf_link = $(this).attr('href');
    //var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
    //var iframe = '<object data="'+pdf_link+'" type="application/pdf"><embed src="'+pdf_link+'" type="application/pdf" /></object>'
    var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="500">No Support</object>'
    $.createModal({
        title:'My Title',
        message: iframe,
        closeButton:true,
        scrollable:false
    });
    return false;
}

aprobarPasante = function(idPas,estatus,requisitos){

    if(estatus < 4){
        alert('El Tutor empresarial aun no ha Evaluado');
    }else{
        $.post(baseurl + "cpasantia/aprobarPasantia",
            {

                idPasantia:idPas
            },
            function(data){
                alert(data);
                location.reload();
            });
    }
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