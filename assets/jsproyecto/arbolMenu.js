/**
 * Created by Moises on 01-02-2017.
 */
/*Declaracion de Variables*/
var idUser= null;
var idTipo =null;
var activadorModal=0;

$('#guardarPermiso').attr("disabled", true);
$('#buscarPermiso').attr("disabled", true);
/**Aqui cargo el data combo de Tipos Usuarios en la ventana de admin permisos*/
$.post(baseurl + "cadministrador/get_tipo",
    function(data) {
        var p = JSON.parse(data);
        $.each(p, function (i, item) {
            $('#cbTiposu').append('<option value="'+item.id_tipo+'">'+item.tipo+'</option>'
            );
        });
    });

if(activadorModal==0){
    $(function() {
        construirTabla();
    });
}

/*funcion que se activa despues de escoger el tipo de usuario*/
function cargar_usuarios() {
    //get_usuario
      //$('#cbUsuarios').empty(); //preguntar a sandra si hay otra forma
   // $("#user").html("<span></span>");
   // $('#user').val();

    idTipo = $("#cbTiposu option:selected").val();

    $.post(baseurl+"cadministrador/obtenerUsuariosTipos",
        {
            tipo: idTipo,
        },
        function(data){
            var p = JSON.parse(data);
            $.each(p, function (i, item) {
                $('#cbUsuarios').append('<option value="'+item.id_usuario+'">'+item.usu_login+'</option>'
                );
            });
        });

    $('#buscarPermiso').attr("disabled", false);


}
/**Aqui cargo lleno la tabla de los menus*/
function buscarPermiso() {
    $('#guardarPermiso').attr("disabled", false);
    //$("#guardarPermiso").disabled = false;
    idUser =$("#cbUsuarios option:selected").val();

    if ( $.fn.dataTable.isDataTable( '#tblPermisos' ) ) {
       //alert("hay tabla");
        var table = $('#tblPermisos').DataTable();
        table.destroy();
        construirTabla();
    }
    else {
        alert("no hay tabla");
        construirTabla();
    }

}
/*guardar permisos */
function guardarP(){
    if( $('#miCheck_2').is(':checked') ) {
        alert('Seleccionado '+ $('#miCheck_2').val());
    }
   // alert($('#miCheck_1').value)
   // alert($('#miCheck').value);
}

function construirTabla()
{
    $('#tblPermisos').DataTable({
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        'paging': true,
        'info': true,
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
            {
                orderable: 'true',
                render: function (data, type, row) {
                    //  console.log("aqui",row);
                    var id = row.id_menu;
                    var checkPermiso = false;
                    for (var i = 0; i <= row.permisos.length; i++) {

                        if (row.permisos[i] == id) {
                            checkPermiso = true;
                        }
                    }
                    if (checkPermiso == true) {
                        return '<td><input id="miCheck_' + row.id_menu + '" type="checkbox" value="' + row.id_menu + '"  name="miCheck_' + row.id_menu + '" class="flat-red" checked></td>';
                    } else {
                        return '<td><input id="miCheck_' + row.id_menu + '" type="checkbox" value="' + row.id_menu + '"  name="miCheck_' + row.id_menu + '" class="flat-red" ></td>';
                    }
                }
            },
            {data: 'id_menu', 'sClass': 'dt-body-center'},
            {data: 'nombre'},
            {data: 'id_padre'},
            {data: 'url'},
            {data: 'clase'},
            {data: 'activo'},
            {
                orderable: 'true',
                render: function (data, type, row) {
                    /*/ return '<span>h</span>';*/
                    return '<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                        'data-target="#modalEditPermiso" ' +
                        'onClick="selPermiso(\'' + row.id_menu + '\',\'' + row.id_padre + '\',\'' + row.nombre + '\',\'' + row.url + '\',\'' + row.clase + '\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editar</a>';


                }

          
            }
        ],
        "columnDefs": [
            {
                "targets": [3],
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
function selPermiso(id,padre, nombre, url, clase){
    activadorModal=2;
    //console.log(tipo);
    $('#idMenu').val(id);
    $('#mtxtNombre').val(nombre);
    if(padre!="0"){
    $('#mtxtPadre').val(padre);
    }
    $('#mtxtUrl').val(url);
    $('#mtxtClase').val(clase);
};

$('#mbtnUpdPermiso').click(function(){

    var id=$('#idMenu').val();
    var nombre = $('#mtxtNombre').val();
    var padre= $('#mtxtPadre').val();
    var url = $('#mtxtUrl').val();
    var clase = $('#mtxtClase').val();
    

                    $.post(baseurl+"cadministrador/updMenu",
                        {
                            idMenu:id,
                            mtxtNombre:nombre,
                            mtxtPadre:padre,
                            mtxtUrl:url,
                            mtxtClase:clase
                        },
                        function(data){
                            if (data == 1) {
                                $('#mbtnCerrarModalP').click();

                                location.reload();
                            }
                        });
    
});

//funciones a hacer cuando cerramos el modal
$('#mbtnCerrarModalP').click(function(){
    $("#nombreP").html("<span></span>");
    $("#padreP").html("<span></span>");
    $("#urlP").html("<span></span>");
    $("#claseP").html("<span></span>");
});

/* $('#cbTipo').val(tipo);

 $('#mtxtClave').val(usu_clave);
 $('#mtxtCorreo').val(usu_correo);
 */

