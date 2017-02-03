<body ><!--class="hold-transition register-page"-->

<script>
$(document).ready(function(e) {
      // Valida algun cambio en Sucursal
    $('#paisId').change(function(e) {
      var idsuc = $(this).val();
      if (idsuc == ''){
        idsuc = null;
      }
      
      $.post ("<?php echo base_url(); ?>" + "empresa/EstdadosxPais", { pais : idsuc }, function(res) {

        // Parsea
        var json = $.parseJSON(res);
        
        // Muestra los resultados
        var estados = json;
        var lp = estados.length;
        $('#estadoId').html('<option value="">Seleccione Estado</option>');
        for (var i = 0; i < lp; i++) {
          var opt = '<option value=' + '"'+estados[i].id + '"'+'>' + estados[i].estadonombre  +'</option>';
          $('#estadoId').append(opt);
        }
        
        // Refresca
        $('#estadoId').selectpicker('refresh');

      });
    });
});
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });

    $(".next-step1").click(function (e) {
        if(($("#paisId").val()=="") || ($("#estadoId").val()=="") || ($("#numregistro").val()=="")
          || ($("#NombreEmpresa").val()=="") || ($("#Ciudad").val()=="") || ($("#Direccion").val()=="")
          || ($("#Sector").val()=="")){
         document.getElementById("mobligrif").style.display='block';
        }else{
          document.getElementById("mobligrif").style.display='none';
           var $active = $('.wizard .nav-tabs li.active');
           $active.next().removeClass('disabled');
           nextTab($active);
        }
    });

    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


//according menu

$(document).ready(function()
{
    //Add Inactive Class To All Accordion Headers
    $('.accordion-header').toggleClass('inactive-header');
  
  //Set The Accordion Content Width
  var contentwidth = $('.accordion-header').width();
  $('.accordion-content').css({});
  
  //Open The First Accordion Section When Page Loads
  $('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
  $('.accordion-content').first().slideDown().toggleClass('open-content');
  
  // The Accordion Effect
  $('.accordion-header').click(function () {
    if($(this).is('.inactive-header')) {
      $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
      $(this).toggleClass('active-header').toggleClass('inactive-header');
      $(this).next().slideToggle().toggleClass('open-content');
    }
    
    else {
      $(this).toggleClass('active-header').toggleClass('inactive-header');
      $(this).next().slideToggle().toggleClass('open-content');
    }
  });
  
  return false;
});


</script>



<div>
  <div class="register-logo">
    <!--<a href=""><b>SIS</b>pas</a>-->
    <img src="<?=asset_url("img/SIS.jpg")?>" width="250" height="130">
      <!--<a href=""><b>SIS</b>pas</a>-->
  </div>

  <div class="container">
    <div class="row">
      <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-briefcase"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        </a>
                    </li> 
                     <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                        </a>
                    </li>                  
                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

              <form form id="register" action="<?=base_url('empresa/guardarEmpresa')?>" role="form" method="post" enctype="multipart/form-data">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                    <center><label id="mobligrif" name="mobligrif" style="display:none;"><FONT COLOR="red">* Por favor ingrese todos los campos son de caracter obligatorio</FONT></label>  </center>
                        <div class="step1">
                            <div class="row">
                            <div class="col-md-6">
                                <label for="numregistro">Numero de Registro (*)</label>
                                <input type="text" id="numregistro" name="numregistro" class="form-control" placeholder="Numero de Registro" required>
                            </div>
                            <div class="col-md-6">
                                <label for="NombreEmpresa">Nombre Empresa (*)</label>
                                <input type="text" id="NombreEmpresa" name="NombreEmpresa" class="form-control" placeholder="Nombre de la Empresa" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="paisId">Pais (*)</label>
                                <center>
                                     <select class="form-control select2" style="width: 100%;" id="paisId" name="paisId" required>
                                             <option value="" selected>Seleccione Pais</option>
                                               <?php foreach($Paises as $row): ?>
                                           <option value="<?=$row->id?>"><?=$row->paisnombre?></option>
                                       <?php endforeach;?>
                                     </select>
                                  </center>
                            </div>
                            <div class="col-md-6">
                                <label for="Ciudad">Ciudad (*)</label>
                                 <input type="text" id="Ciudad" name="Ciudad" class="form-control" placeholder="Ciudad" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="estadoId">Estado (*)</label>
                                <center>
                                      <select class="form-control select2" id="estadoId" name="estadoId" required  data-width='100%'>
                                            <option value="" selected>Seleccione Estado</option>
                                     </select>
                                </center>
                            </div>
                            <div class="col-md-6">
                            <label for="Direccion">Direccion (*)</label> 
                              <div class="col-md-4 col-xs-4">  
                            <label for="Sector">Sector (*)</label>
                            </div>
                                <div class="row">
                                    <div class="col-md-3 col-xs-3">
                                        <input type="text" id="Sector" name="Sector" class="form-control" placeholder="Sector" required>
                                    </div>
                                    
                                    <div class="col-md-9 col-xs-9">
                                        <input type="text" id="Direccion" name="Direccion" class="form-control" placeholder="Direccion" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step1">Guardar y Continuar</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                     <div class="box box-primary">
                        <div class="step2">
                         <center>Ingrese Habilidades del Pasante que Busca</center>
                              

                            <div class="step-21">
                            <div class="row">
                           <div class="col-md-3 col-xs-3">
                                   <label>Escuela</label>
                                   <select class="form-control select2" style="width: 100%;">
                                     <option selected="selected" value="1">Computacion</option>
                                     <option disabled="disabled">Quimica</option>
                                     <option disabled="disabled">Biologia</option>
                                     <option disabled="disabled">Fisica</option>
                                     <option disabled="disabled">Matematica</option>
                                  </select>
                                
                              </div>
                                 <div class="col-md-9 col-xs-9">
                                   <label>Habilidades</label>
                                      <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                      </select> 
                                  </div>        
                                </div>
                           </div>
                            <div class="step-22">
                            
                            </div>
                        </div>
                        <br>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Volver Atras</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Guardar y Continuar</button></li>
                        </ul>
                    </div>
                    </div>
                     <div class="tab-pane" role="tabpanel" id="step3">
                        <div class="step33">
                        
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>

                    <div class="tab-pane" role="tabpanel" id="complete">
                        <div class="step44">
                            <h5>Completed</h5>
                            
                          
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
   </div>
</div>


</div>

</body>
