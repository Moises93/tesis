/**
 * Created by Moises on 24-01-2017.
 */

//Aqui lleno el data Combo de tipoUsuario
$.post(baseurl + "cadministrador/get_tipo",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbTipos').append('<option value="'+item.id_tipo+'">'+item.tipo+'</option>'
            );
        });
    });

function valor_select() {
    //var valor = document.getElementById('cbTipos').value;
    var valor = $("#cbTipos option:selected").text();
    if(valor== "pasante"){
        $('#userOption').append('   <div class="col-sm-5">'+
        '<label for="email" class="control-label">Email</label>'+
            '<input type="email" class="form-control" id="email" name="email" placeholder="Email">'+
            '</div>'+
            '<div class="col-sm-5">'+
            '<div class="form-group">'+
            '<label>Tipo</label>'+
            '<select id="cbTipos" class="form-control" name="tipo" onchange="valor_select();">'+
            '<option value="">seleccione:</option>'+
        '</select>'+
       ' </div>'+
        '</div>' );
    }


}