/**
 * Created by Moises on 01-02-2017.
 */
var idUser= 11;
$('#tblPermisos').DataTable({
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,

    'ajax': {
        "url":baseurl+"cadministrador/getMenu",
        "type":"POST",
        data : {
            user : idUser,
         
        },
        dataSrc: ''
    },'columns': [
        {orderable: 'true',
           render: function (data,type,row) {
               console.log("aqui",row);
               return '<td><input id="miCheck_'+row.id_menu+'" type="checkbox" value="'+row.id_menu+'"  name="miCheck_'+row.id_menu+'" class="flat-red" checked></td>';

           }},
        {data: 'id_menu','sClass':'dt-body-center'},
        {data: 'nombre'},
        {data: 'id_padre'},
        {data: 'url'},
        {data: 'clase'},
        {data: 'activo'},
        {orderable: 'true',
            render: function (data,type,row) {
               /*/ return '<span>h</span>';*/
                return '<button  class="btn btn-block btn-primary btn-sm" style="width: 80%;" data-toggle="modal" ' +
                    'onClick="alertaValue();"></button>';


            }
        }
    ],
    "columnDefs": [
        {
            "targets": [3],
            "data": "id_padre",
            "render": function(data, type, row) {
               //console.log(row);
                if (row.id_padre == null) {
                    return '-';
                }else if (row.id_padre != null) {
                  return row.id_padre;

                }

            }
        }
    ],
    "order": [[ 1, "asc" ]],
});
function guardarP(){
    if( $('#miCheck_2').is(':checked') ) {
        alert('Seleccionado '+ $('#miCheck_2').val());
    }
   // alert($('#miCheck_1').value)
   // alert($('#miCheck').value);
}