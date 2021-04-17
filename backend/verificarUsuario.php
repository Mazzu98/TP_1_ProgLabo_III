<?php
    include_once './empleado.php';

    $dni = isset($_POST['txtDni']) ? $_POST['txtDni'] : 0;
    $apellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "";

    $file = fopen('./archivos/empleados.txt','r');
    while(!feof($file)){
        $linea = trim(fgets($file));
        $lineaArray = explode(' - ',$linea);
        if($lineaArray[0]!== '' && $lineaArray[0]!== "\r\n"){
            if($lineaArray[1] == $apellido && $lineaArray[2] == $dni){
                session_start();
                $_SESSION['DNIEmpleado'] = $dni;
                header('Location: ./mostrar.php');
            }
        }
    }
    echo "No se pudo loguear <br>";
    echo "<a href='./../frontend/login.html'>Login</a>";
    //TODO; cambiar ref

?>