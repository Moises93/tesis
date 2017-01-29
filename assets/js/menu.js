/**
 * Created by eheredia on 28/01/2017.
 */

//Aqui lleno el data Combo de tipoUsuario
$.post(baseurl + "cadministrador/get_menu",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            //$('#cbTipo').append('<option value="'+item.id_tipo+'">'+item.tipo+'</option>'
            console.log(item);

            $("#menuDinamico ul").append('<li><a href="/user/messages"><span class="tab">Message Center</span></a></li>');
            /*$("#menuDinamico ul").append(
                '<li class="treeview" id="itemMenu">'+
                ' <a href="#">'+
                '<i class="fa fa-user"></i> <span>'+item.nombre+'</span>'+
                '<span class="pull-right-container">'+
                '<i class="fa fa-angle-left pull-right"></i>'+
                '</span>'+
                '</a>'+
                '<ul class="treeview-menu">'+
                '<li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>'+
                '<li><a href="<?php echo base_url() ?>cadministrador/login2"><i class="fa fa-circle-o"></i>Mantenimiento de Usuarios</a></li>'+
                '</ul>'+
                '</li>');*/


        });




    });