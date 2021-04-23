<?php

include_once './../backend/fabrica.php';

$dni = isset($_POST['dni']) ? $_POST['dni'] : '';

$nombre = '';
$apellido = '';
$sexo = '';
$legajo = '';
$sueldo = '';
$turno = '';
$path = '';
$maniana = "checked='checked'";
$tarde = '';
$noche = '';
$masculino = '';
$femenino = '';
$titulo = 'Alta de Empleado';
$boton = 'Enviar';
$readonly = '';
$modificar = "";

if ($dni != '') {
    $fabrica = new Fabrica('RI', 7);
    $fabrica->TraerDeArchivo('./../backend/archivos/empleados.txt');
    foreach ($fabrica->GetEmpleados() as $empleado) {
        if ($empleado->GetDni() == +$dni) {
            $nombre = $empleado->GetNombre();
            $apellido = $empleado->GetApellido();
            $sexo = $empleado->GetSexo();
            $legajo = $empleado->GetLegajo();
            $sueldo = $empleado->GetSueldo();
            $turno = $empleado->GetTurno();
            $maniana = '';
            $tarde = '';
            $noche = '';
            if ($sexo == 'M') {
                $masculino = 'selected';
                $femenino = '';
            } else {
                $masculino = '';
                $femenino = 'selected';
            }
            switch ($turno) {
                case 'M':
                    $maniana = "checked='checked'";
                    break;
                case 'T':
                    $tarde = "checked='checked'";
                    break;
                case 'N':
                    $noche = "checked='checked'";
                    break;
            }
            break;
        }
    }
    $titulo = 'Modificar Empleado';
    $readonly = 'readonly';
    $boton = 'Modificar';
    $modificar = "<input type='hidden' id='hdnModificar' name='hdnModificar' value='$dni'>";
}
echo "
                    <h2>$titulo</h2>
                    <form>
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
                                    <input id='txtDni' name='txtDni' type='number' $readonly value='$dni' min='1000000' max='55000000'>
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
                                        <option disabled selected >Seleccione</option>
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
                                    <input id='txtLegajo' name='txtLegajo' type='number' min='100' max='550' $readonly value='$legajo'>
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
                                    <input style='margin-left: 50px;' type='radio' name='rdoTurno' value='M'  $maniana />						
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
                                    <input id='foto' name='foto' type='file' >
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
                                    <input id='submitButton' type='button' value='$boton' onclick='enviar()'>
                                </td>
                            </tr>
                        </table>
                        $modificar
                    </form>
                ";
