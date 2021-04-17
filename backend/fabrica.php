<?php

    include_once "empleado.php";
    include_once "interfaces.php";


    class Fabrica implements IArchivo{
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

        public function CalcularSueldos(){
            $totalSueldos = 0;
            foreach($this->_empleados as $empleado){
                $totalSueldos += $empleado->GetSueldo();
            }
            return $totalSueldos;
        }

        public function EliminarEmpleado($emp){
            $retValue = false;
            foreach($this->_empleados as $index => $empleado){
                if($empleado == $emp){
                    unset($this->_empleados[$index]);
                    $retValue = true;
                    break;
                }
            }
            return $retValue;
        }

        private function EliminarEmpleadoRepetido(){
            $this->_empleados = array_unique($this->_empleados,SORT_REGULAR);
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

        public function GuardarEnArchivo($nombreArchivo){
            $archivo = fopen($nombreArchivo,'w');
            foreach($this->_empleados as $empleado){
                fwrite($archivo,($empleado->toString() . "\r\n" ));
            }
            fclose($archivo);
        }

        public function TraerDeArchivo($nombreArchivo){
            $archivo = fopen($nombreArchivo,'r');
            while(!feof($archivo)){
                $linea = trim(fgets($archivo));
                if(strlen($linea) > 0){
                    $arrayLinea = explode(" - ",$linea);
                    $empleado = new Empleado($arrayLinea[0],$arrayLinea[1],$arrayLinea[2],$arrayLinea[3],$arrayLinea[4],$arrayLinea[5],$arrayLinea[6]);
                    $empleado->SetPathFoto($arrayLinea[7]);
                    $this->AgregarEmpleado($empleado);
                }
            }
            fclose($archivo);
        }
}

?>
