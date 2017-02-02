/**
 * Created by Moises on 01-02-2017.
 */
$.post(baseurl + "cusuario/obtenerMenu",
    function(data) {
        console.log("h",data);
       // var p = JSON.parse(data);
        $('#tree').treeview({data:data});
    });