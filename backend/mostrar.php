<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./../frontend/javascript/funciones.js"></script>
    <title>Listado de Empleados</title>
</head>
<body>
    <h2>Listado de Empleados</h2>
    <form id='form' action="./../frontend/index.php" method="POST">
    <table align="center">
        <tr>
            <td>
                <h4>Info</h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <?php
        include_once './fabrica.php';
        include_once './validarSesion.php';

        $fabrica = new Fabrica('RI',7);
        $fabrica->TraerDeArchivo("./archivos/empleados.txt");
        $empleados = $fabrica->GetEmpleados();
        
        foreach($empleados as $empleado){
            $legajo = $empleado->GetLegajo();
            $path = $empleado->GetPathFoto();
            $dni = $empleado->GetDni();
            echo "<tr>";
            echo "<td>";
            echo $empleado->toString();
            echo "</td>";
            echo "<td>";
            echo "<img src='$path' width='90px' height='90px'> ";
            echo "</td>";
            echo "<td>";
            echo "<a href='./eliminar.php?legajo=$legajo'>Eliminar</a>";
            echo "</td>";
            echo "<td>";
            echo "<input type='button' value='Modificar' onclick='AdministrarModificar($dni)'>";
            echo "</td>";
            echo "</tr>";

        }
        ?>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        <input type='hidden' id='dni' name='dni'>
    </table>
    </form>
    <a href="./../frontend/index.php">Alta de Empleados</a>
    <!-- TODO: cambiar referencia -->
    <br>
    <a href="cerrarSesion.php">Log out</a>
</body>
</html>