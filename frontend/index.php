<?php

include_once './../backend/fabrica.php';
include_once './../backend/validarSesion.php';

$fabrica = new Fabrica('RI', 7);
$fabrica->TraerDeArchivo('./../backend/archivos/empleados.txt');

$apellidoNombre = '';
foreach($fabrica->GetEmpleados() as $empleado){

    if($empleado->GetDni() == $_SESSION['DNIEmpleado']){
        $apellidoNombre = $empleado->GetApellido() . ' ' . $empleado->GetNombre();
        break;
    }
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='./javascript/funciones.js'></script>
    <title>App</title>
</head>

<body onload="indexOnLoad()">
    <table align="center" border="">
        <tr>
            <td colspan="3">
                <div id="nombre" style="padding: 0 20px">
                <h2>
                    <?php echo $apellidoNombre; ?>
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
                <a href="./../backend/cerrarSesion.php">Log out</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a onclick="cargarForm()" style="color: purple; cursor:pointer; text-decoration: underline">Alta de empleados</a>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>