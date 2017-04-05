/**
 * Created by eheredia on 06/02/2017.
 */




$(function() {
    recargarTabla();
});

/**Aqui cargo lleno la tabla de los menus*/
function recargarTabla() {
  //  $('#guardarPermiso').attr("disabled", false);
    //$("#guardarPermiso").disabled = false;
 //   idUser =$("#cbUsuarios option:selected").val();

    if ( $.fn.dataTable.isDataTable( '#tblMto' ) ) {
        //alert("hay tabla");
        var table = $('#tblMto').DataTable();
        table.destroy();
        construirTabla();
    }
    else {
       // alert("no hay tabla");
        construirTabla();
    }

}


    function construirTabla() {
        idUser=0;
        $('#tblMto').DataTable({
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
            'paging': false,
            'info': false,
            'filter': true,
            'stateSave': true,

            'ajax': {
                "url": baseurl + "cadministrador/getMenu",
                "type": "POST",
                data: {
                    user: idUser, // mando por Post el id del usuario para cargar los cheked

                },
                dataSrc: ''
            }, 'columns': [
                {data: 'id_menu', 'sClass': 'dt-body-center'},
                {data: 'nombre'},
                {data: 'id_padre'},
                {data: 'url'},
                {data: 'clase'},
                {data: 'clave'},
                {
                    orderable: 'true',
                    render: function (data, type, row) {
                        /*/ return '<span>h</span>';*/
                       /* return '<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                            'data-target="#modalEditPermiso" ' +
                            'onClick="selPermiso(\'' + row.id_menu + '\',\'' + row.id_padre + '\',\'' + row.nombre + '\',\'' + row.url + '\',\'' + row.clase + '\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editar</a>';

*/
                        return '<span class="pull-right">' +
                            '<div class="dropdown">' +
                            '  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                            '    Acciones' +
                            '  <span class="caret"></span>' +
                            '  </button>' +
                            '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">' +

                            '    <li><a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                            '    data-target="#modalEditPermiso" onClick="selPermiso(\'' + row.id_menu + '\',\'' + row.id_padre + '\',\'' + row.nombre + '\',\'' + row.url + '\',\'' + row.clase + '\');"> ' +
                            '    <i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editar</a></li>' +
                            '    <li><a href="#" title="Desaprobar afiliado" onClick="eliminarMenu('+row.id_menu+')"><i style="color:red;" class="glyphicon glyphicon-remove"></i> Eliminar</a></li>' +
                            '    </ul>' +
                            '</div>' +
                            '</span>';

                    }


                }
            ],
            "columnDefs": [
                {
                    "targets": [2],
                    "data": "id_padre",
                    "render": function (data, type, row) {
                        // console.log(row);
                        if (row.id_padre == "0") {
                            return '-';
                        } else if (row.id_padre != null) {
                            return row.id_padre;

                        }

                    }
                }
            ],
            "order": [[1, "asc"]],
        });
    }


//con esta funcion pasamos los paremtros a los text del modal.
    function selPermiso(id, padre, nombre, url, clase) {

        //console.log(tipo);
        $('#idMenu').val(id);
        $('#mtxtNombre').val(nombre);
        if (padre != "0") {
            $('#mtxtPadre').val(padre);
        }
        $('#mtxtUrl').val(url);
        $('#mtxtClase').val(clase);
    };

    function eliminarMenu(id){

        $.post(baseurl + "cadministrador/obtenerHijosDePadre",
            {
                id: id,
            },
            function (data) {
                var p = JSON.parse(data);
                console.log("ejele",p);
                console.log("data ",p.length);
                if (p.length>0) {
                    $(document).ready(function(e) {
                        toastr.error('No puede Eliminar. Este menu aun tiene hijos asociados');
                    });
                }else{

                    $.post(baseurl + "cadministrador/menuEnUso",
                        {
                            idMenu: id,
                        },
                        function (data) {
                            var mu = JSON.parse(data);
                            if (mu.length>0) {
                                alert("tiene permisos no puede eliminar");
                            }else{
                                var idMenu=id;
                                console.log("antes",idMenu);
                                console.log("despues",id);
                                $.post(baseurl + "cadministrador/eliminarMenu",
                                    {
                                        idMenu: id,
                                    },
                                    function (data) {
                                      
                                            location.reload();

                                    });
                            }

                        });


               
                
                }
            });
    };

    $('#mbtnUpdPermiso').click(function () {

        var id = $('#idMenu').val();
        var nombre = $('#mtxtNombre').val();
        var padre = $('#mtxtPadre').val();
        var url = $('#mtxtUrl').val();
        var clase = $('#mtxtClase').val();


        $.post(baseurl + "cadministrador/updMenu",
            {
                idMenu: id,
                mtxtNombre: nombre,
                mtxtPadre: padre,
                mtxtUrl: url,
                mtxtClase: clase
            },
            function (data) {

                    $('#mbtnCerrarModalP').click();

                    location.reload();

            });

    });

//funciones a hacer cuando cerramos el modal
    $('#mbtnCerrarModalP').click(function () {
        $("#nombreP").html("<span></span>");
        $("#padreP").html("<span></span>");
        $("#urlP").html("<span></span>");
        $("#claseP").html("<span></span>");
    });

    /* $('#cbTipo').val(tipo);

     $('#mtxtClave').val(usu_clave);
     $('#mtxtCorreo').val(usu_correo);
     */

//Aqui lleno el data Combo de Padres Menus
$.post(baseurl + "cadministrador/obtenerPadres",
    function(data) {
        var p = JSON.parse(data);
        console.log(p);
        $.each(p, function (i, item) {

            $('#cbPadre').append('<option value="'+item.id_menu+'">'+item.nombre+'</option>'
            );
        });
    });



$('#agregarMenu').click(function () {

    var nombre = $('#nombreM').val();
    var padre = $('select[name=padreM]').val();
    var url = $('#url').val();
    var clase = $('#clase').val();
    //var clase = $('#mtxtClase').val();

alert(nombre);
   /* alert(padre);
    alert(clase);
    alert(url);*/
    $.post(baseurl + "cadministrador/crearMenu",
        {
            nombre: nombre,
            padre: padre,
            url: url,
            clase: clase
        },
        function (data) {
            if (data == 1) {
                //$('#mbtnCerrarModalP').click();

                location.reload();
            }
        });

});