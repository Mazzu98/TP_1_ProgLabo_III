<?php

include "persona.php";

    class Empleado extends Persona{

        protected $legajo;
        protected $sueldo;
        protected $turno;
        protected $pathFoto;

        public function __construct($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno)
        {
            parent::__construct($nombre,$apellido,$dni,$sexo);
            $this->legajo = $legajo;
            $this->sueldo = $sueldo;
            $this->turno = $turno;
        }

        public function GetLegajo(){
            return $this->legajo;
        }

        public function GetSueldo(){
            return $this->sueldo;
        }

        public function GetTurno(){
            return $this->turno;
        }

        public function GetPathFoto(){
            return $this->pathFoto;
        }

        public function SetPathFoto($path){
            $this->pathFoto = $path;
        }

        public function Hablar($idioma)
        {
            return "El empleado habla " . $idioma;
        }

        public function toString()
        {
            return parent::toString() . " - " . $this->legajo . " - " . $this->sueldo . " - " . $this->turno . " - " . $this->pathFoto;
        }
    }

?>