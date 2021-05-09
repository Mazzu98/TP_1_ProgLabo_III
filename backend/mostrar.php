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
    <form>
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

        $fabrica = new Fabrica('RI',7);
        $fabrica->TraerDeArchivo("./archivos/empleados.txt");
        $empleados = $fabrica->GetEmpleados();
        
        foreach($empleados as $empleado){
            $legajo = $empleado->GetLegajo();
            $path ="./../backend/" . $empleado->GetPathFoto();
            $dni = $empleado->GetDni();
            echo "<tr>";
            echo "<td>";
            echo $empleado->toString();
            echo "</td>";
            echo "<td>";
            echo "<img src='$path' width='90px' height='90px'> ";
            echo "</td>";
            echo "<td>";
            echo "<a onclick='eliminarEmpleado($legajo)' style='cursor: pointer; color: purple; text-decoration: underline' >Eliminar</a>";
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
    <!-- TODO: cambiar referencia -->
</body>
</html>