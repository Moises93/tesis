//Este Script pertenece a la vista de subir dcumentos , para cargar los data combos

$.post(baseurl + "cadministrador/getEscuela",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cescuela').append('<option value="'+item.id_escuela+'">'+item.esc_nombre+'</option>'

            );
        });
        $('#cescuela').append('<option value="6">General</option>');
    });


function mostrarLineas(){

    $('#cbLineas').empty().append('<option value="-1">seleccione:</option>');
    /*muestro el login de acces del pasante que es Unico y evitar confuncion por nombres repetidos*/

    escuela=$("#cescuela option:selected").val();

//crea en base de datos los registros de 5 que es general

	    $.post(baseurl + "cadministrador/getLineas",
	        {
	            escuelaid: escuela,
	        },
	        function(data) {
	            var p = JSON.parse(data);
	            $.each(p, function (i, item) {
	                $('#cbLineas').append('<option value="'+item.id_linea+'">'+item.nombre+'</option>'

	                );
	            });
	        });

    

}

$(document).ready(function(e) {
	  var escuela=parseInt($('#vescuela').val());
		 if(escuela ==0){
		 		alert('Tu pasantia aun no ha sido registrada al sistema');
		 }else{
		 		   $.post(baseurl + "cadministrador/getLineas",
	        {
	            escuelaid: escuela,
	        },
	        function(data) {
	            var p = JSON.parse(data);
	            $.each(p, function (i, item) {
	                $('#cbLineasr').append('<option value="'+item.id_linea+'">'+item.nombre+'</option>'

	                );
	            });
	        });
		 }


});