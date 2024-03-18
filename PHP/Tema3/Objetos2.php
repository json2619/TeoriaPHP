<?php

class Persona {
    
     private $nombre;
     private $apellido1;
    
     public function __get($propiedad)   
     {
         return $this->$propiedad;
     }
     
     public function __set($propiedad,$valor)
     {
        $this->$propiedad=$valor;
     }
     
}

//Creamos tres arrays con dos campos: nombre, apellido1 de una persona

$per1=array("nombre"=>"Juan","apellido1"=>"Lopez");
$per2=array("nombre"=>"Pepe","apellido1"=>"Moreno");
$per3=array("nombre"=>"David","apellido1"=>"Suarez");

$personasF=array(); //Creamos un array de personas

                   //Rellenamos el array de personas con las personas en arrays de fil
$personasF[]=$per1; 
$personasF[]=$per2;
$personasF[]=$per3;

$personasObj=array();  //Array de personas cuyos datos estan en objetos



foreach ($personasF as $clave=>$persona  )
{  
    $p1=new Persona();
    
    echo "La persona con clave $clave su nombre es $persona[nombre] y su apellido $persona[apellido1] ";
    
    echo "<br>";
    
    $p1->__set("nombre", $persona["nombre"]);
    $p1->__set("apellido1",$persona["apellido1"]);
    
    $personasObj[]=$p1;
    
    
}

//Mostramos el array de objetos personas

echo "Mostramos el array de objetos de personas<br>";

foreach ($personasObj as $p  )
{  
    echo $p->__get("nombre")." ".$p->__get("apellido1");
    echo "<br>";

}











?>