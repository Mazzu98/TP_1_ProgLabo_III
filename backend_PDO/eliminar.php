<?php
    include_once './empleado.php';
    include_once './fabrica.php';


    $legajo = $_GET['legajo'];

    $fabrica = new Fabrica('RI',7);
    
    $fabrica->TraerDeBD();
    foreach($fabrica->GetEmpleados() as $empleado){
        if($legajo == $empleado->GetLegajo()){
            $fabrica->EliminarEmpleado($empleado);
        }
    }
    
    if($query->execute()){
        echo "empleado eliminado correctamente";  
    }
    else
    {
        echo "El empleado no se pudo eliminar";
    }
?>