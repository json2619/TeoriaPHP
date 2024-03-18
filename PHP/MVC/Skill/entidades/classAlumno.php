<?php

class Alumno{
    private $dni;
    private $nombre;
    private $curso;
    
	/*
	public function __get($k)
	 { 
	    return $this->$k; 
	 }
	 public function __set($k, $v)
	 {  $this->$k = $v; }
	
	*/
    public function getDni(){
        return $this->dni;  
    }
    public function setDni($dni){
        $this->dni=$dni;
    }
    public function getNombre(){
        return $this->nombre;  
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function getCurso(){
        return $this->curso;  
    }
    public function setCurso($curso){
        $this->curso=$curso;
    }    
}
?>
