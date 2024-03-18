<?php

$cad="en un lugar de la mancha";

echo $cad;

echo "<br>";


echo str_replace(" ","", $cad);



function Palindroma($cad)
{
    $ini=0;   //Inicio de la cadena
     
    $fin=strlen($cad)-1;   //final de cadena
    
    while(  ( $ini<$fin   )   && ($cad[$ini]==$cad[$fin] )     )
    {
        $ini++;
        $fin--;
    }
    
    return ($ini>=$fin) ; 
    
}

/*
if (Palindroma($cad))
{
 echo "La cadena $cad es palíndroma";
}
else 
{
 echo "La cadena $cad NO es palíndroma";
}
*/

?>