<?php

    abstract class Persona{
        private $apellido;
        private $dni;
        private $nombre;
        private $sexo;

        public function __construct($nombre,$apellido,$dni,$sexo)
        {
            $this->nombre = $nombre; 
            $this->apellido = $apellido; 
            $this->dni = $dni; 
            $this->sexo = $sexo; 

        }

        public function GetApellido(){
            return $this->apellido;
        }

        public function GetDni(){
            return $this->dni;
        }

        public function GetNombre(){
            return $this->nombre;
        }

        public function GetSexo(){
            return $this->sexo;
        }

        public abstract function Hablar($idioma);

        public function toString()
        {
            return $this->nombre . " - " . $this->apellido . " - " . $this->dni . " - " . $this->sexo;
        }

    }

?>