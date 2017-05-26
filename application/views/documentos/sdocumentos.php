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
                            <form method="post" action="cargar_archivo" name="h" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                             <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Escuela</label>
                                                    <select id="cescuela" class="form-control" name="cescuela" onchange="mostrarLineas()" required>
                                                        <option value="-1">seleccione:</option>
                                                    </select>

                                                </div>
                                            </div>

                                            
                                    </tr>
                                    <tr>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Linea de Investigación</label>
                                                    <select id="cbLineas" class="form-control" name="cbLineas" required>
                                                        <option value="-1">seleccione:</option>
                                                    </select>

                                                </div>
                                            </div>
                                    </tr>
                                    <tr>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="comment">Descripcion:</label>
                                                <textarea class="form-control" rows="5" id="descripcion" name="descripcion"></textarea>
                                            </div>
                                        </div>     
                                    </tr>
                                    <tr>
                                      <!--  <td><input type=hidden name="descripcion" value="archivoPrueba"></td>-->
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="file" name="archivo"> <!--este nombre es importante :archivo-->
                                        </td>

                                    </tr>
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
