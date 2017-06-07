/**
 * Created by Moises on 18-03-2017.
* autor:http://bootsnipp.com/snippets/yAV1 by palmdeezy
 */
$(document).ready(function() {
    var pas=parseInt($('#pasos1').val());
    var pas2=parseInt($('#pasos2').val());
    var pas3=parseInt($('#pasos3').val());
    var pas4=parseInt($('#pasos4').val());
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');

        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });

    if(pas==1){
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        // $(this).remove();
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $('#activate-step-2').remove();
    }
    if(pas2==1){
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $('#activate-step-3').remove();
    }
    if(pas3==1){
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $('#activate-step-4').remove();
    }
     if(pas4==1){
        $('ul.setup-panel li:eq(4)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-5"]').trigger('click');
        $('#activate-step-5').remove();
    }
    $('ul.setup-panel li.active a').trigger('click');

    // DEMO ONLY //
    $('#activate-step-1').on('click', function(e) {

        var pas=parseInt($('#paso1').val());
        if(pas==0){
                alertify.alert("Debes subir el requisito para avanzar");
                
            //alert('debes subir el requisito para avanzar');
        }else{
            $('ul.setup-panel li:eq(1)').removeClass('disabled');
           // $(this).remove();
            $('ul.setup-panel li a[href="#step-2"]').trigger('click');
            $(this).remove();
           /* $('ul.setup-panel li:eq(1)').addClass('active');
            $('ul.setup-panel li:eq(1)').show();

            $('ul.setup-panel li:eq(0)').removeClass('active');*/
        }
    });

    $('#activate-step-2').on('click', function(e) {
        var pas=parseInt($('#paso2').val());
        if(pas==0){
            alertify.alert("Debes subir el requisito para avanzar", function () {
                    //aqui introducimos lo que haremos tras cerrar la alerta.
                    //por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
                });
            //alert('debes subir el requisito para avanzar');s
        }else {
            $('ul.setup-panel li:eq(2)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-3"]').trigger('click');
            $(this).remove();
           // $(this).remove();
           /* $('ul.setup-panel li:eq(2)').addClass('active');
            $('ul.setup-panel li:eq(2)').show();
            $('ul.setup-panel li:eq(1)').removeClass('active');*/
        }
    });
    $('#activate-step-3').on('click', function(e) {
        var pas=parseInt($('#paso3').val());
        if(pas==0){
             alertify.alert("Debes subir el requisito para avanzar");
        }else {
            $('ul.setup-panel li:eq(3)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-4"]').trigger('click');
            $(this).remove();
           // $(this).remove();
           /* $('ul.setup-panel li:eq(2)').addClass('active');
            $('ul.setup-panel li:eq(2)').show();
            $('ul.setup-panel li:eq(1)').removeClass('active');*/
        }
    });
  $('#activate-step-4').on('click', function(e) {
        var pas=parseInt($('#paso4').val());
        if(pas==0){
             alertify.alert("Debes subir el requisito para avanzar");
        }else {
            $('ul.setup-panel li:eq(4)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-5"]').trigger('click');
            $(this).remove();
           // $(this).remove();
           /* $('ul.setup-panel li:eq(2)').addClass('active');
            $('ul.setup-panel li:eq(2)').show();
            $('ul.setup-panel li:eq(1)').removeClass('active');*/
        }
    });


});

