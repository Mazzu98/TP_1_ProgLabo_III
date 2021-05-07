<?php
    //include_once './empleado.php';
    include_once './fabrica.php';

    $dni = isset($_POST['txtDni']) ? $_POST['txtDni'] : 0;
    $apellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "";

    $fabrica = new Fabrica('RI',20);
    $fabrica->TraerDeBD();

    foreach($fabrica->GetEmpleados() as $emp){
        if($emp->GetApellido() == $apellido && $emp->GetDni() == $dni){
            session_start();
            $_SESSION['DNIEmpleado'] = $dni;
            header('Location: ./../frontend/index_PDO.php');
        }
    }

    echo "No se pudo loguear <br>";
    echo "<a href='./../frontend/login_PDO.html'>Login</a>";

?>