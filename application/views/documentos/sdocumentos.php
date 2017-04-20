<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 25-02-2017
 * Time: 20:39
 */

//include_once 'config.inc.php';

?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body" style="align-content: center">
                            <h4>Subir Documentos</h4>
                            <form method="post" action="cargarMultiplesArchivos" name="h" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <!--<td><label>Nombre Archivo</label></td>
                                        <td><input type="text" name="titulo"></td>-->
                                    </tr>
                                    <tr>
                                        <td><input type=hidden name="descripcion" value="archivoPrueba"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="file" multiple="" name="userfile[]">
                                        </td>
                                    <tr>
                                        <td><input type="submit" value="Subir" name="fieldname" ></td>
                                    </tr>
                                </table>
                            </form>
                </div>
            </div>
</div>
</div>
</section>
