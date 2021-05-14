<?php
include_once './../backend_PDO/validarSesion.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='./javascript/funciones_PDO.js'></script>
    <title>App</title>
</head>

<body onload="indexOnLoad()">
    <table align="center" border="">
        <tr>
            <td colspan="3">
                <div id="nombre" style="padding: 0 20px">
                <h2>
                    Mazzucchelli Juan
                </h2>
            </div>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <div id="forms" style="height: 80vh; overflow-y: auto; padding: 0 20px">
                    
                </div>
            </td>
            <td colspan="2">
                <div id="mostrar" style="height: 80vh; overflow-y: auto; padding: 0 20px"></div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="links" style="padding:20px">
                <a href="./../backend_PDO/cerrarSesion.php">Log out</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a onclick="cargarForm()" style="color: purple; cursor:pointer; text-decoration: underline">Alta de empleados</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="./../backend_PDO/mdf.php" target="_BLANK" style="color: purple; cursor:pointer; text-decoration: underline">Generar pdf</a>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>