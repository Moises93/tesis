<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 26-02-2017
 * Time: 10:10
 */
if( isset ($mensaje )) {
    if( $mensaje == "1" )
        echo "<script type='text/javascript'>alertify.success('Operación realizada con exito')</script>";
    else
        echo "<script type='text/javascript'>alert('".$mensaje."')</script>";
}
?>

<!--
<div class="container">
    <h2>Formatos de Pasantias</h2>
    <p>Descarga los formatos de pasantia haciendo click</p>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1">Lista </i></a>
                </h4>

            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item">Formato de carta de postulaci&oacute;n de pasant&iacute;as</li>
                    <li class="list-group-item">Carta de aceptaci&oacute;n y plan de pasant&iacute;as</li>
                    <li class="list-group-item">Carta de exoneraci&oacute;n de pasant&iacute;as</li>
                </ul>
                <div class="panel-footer">Footer</div>
            </div>
        </div>
    </div>
</div>
-->
<div class="container">
    <h2>Trámites de Pasantia</h2>
    <p>Descarga los formatos de pasantia desde tu pagina de Inicio</p></br></br>
    <div class="row form-group">
        <div class="col-xs-11">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="active"><a href="#step-1">
                        <h4 class="list-group-item-heading">Curriculum</h4>
                        <p class="list-group-item-text"></p>
                    </a></li>
                 <li class="active"><a href="#step-2">
                        <h4 class="list-group-item-heading">Carta de Postulación</h4>
                        <p class="list-group-item-text"></p>
                </a></li>
                <li class="disabled"><a href="#step-3">
                        <h4 class="list-group-item-heading">Carta de Aceptación</h4>
                        <p class="list-group-item-text"></p>
                    </a></li>
                <li class="disabled"><a href="#step-4">
                        <h4 class="list-group-item-heading">Plan de Actividades</h4>
                        <p class="list-group-item-text"></p>
                    </a></li>
                <li class="disabled"><a href="#step-5">
                        <h4 class="list-group-item-heading">Informe Final</h4>
                        <p class="list-group-item-text"></p>
                    </a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-11">
            <div class="col-md-12 well setup-content text-center" id="step-1">
                <h1 class="text-center"> PASO 1</h1>
                <div style="text-align: justify;" class="panel-body">Sube tu Currículo para que todos lo vean y puedan contactarte</br>
                    <p style="text-align: justify;"><strong>Síntesis Curricular </strong>(Tamaño máximo 250Kb)</br>
                        <strong>Formatos permitidos:</strong>(.pdf,.doc,.docx,.ppt,.pptx)</p>
                    <form method="post" action="cargar_requisito" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><input type=hidden name="requisito" value="cv"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="file" name="requisitos"></td></br>
                            </tr>
                            <?php
                            if($cv != "0") {
                                echo "<tr>";
                                echo " <td><input type='submit' value='cambiar' ></td>";?>
                                <input type="hidden" id="pasos1" value="1">
                                <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $cv;?>"><?php echo $cv;?> Descargar</a></td>
                                <?php
                                echo "</tr>";
                            }else{
                                ?>
                              
                                <input type="hidden" id="paso1" value="<?php echo $cv;?>">
                                <?php

                                echo" <tr>";
                                echo " <td><input type='submit' value='subir' ></td>";
                                echo   "</tr>";
                            }
                            ?>

                        </table>


                    </form>
                </div>

                <button id="activate-step-2" class="btn btn-primary btn-lg">Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-11">
            <div class="col-md-12 well setup-content text-center" id="step-2">
                <h1 class="text-center"> PASO 2</h1>
                <div style="text-align: justify;" class="panel-body">Sube tu Carta de Postulación</br>
                    <p style="text-align: justify;"><strong>Síntesis Curricular </strong>(Tamaño máximo 250Kb)</br>
                        <strong>Formatos permitidos:</strong>(.pdf,.doc,.docx,.ppt,.pptx)</p>
                    <form method="post" action="cargar_requisito" id="form_id" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><input type=hidden name="requisito" value="cartaPostulacion"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="file" name="requisitos"></td></br>
                            </tr>
                            <?php
                            if($postulacion != "0") {
                                echo "<tr>";
                                echo " <td><input type='submit' value='cambiar' ></td>";?>
                                <input type="hidden" id="pasos2" value="1">
                                <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $postulacion;?>"><?php echo $postulacion;?> Descargar</a></td>
                                <?php
                                echo "</tr>";
                            }else{
                                ?>
                              
                                <input type="hidden" id="paso2" value="<?php echo $postulacion;?>">
                                <?php

                                echo" <tr>";
                                echo " <td><input type='submit' value='subir' ></td>";
                                echo   "</tr>";
                            }
                            ?>

                        </table>


                    </form>
                </div>

                <button id="activate-step-3" class="btn btn-primary btn-lg">Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-11">
            <div class="col-md-12 well setup-content text-center" id="step-3">
                <h1 class="text-center"> PASO 3</h1>
                <div style="text-align: justify;" class="panel-body">Sube tu Carta de aceptación y así inicia en el sistema tu gestión de pasantía</br>
                    <p style="text-align: justify;"><strong>Carta de Aceptaci&oacute;n </strong>(Tamaño máximo 1Mb)</br>
                        <strong>Formatos permitidos:</strong>(.pdf,.doc,.docx)</p>
                    <form method="post" action="cargar_requisito" id="form_id" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><input type=hidden name="requisito" value="cartaAceptacion"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="file" name="requisitos"></td></br>
                            </tr>
                            <?php
                            if($aceptacion != "0") {
                                echo "<tr>";
                                
                                echo " <td><input type='submit' value='cambiar' ></td>";
                                ?>
                                <input type="hidden" id="pasos3" value="1">
                                <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $aceptacion;?>"><?php echo $aceptacion;?> Descargar</a></td>
                                <?php
                                echo "</tr>";


                            }else{
                                ?>
                                <input type="hidden" id="paso3" value="<?php echo $aceptacion;?>">
                                <?php
                                echo" <tr>";
                                echo " <td><input type='submit' value='subir' ></td>";
                                echo   "</tr>";
                            }
                            ?>

                        </table>


                    </form>
                </div>

                <button id="activate-step-4" class="btn btn-primary btn-lg">Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-11">
            <div class="col-md-12 well setup-content text-center" id="step-4">
                <h1 class="text-center"> PASO 4</h1>
                <div style="text-align: justify;" class="panel-body">Sube tu plan de actividades para poder ser evaluado</br>
                    <p style="text-align: justify;"><strong>Plan de Actividades </strong>(Tamaño máximo 1Mb)</br>
                        <strong>Formatos permitidos:</strong>(.pdf,.doc,.docx)</p>
                    <form method="post" action="cargar_requisito" id="form_id" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><input type=hidden name="requisito" value="planActividades"></td>
                            </tr>
                            <tr>
                                           <?php if( $escuela !=null ){?>
                                               <input type="hidden" id="vescuela" value="<?php echo $escuela;?>">
                                            <?php } ?>
                                                <div class="form-group">
                                                    <label>* Linea de Investigación</label>
                                                    <select id="cbLineasr" class="form-control" name="cbLineasr" required>
                                                        <option value="-1">seleccione:</option>
                                                    </select>

                                              
                                            </div>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="file" name="requisitos"></td></br>
                            </tr>
                            <tr>
                            <?php
                            if($actividades != "0") {
                                echo "<tr>";
                                echo " <td><input type='submit' value='cambiar' ></td>";?>
                                <input type="hidden" id="pasos4" value="1">
                                <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $actividades;?>"><?php echo $actividades;?> Descargar</a></td>
                                <?php
                                echo "</tr>";


                            }else{
                                echo" <tr>";
                                echo " <td><input type='submit' value='subir' ></td>";
                                echo   "</tr>";
                            }
                            ?>
                            </tr>
                        </table>


                    </form>
                </div>
                <button id="activate-step-5" class="btn btn-primary btn-lg">Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-11">
            <div class="col-md-12 well setup-content text-center" id="step-5">
                <h1 class="text-center"> PASO 5</h1>
                <div style="text-align: justify;" class="panel-body">Sube tu Informe Final y concluye con los requisitos exigidos, Recuerda
                    valorar los libros que te ayudaron en la sección de biblioteca</br>
                    <p style="text-align: justify;"><strong>Informe Final</strong>(Tamaño máximo 8Mb)</br>
                        <strong>Formatos permitidos:</strong>(.pdf,.doc,.docx,.pdf)</p>
                    <form method="post" action="cargar_requisito" id="form_id" enctype="multipart/form-data">
                        <span>Titulo del Informe Final</span>
                        <input type=text name="titulo" ></br>
                        <table>
                            <tr>
                                <td><input type=hidden name="requisito" value="informeFinal"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="file" name="requisitos"></td></br>
                            </tr>
                            <?php
                            if($informeFinal != "0") {

                                echo "<tr>";
                                echo " <td><input type='submit' value='cambiar' ></td>"?>
                                <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $informeFinal;?>">
                                <!--<input type="hidden" id="pasos4" value="1">-->
                                <?php echo $informeFinal;?> Descargar</a></td>
                                <?php
                                echo "</tr>";


                            }else{
                                echo" <tr>";
                                echo " <td><input type='submit' value='subir' ></td>";
                                echo   "</tr>";
                            }
                            ?>

                        </table>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
