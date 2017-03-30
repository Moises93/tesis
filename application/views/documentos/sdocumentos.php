<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 25-02-2017
 * Time: 20:39
 */

//include_once 'config.inc.php';

?>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div style="width: 500px;margin: auto;border: 1px solid blue;padding: 30px;">
    <h4>Subir PDF</h4>
    <form method="post" action="cargarMultiplesArchivos" name="h" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label>Nombre Archivo</label></td>
                <td><input type="text" name="titulo"></td>
            </tr>
            <tr>
                <td><input type=hidden name="descripcion" value="archivoPrueba"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="file" multiple="" name="userfile[]">
                </td>
            <tr>
                <td><input type="submit" value="Submit" name="fieldname" ></td>
            </tr>
        </table>
    </form>

    <!--<form method="post" action="cargar_archivo" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label>Nombre Archivo</label></td>
                <td><input type="text" name="titulo"></td>
            </tr>
            <tr>
                <td><input type=hidden name="descripcion" value="archivoPrueba"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="file" name="archivo"></td>
            <tr>
                <td><input type="submit" value="Submit" ></td>
            </tr>
        </table>
    </form>-->

    
</div>
</body>
</html>
