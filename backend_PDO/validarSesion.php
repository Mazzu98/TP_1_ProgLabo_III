<?php

    session_start();
    if(!isset($_SESSION['DNIEmpleado'])){
        header('Location: ./../frontend/login_PDO.html');
    }

?>