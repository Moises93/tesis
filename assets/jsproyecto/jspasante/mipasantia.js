/**
 * Created by Moises on 31-03-2017.
 */
$(document).ready(function(e) {

    $('#miPasantia').show();
    var nombreTa='';
    $.post(baseurl + "cpasante/miPasantia",
        function(data){
            var p = JSON.parse(data)[0];


            $("#escuela").text(p.escuela);
          //  if(parseInt(p.orgaca)==1){
             //   $("#empresa").text(p.universidad);
         //   }else{
                $("#empresa").text(p.empresa);
                $("#idEmpresa").val(p.empresa_id);

          //  }
            if(p.integrantes!=null){
                if(p.integrantes.academico !=null){
                    nombreTa=p.integrantes.academico.info.pro_apellido+' '+p.integrantes.academico.info.pro_nombre;
                    $("#nombreTa").text(nombreTa);
                    $("#correTa").text(p.integrantes.academico.info.usu_correo);

                }else{
                    $("#nombreTa").text('Tutor No asignado');
                }
                if(p.integrantes.organizacional !=null){
                    nombreTa=p.integrantes.organizacional.info.apellido+' '+p.integrantes.organizacional.info.nombre;
                    $("#nombreTe").text(nombreTa);
                    $("#correTe").text(p.integrantes.organizacional.info.correo);

                }

            }
        });
});
function evaluarEmpresa() {
  //  var id=$("#idEmpresa").val();
//alert(id);

    $('#nombreLibro').show();
    $('#colorstar').show();
    $('#count').show();
    $('#meaning').show();
    $('#valorarb').show();
    $('#texto').show();

    $('#comentario').show();
    $('#comentariot').show();
    $('#exito').fadeOut();
}
valorarEmpresa= function(){
    var id=$("#idEmpresa").val();
    var comentario=$("#comentario").val();
    var valor=  document.getElementById("count").innerHTML;
    $('#nombreLibro').fadeOut();
    $('#colorstar').fadeOut();
    $('#count').fadeOut();
    $('#meaning').fadeOut();
    $('#valorarb').fadeOut();
    $('#comentario').fadeOut();
    $('#comentariot').fadeOut();
    $('#texto').fadeOut();
    $('#loadbar').show();

    $.post(baseurl + "empresa/valorarEmpresa",
        {
            idemp:id,
            valor:valor,
            comentario:comentario
        },
        function(data){
            setTimeout(function(){
                $('#loadbar').fadeOut();

                $('#exito').text('Valoración realizada con Éxito');
                $('#exito').show();
            }, 1500);

        });
};
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