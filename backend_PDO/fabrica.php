<?php
    include_once "AccesoDatos.php";
    include_once "empleado.php";
    include_once "interfaces.php";


    class Fabrica implements Ibd{
        private $_cantidadMaxima;
        private $_empleados;
        private $_razonSocial;

        public function __construct($razonSocial,$cantMax)
        {
            $this->_empleados = [];
            $this->_razonSocial = $razonSocial;
            $this->_cantidadMaxima = $cantMax;
        }

        public function GetEmpleados(){
            return $this->_empleados;
        }

        public function AgregarEmpleado($emp){
            $retValue = false;
            if(count($this->_empleados) < $this->_cantidadMaxima ){
                array_push($this->_empleados,$emp);
                $retValue = true;
                $this->EliminarEmpleadoRepetido();
            }

            return $retValue;
        }

        private function EliminarEmpleadoRepetido(){
            $this->_empleados = array_unique($this->_empleados,SORT_REGULAR);
        }

        public function AgregarEmpleado_DB($emp){

            $retValue = false;

            $ad = AccesoDatos::DameUnObjetoAcceso();
            $query = $ad->RetornarConsulta("INSERT INTO empleados (nombre,apellido,dni,sexo,legajo,sueldo,turno,pathFoto) VALUES (:nombre,:apellido,:dni,:sexo,:legajo,:sueldo,:turno,:pathFoto)");
            $query->bindValue(':nombre',$emp->GetNombre(),PDO::PARAM_STR);
            $query->bindValue(':apellido',$emp->GetApellido(),PDO::PARAM_STR);
            $query->bindValue(':dni',$emp->GetDni(),PDO::PARAM_STR);
            $query->bindValue(':sexo',$emp->GetSexo(),PDO::PARAM_STR);
            $query->bindValue(':legajo',$emp->GetLegajo(),PDO::PARAM_STR);
            $query->bindValue(':sueldo',$emp->GetSueldo(),PDO::PARAM_INT);
            $query->bindValue(':turno',$emp->GetTurno(),PDO::PARAM_STR);
            $query->bindValue(':pathFoto',$emp->GetPathFoto(),PDO::PARAM_STR);
            
            if($query->execute() != false){
                $retValue = true;
            }

            return $retValue;
        }

        public function ModificarEmpleado($emp){
            $retValue = false;

            $ad = AccesoDatos::DameUnObjetoAcceso();
            $query = $ad->RetornarConsulta("UPDATE empleados SET nombre = :nombre, apellido = :apellido, sexo = :sexo, sueldo = :sueldo, turno = :turno, pathFoto = :pathFoto WHERE dni = :dni");
            $query->bindValue(':nombre',$emp->GetNombre(),PDO::PARAM_STR);
            $query->bindValue(':apellido',$emp->GetApellido(),PDO::PARAM_STR);
            $query->bindValue(':sexo',$emp->GetSexo(),PDO::PARAM_STR);
            $query->bindValue(':sueldo',$emp->GetSueldo(),PDO::PARAM_INT);
            $query->bindValue(':turno',$emp->GetTurno(),PDO::PARAM_STR);
            $query->bindValue(':pathFoto',$emp->GetPathFoto(),PDO::PARAM_STR);
            $query->bindValue(':dni',$emp->GetDni(),PDO::PARAM_STR);

            if($query->execute()){
                $retValue = true;
            }

            return $retValue;
        }
        
        public function EliminarEmpleado($emp){
            $retValue = false;
            $ad = AccesoDatos::DameUnObjetoAcceso();
            $query = $ad->RetornarConsulta("DELETE FROM empleados WHERE legajo = :legajo");
            $query->bindValue(':legajo',$emp->GetLegajo(),PDO::PARAM_INT);
            
            if($query->execute()){
                unlink($emp->GetPathFoto());    
                $retValue = true;
            }
            return $retValue;
        }
        
        
        public function CalcularSueldos(){
            $totalSueldos = 0;
            foreach($this->_empleados as $empleado){
                $totalSueldos += $empleado->GetSueldo();
            }
            return $totalSueldos;
        }
        
        public function toString()
        {
            $retString = "Razon social: " . $this->_razonSocial . "<br>Cantidad maxima de empleados: " . $this->_cantidadMaxima;

            foreach($this->_empleados as $empleado){
                $retString = $retString . "<br>";
                $retString = $retString . $empleado->toString();
            }

            $retString = $retString . "<br>Sueldos Totales:" . $this->CalcularSueldos();

            return $retString;
        }

        public function TraerDeBD(){
            
            $ad = AccesoDatos::DameUnObjetoAcceso();
            $query = $ad->RetornarConsulta("SELECT * FROM empleados");
            $query->execute();

            foreach($query as $empleado){
                    $newEmpleado = new Empleado($empleado['nombre'],$empleado['apellido'],$empleado['dni'],$empleado['sexo'],+$empleado['legajo'],$empleado['sueldo'],$empleado['turno']);
                    $newEmpleado->SetPathFoto($empleado['pathFoto']);
                    $this->AgregarEmpleado($newEmpleado);
            }
        }
}

?>

