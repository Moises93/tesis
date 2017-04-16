/**
 * Created by Moises on 30-03-2017.
 */
$(document).ready(function(e) {
  

$('#tblBiblioteca').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
    'paging': true,
    'info': true,
    'filter': true,
    'stateSave': true,
    "ordering": false, //quito ordenamiento asc y desc  

    'ajax': {
        "url":baseurl+"cdocumentos/obtenerDocumentos",
        "type":"POST",
        dataSrc: ''
    },'columns': [
        {
            "render": function (data, type, row) {
                var rating =0;
                var votos =0;
                if(row.rating != null && row.rating != 'null' ){
                    rating = parseInt(row.rating);
                }
                if(row.votos != null && row.votos != 'null' ){
                    votos = parseInt(row.votos);
                }

                var estrellas= '';
                if(rating==0){
                    estrellas='<span >Aun sin valorar</span>'
                }
                if(rating>=1 && rating<2){
                    estrellas=' <div id="colorstrellas"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty">'+
                        '</span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">'+
                        ' </span><span class="glyphicon glyphicon-star-empty"></span></div>';
                }else if((rating>=2 && rating<3)){
                    estrellas=' <div id="colorstrellas"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">'+
                        '</span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">'+
                        ' </span><span class="glyphicon glyphicon-star-empty"></span></div>';
                }else if((rating>=3 && rating<4)){
                    estrellas=' <div id="colorstrellas"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">'+
                        '</span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty">'+
                        ' </span><span class="glyphicon glyphicon-star-empty"></span></div>';
                }else if((rating>=4 && rating<5)){
                    estrellas=' <div id="colorstrellas"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">'+
                        '</span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">'+
                        ' </span><span class="glyphicon glyphicon-star-empty"></span></div>';
                }else if((rating==5)){
                    estrellas='<div id="colorstrellas"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">'+
                        '</span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">'+
                        ' </span><span class="glyphicon glyphicon-star-empty"></span></div>';
                }
                return '	<div class="media"> <a href="#" class="pull-left">'+
                    '<img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;">'+
                    '</a>'+
                '<div class="media-body">'+
                            //'<span  class="media-meta pull-right"> <i class="glyphicon glyphicon-star"> </i></span>'+
                            '<h4 class="title">'+row.nombredoc +
                            '</h4>'+ estrellas+
                            '<p >'+votos+' Valoraciones</p>'+
                       '</div></div>';
            }
        },
        {
            "render": function (data, type, row) {
                var formato = row.formato.split("/");
                var extencion = formato[1];
                var descarga=baseurl+'cdocumentos/visualizarDocumentos/'+row.nombredoc+'.'+extencion;
                return '<a href="'+ descarga+'"target="_blank" <span class="fa fa-search" aria-hidden="true"></span></a> '+
                    '&nbsp;&nbsp;<a href="#" title="Valorar Libro" data-toggle="modal" ' +
                    'data-target="#modalValoracion" ' +
                    'onClick="infoLibro(\'' + row.nombredoc + '\',\'' + row.iddoc + '\');"><span  class="fa fa-star" </span></a>' ;
            }
        },

    ],

  ///  "order": [[ 1, "asc" ]],
});

    $.post(baseurl + "cdocumentos/kVecinos",
        function(data){
           console.log(data);
            var p = JSON.parse(data);
            console.log(p);
            libros=p.length;
            if(libros ==1){
                $("#libro").html('<a href="#" class="pull-left"><img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;"></a>');
                $('#titulo2').fadeOut();
                $('#titulo3').fadeOut();
            }else if(libros ==2){
                $("#libro").html('<a href="#" class="pull-left"><img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;"></a>');
                $("#libroa").html('<a href="#" class="pull-left"><img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;"></a>');

                $('#titulo3').fadeOut();
            }else if(libros ==3){
                $("#libro").html('<a href="#" class="pull-left"><img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;"></a>');
                $("#libroa").html('<a href="#" class="pull-left"><img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;"></a>');
                $("#librob").html('<a href="#" class="pull-left"><img src='+baseurl+'assets/img/book.png class="media-photo"style="margin-top: 12px;"></a>');

            }
            for(var i=0;i<p.length;i++){
                nombre=p[i].nombredoc;
                $("#libro"+(i+1)).text(''+nombre+'');
                
            }

        });
});

infoLibro = function(nombreLibro,iddoc){
$('#nombreLibro').text(nombreLibro);
    $('#iddoc').val(iddoc);
    $('#nombreLibro').show();
    $('#colorstar').show();
    $('#count').show();
    $('#meaning').show();
    $('#valorarb').show();
    $('#texto').show();
    $('#exito').fadeOut();

 //alert('aqui valoro');
};
valorarLibro= function(){
var valor=  document.getElementById("count").innerHTML;
var id=$('#iddoc').val();
    $('#nombreLibro').fadeOut();
    $('#colorstar').fadeOut();
    $('#count').fadeOut();
    $('#meaning').fadeOut();
    $('#valorarb').fadeOut();
    $('#texto').fadeOut();
    $('#loadbar').show();
    $.post(baseurl + "cdocumentos/valorarLibros",
        {
            iddoc:id,
            valor:valor
        },
        function(data){
            setTimeout(function(){
                $('#loadbar').fadeOut();
                /* something else */
                $('#exito').text('Valoración realizada con Éxito');
                $('#exito').show();
            }, 1500);

        });
};

// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'span', function(e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'span', function(e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});

$( document ).ready(function() {

    var correspondence=["","Muy Malo","Malo","Regular","Bueno","Excelente"];

    $('.ratable').on('starrr:change', function(e, value){

        $(this).closest('.evaluation').children('#count').html(value);
        $(this).closest('.evaluation').children('#meaning').html(correspondence[value]);

        var currentval=  $(this).closest('.evaluation').children('#count').html();

        var target=  $(this).closest('.evaluation').children('.indicators');
        target.css("color","black");
        target.children('.rateval').val(currentval);
        target.children('#textwr').html(' ');


        if(value<3){
            target.css("color","red").show();
            target.children('#textwr').text('What can be improved?');
        }else{
            if(value>3){
                target.css("color","green").show();
                target.children('#textwr').html('What was done correctly?');
            }else{
                target.hide();
            }
        }

    });
});