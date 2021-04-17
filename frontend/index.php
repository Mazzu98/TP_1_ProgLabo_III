<?php
    include_once './../backend/fabrica.php';

    $dni = isset($_POST['dni']) ? $_POST['dni'] : '';

    if($dni != ''){
        $fabrica = new Fabrica('RI',7);
        $fabrica->TraerDeArchivo('./../backend/archivos/empleados.txt');
        foreach($fabrica->GetEmpleados() as $empleado){
            if($empleado->GetDni() == +$dni){
                $nombre = $empleado->GetNombre();
                $apellido = $empleado->GetApellido();
                $sexo = $empleado->GetSexo();
                $legajo = $empleado->GetLegajo();
                $sueldo = $empleado->GetSueldo();
                $turno = $empleado->GetTurno();
                $path = $empleado->GetPathFoto();
                if($sexo == 'M'){
                    $masculino = 'selected';
                    $femenino = '';
                }
                else{
                    $masculino = '';
                    $femenino = 'selected';
                }
                switch($turno){
                    case 'M':
                            $maniana = "checked='checked'";
                            $tarde = '';
                            $noche = '';
                            break;
                    case 'T':
                            $maniana = "";
                            $tarde = "checked='checked'";
                            $noche = "";
                            break;
                    case 'N':
                            $maniana = "";
                            $tarde = "";
                            $noche = "checked='checked'";
                            break;
                }

                echo"
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='./javascript/funciones.js'></script>
                    <title>Modificar Empleado</title>
                </head>
                <body>
                    <h2>Modificar Empleados</h2>
                    <form action='./..\backend\administracion.php' enctype='multipart/form-data' method='POST'>
                        <table align='center'>
                            <!-- Datos Personales -->
                            <tr>
                                <td colspan='2' width='300px'>
                                    <h4>Datos Personales</h4>
                                    <br>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td>
                                    <input readonly id='txtDni' name='txtDni' type='number' value='$dni' min='1000000' max='55000000'>
                                    <span id='errorDni' style='display: none; color: red'>*</span>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td>
                                    <input id='txtApellido' name='txtApellido' type='text' value='$apellido'>
                                    <span id='errorApellido' style='display: none; color: red'>*</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td>
                                    <input id='txtNombre' name='txtNombre' type='text' value='$nombre'>
                                    <span id='errorNombre' style='display: none; color: red'>*</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Sexo:</td>
                                <td>
                                    <select id='cboSexo' name='cboSexo' value='$sexo'>
                                        <option disabled >Seleccione</option>
                                        <option value='M' $masculino >Masculino</option>
                                        <option value='F' $femenino >Femenino</option>
                                    </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span id='errorSexo' style='display: none; color: red'>*</span>
                                </td>
                            </tr>
                            <!-- Datos Laborales -->
                            <tr>
                                <td colspan='2' width='300px'>
                                    <h4>Datos Laborales</h4>
                                    <br>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>Legajo:</td>
                                <td>
                                    <input readonly id='txtLegajo' name='txtLegajo' type='number' min='100' max='550' value='$legajo'>
                                    <span id='errorLegajo' style='display: none; color: red'>*</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Sueldo:</td>
                                <td>
                                    <input id='txtSueldo' name='txtSueldo' type='number' min='8000' step='500' value='$sueldo'>
                                    <span id='errorSueldo' style='display: none; color: red'>*</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Turno:</td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='M' $maniana />						
                                    <label for='maniana'>Ma&ntilde;ana</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='T' $tarde />	
                                    <label for='tarde'>Tarde</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='N' $noche/>	
                                    <label for='noche'>Noche</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Foto:</td>
                                <td>
                                    <input id='foto' name='foto' type='file' value='$path' >
                                    <span id='errorFoto' style='display: none; color: red'>*</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' align='right'>
                                    <input id='resetButton' type='reset' value='Limpiar'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' align='right'>
                                    <input id='submitButton' type='submit' value='Modificar' onclick='enviar(event)'>
                                </td>
                            </tr>
                        </table>
                        <input type='hidden' id='hdnModificar' name='hdnModificar' value='$dni'>
                    </form>
                </body>
                </html>
                ";
                break;
            }
        }
    }
    else{
        echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='./javascript/funciones.js'></script>
                <title>Formulario Alta Empleado</title>
            </head>
            <body>
                <h2>Alta de Empleados</h2>
                <form action='./..\backend\administracion.php' enctype='multipart/form-data' method='POST'>
                    <table align='center'>
                        <!-- Datos Personales -->
                        <tr>
                            <td colspan='2' width='300px'>
                                <h4>Datos Personales</h4>
                                <br>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>DNI:</td>
                            <td>
                                <input id='txtDni' name='txtDni' type='number' min='1000000' max='55000000'>
                                <span id='errorDni' style='display: none; color: red'>*</span>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>Apellido:</td>
                            <td>
                                <input id='txtApellido' name='txtApellido' type='text'>
                                <span id='errorApellido' style='display: none; color: red'>*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td>
                                <input id='txtNombre' name='txtNombre' type='text'>
                                <span id='errorNombre' style='display: none; color: red'>*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sexo:</td>
                            <td>
                                <select id='cboSexo' name='cboSexo'>
                                    <option disabled selected>Seleccione</option>
                                    <option value='M' >Masculino</option>
                                    <option value='F'>Femenino</option>
                                </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span id='errorSexo' style='display: none; color: red'>*</span>
                            </td>
                        </tr>
                        <!-- Datos Laborales -->
                        <tr>
                            <td colspan='2' width='300px'>
                                <h4>Datos Laborales</h4>
                                <br>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>Legajo:</td>
                            <td>
                                <input id='txtLegajo' name='txtLegajo' type='number' min='100' max='550'>
                                <span id='errorLegajo' style='display: none; color: red'>*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sueldo:</td>
                            <td>
                                <input id='txtSueldo' name='txtSueldo' type='number' min='8000' step='500'>
                                <span id='errorSueldo' style='display: none; color: red'>*</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Turno:</td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='M' checked='checked' />						
                                <label for='maniana'>Ma&ntilde;ana</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='T' />	
                                <label for='tarde'>Tarde</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='N' />	
                                <label for='noche'>Noche</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Foto:</td>
                            <td>
                                <input id='foto' name='foto' type='file'>
                                <span id='errorFoto' style='display: none; color: red'>*</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2' align='right'>
                                <input id='resetButton' type='reset' value='Limpiar'>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2' align='right'>
                                <input id='submitButton' type='submit' onclick='enviar(event)'>
                            </td>
                        </tr>
                    </table>
                </form>
            </body>
            </html>
        ";
    }


?>

<!-- <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='./javascript/funciones.js'></script>
    <title>Formulario Alta Empleado</title>
</head>
<body>
    <h2>Alta de Empleados</h2>
    <form action='./..\backend\administracion.php' enctype='multipart/form-data' method='POST'>
        <table align='center'>
            <tr>
                <td colspan='2' width='300px'>
                    <h4>Datos Personales</h4>
                    <br>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>DNI:</td>
                <td>
                    <input id='txtDni' name='txtDni' type='number' min='1000000' max='55000000'>
                    <span id='errorDni' style='display: none; color: red'>*</span>
                </td>
                
            </tr>
            <tr>
                <td>Apellido:</td>
                <td>
                    <input id='txtApellido' name='txtApellido' type='text'>
                    <span id='errorApellido' style='display: none; color: red'>*</span>
                </td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td>
                    <input id='txtNombre' name='txtNombre' type='text'>
                    <span id='errorNombre' style='display: none; color: red'>*</span>
                </td>
            </tr>
            <tr>
                <td>Sexo:</td>
                <td>
                    <select id='cboSexo' name='cboSexo'>
                        <option disabled selected>Seleccione</option>
                        <option value='M' >Masculino</option>
                        <option value='F'>Femenino</option>
                    </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <span id='errorSexo' style='display: none; color: red'>*</span>
                </td>
            </tr>
            <tr>
                <td colspan='2' width='300px'>
                    <h4>Datos Laborales</h4>
                    <br>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>Legajo:</td>
                <td>
                    <input id='txtLegajo' name='txtLegajo' type='number' min='100' max='550'>
                    <span id='errorLegajo' style='display: none; color: red'>*</span>
                </td>
            </tr>
            <tr>
                <td>Sueldo:</td>
                <td>
                    <input id='txtSueldo' name='txtSueldo' type='number' min='8000' step='500'>
                    <span id='errorSueldo' style='display: none; color: red'>*</span>
                </td>
            </tr>
            <tr>
                <td>Turno:</td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='M' checked='checked' />						
                    <label for='maniana'>Ma&ntilde;ana</label>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='T' />	
                    <label for='tarde'>Tarde</label>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='N' />	
                    <label for='noche'>Noche</label>
                </td>
            </tr>
            <tr>
                <td>Foto:</td>
                <td>
                    <input id='foto' name='foto' type='file'>
                    <span id='errorFoto' style='display: none; color: red'>*</span>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan='2' align='right'>
                    <input id='resetButton' type='reset' value='Limpiar'>
                </td>
            </tr>
            <tr>
                <td colspan='2' align='right'>
                    <input id='submitButton' type='submit' onclick='enviar(event)'>
                </td>
            </tr>
        </table>
    </form>
</body>
</html> -->