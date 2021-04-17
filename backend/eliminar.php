<?php
    include_once './empleado.php';
    include_once './fabrica.php';


    $legajo = $_GET['legajo'];
    $archivo = fopen('./archivos/empleados.txt','r+');
    $empleado = null;
    while(!feof($archivo)){
        $linea = trim(fgets($archivo));
        if(strlen($linea)>0){
            $arrayLinea = explode(" - ",$linea);
            if($arrayLinea[4]==$legajo){
                $empleado = new Empleado($arrayLinea[0],$arrayLinea[1],$arrayLinea[2],$arrayLinea[3],$arrayLinea[4],$arrayLinea[5],$arrayLinea[6]);
                $empleado->SetPathFoto($arrayLinea[7]);
                break;
            }
        }
    }
    if($empleado != null){
        $fabrica = new Fabrica('RI',7);
        $fabrica->TraerDeArchivo('./archivos/empleados.txt');
        $path = $empleado->GetPathFoto();
        
        if($fabrica->EliminarEmpleado($empleado)){
            unlink($path);
            $fabrica->GuardarEnArchivo('./archivos/empleados.txt');
            echo "empleado eliminado correctamente";
        }
        else
        {
            echo "El empleado no se pudo eliminar";
        }    
    }
    else
    {
        echo "El empleado no se pudo eliminar";
    }
    echo "<br><a href='./mostrar.php'>Mostrar</a>";
    echo "<br><a href='./../frontend/index.html'>Alta de Empleados</a>"

    
?>