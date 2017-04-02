/**
 * Created by Moises on 31-03-2017.
 */
$(document).ready(function(e) {

    $('#miPasantia').show();
    var nombreTa='';
    $.post(baseurl + "cpasante/miPasantia",
        function(data){
            var p = JSON.parse(data)[0];


            $("#escuela").text(p.escuela);
            if(parseInt(p.orgaca)==1){
                $("#empresa").text(p.universidad);
            }else{
                $("#empresa").text(p.empresa);
            }
            if(p.integrantes!=null){
                if(p.integrantes.academico !=null){
                    nombreTa=p.integrantes.academico.info.pro_apellido+' '+p.integrantes.academico.info.pro_nombre;
                    $("#nombreTa").text(nombreTa);
                    $("#correTa").text(p.integrantes.academico.info.usu_correo);

                }else{
                    $("#nombreTa").text('Tutor No asignado');
                }
                if(p.integrantes.organizacional !=null){
                    nombreTa=p.integrantes.organizacional.info.apellido+' '+p.integrantes.organizacional.info.nombre;
                    $("#nombreTe").text(nombreTa);
                    $("#correTe").text(p.integrantes.organizacional.info.correo);

                }

            }
        });
});