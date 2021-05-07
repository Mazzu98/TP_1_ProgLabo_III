<?php

    session_start();
    session_unset();
    header('Location: ./../frontend/login_PDO.html');

?>