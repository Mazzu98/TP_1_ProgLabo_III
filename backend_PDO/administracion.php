<?php

    include_once './empleado.php';
    include_once './fabrica.php';


    $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
    $apellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "";
    $dni = isset($_POST['txtDni']) ? $_POST['txtDni'] : 0;
    $sexo = isset($_POST['cboSexo']) ? $_POST['cboSexo'] : "";
    $legajo = isset($_POST['txtLegajo']) ? $_POST['txtLegajo'] : 0;
    $sueldo = isset($_POST['txtSueldo']) ? $_POST['txtSueldo'] : 0;
    $turno = isset($_POST['rdoTurno']) ? $_POST['rdoTurno'] : "";
    $hdnModificar = isset($_POST['hdnModificar']) ? $_POST['hdnModificar'] : "";
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : "";

    $fotoValidada = false;

    if($foto !== ""){
        if(getimagesize($foto['tmp_name'])){
            if($foto['type'] =='image/jpg' || $foto['type'] =='image/bmp' || $foto['type'] =='image/gif' || $foto['type'] =='image/png' || $foto['type'] =='image/jpeg' ){
                $destino = "./fotos/" . $dni . "-" . $apellido . "." . pathinfo($foto['name'],PATHINFO_EXTENSION);
                if(!file_exists($destino) || $hdnModificar != ''){
                    if($foto['size']  <= 1 * 1024 * 1024){
                        $fotoValidada = true;
                    }
                }
            }
        }
    }

    if($nombre !== "" & $apellido !== "" && $sexo !== "" && $turno !== "" && $foto !=="" && $dni !== 0 && $legajo !== 0 && $sueldo !== 0 && $fotoValidada ){
        $empleado = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);
        $empleado->SetPathFoto($destino);
        $fabrica = new Fabrica('RI',20);
        $fabrica->TraerDeBD();
        if($hdnModificar != ''){
            if($fabrica->ModificarEmpleado($empleado,$foto,$destino)){
                unlink($empleado->GetPathFoto());
                move_uploaded_file($foto['tmp_name'],$destino);
            }
        }
        else
        {
            if($fabrica->AgregarEmpleado_DB($empleado)){
                move_uploaded_file($foto['tmp_name'],$destino);
            }
        }
    }
?>
