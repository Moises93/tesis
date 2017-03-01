<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 26-02-2017
 * Time: 10:10
 */
if( isset ($mensaje )) {
    if( $mensaje == "1" )
        echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
    else
        echo "<script type='text/javascript'>alert('".$mensaje."')</script>";
}
?>


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

<div class="container">
    <h2>Subir requisitos</h2>
    <p><strong>Note:</strong> The <strong>data-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">Paso 1</a>
                </h4>
            </div>
            <div id="collapse11" class="panel-collapse collapse in">
                <div class="panel-body">Descarga la carta de postulaci&oacute;n de pasant&iacute;as llenala con tus datos y llevala a
                la coordinaci&oacute;n de pasantias para ser sellada y firmada luego a la empresa donde deseas postularte.</br>
                    <form method="post" action="cargar_requisito" enctype="multipart/form-data">
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
                                    echo " <td><input type='submit' value='cambiar' ></td>";
                                    ?>
                                    <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $postulacion;?>"><?php echo $postulacion;?> Descargar</a></td>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">paso 2</a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">Descarga la carta de postulaci&oacute;n de pasant&iacute;as llenala con tus datos y llevala a
                    la coordinaci&oacute;n de pasantias para ser sellada y firmada luego a la empresa donde deseas postularte.</br>
                    <form method="post" action="cargar_requisito" enctype="multipart/form-data">
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
                                echo " <td><input type='submit' value='cambiar' ></td>";?>
                            <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $aceptacion;?>"><?php echo $aceptacion;?> Descargar</a></td>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Paso 3</a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">Descarga la carta de postulaci&oacute;n de pasant&iacute;as llenala con tus datos y llevala a
                    la coordinaci&oacute;n de pasantias para ser sellada y firmada luego a la empresa donde deseas postularte.</br>
                    <form method="post" action="cargar_requisito" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><input type=hidden name="requisito" value="planActividades"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="file" name="requisitos"></td></br>
                            </tr>
                            <?php
                            if($actividades != "0") {
                                echo "<tr>";
                                echo " <td><input type='submit' value='cambiar' ></td>";?>

                               <td>&nbsp; <a href="<?php echo base_url();?>cpasante/downloads/<?php echo $actividades;?>"><?php echo $actividades;?> Descargar</a></td>
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


