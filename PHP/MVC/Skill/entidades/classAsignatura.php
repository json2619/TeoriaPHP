<?php

class Asignatura{
    private $Id;
    private $Nombre;
    private $Curso;
    
	
	public function __get($k)
	 { 
	    return $this->$k; 
	 }
	 public function __set($k, $v)
	 {  $this->$k = $v; }
	
	
    
}
?>
