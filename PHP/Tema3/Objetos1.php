<?php

class Persona {
    
     public static $tipo_sangre='A+';
     private $nombre;
     private $apellido1;
     private $fechaNac;
     
     function __construct($nom,$ape1,$fec)  //Método mágico que implementa el constructor
     {
         $this->nombre=$nom;
         $this->apellido1=$ape1;
         $this->fechaNac=$fec;
         
     }
     
     public function __get($propiedad)   
     {
         return $this->$propiedad;
     }
     
     public function __set($propiedad,$valor)
     {
        $this->$propiedad=$valor;
     }
     
}

$p1 = new Persona("Jose","Moreno","01/02/1970");

$p2=  new Persona("Luis","Vera","01/02/1985");

$p2::$tipo_sangre="O-";




echo "Los datos de la persona 1  son:<br>";

echo $p1->__get("nombre")." ".$p1->__get("apellido1")." ".$p1->__get("fechaNac")." ".$p1::$tipo_sangre;

echo "<br>";

echo "Los datos de la persona 2  son:<br>";

echo $p2->__get("nombre")." ".$p2->__get("apellido1")." ".$p2->__get("fechaNac")." ".$p2::$tipo_sangre;









/*

echo "<br>Modificamos los datos de la persona</br>";

$p1->__set("nombre","Pepe");
$p1->__set("apellido1","Lopez");
$p1->__set("fechaNac","07/06/1989");

echo "Los datos de la persona modificados son:<br>";

echo $p1->__get("nombre")." ".$p1->__get("apellido1")." ".$p1->__get("fechaNac");

*/


?>