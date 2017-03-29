/**
 * Created by Moises on 29-03-2017.
 */
$(document).ready(function(e) {
    $('#qid2').fadeOut();
    $('#pid2').fadeOut();
    $('#qid3').fadeOut();
    $('#pid3').fadeOut();
    $('#finish').fadeOut();
    $('#guardar').fadeOut();
    $('#resultado').fadeOut();
    $('#volver').fadeOut();
});
evaluarPasante = function(pas){
   // var pas = $('#pasId').val();
    
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
                paId :pas
            },
            function(data){
                //var p = JSON.parse(data);
                console.log("data",data);
                setTimeout(function(){
                    $('#resultado').html('<h3> El Resultado de la Evaluacion Fue :'+ data+' </h3>');
                    $('#resultado').show();
                    $('#loadbar').fadeOut();
                    /* something else */
                }, 1500);
            });



    });

    $("#volver").on('click',function () {

        evaluarPasante(1,1,1);

    });

    pregunta = 1;

    $.fn.checking = function(ck) {
        respuesta.push(parseInt(ck));
        preguntas.push(pregunta);
        pregunta=pregunta+1;
        return ck;

    };
    
}