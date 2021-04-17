<?php

    session_start();
    if(!isset($_SESSION['DNIEmpleado'])){
        header('Location: ./../frontend/login.html');
    }

?>