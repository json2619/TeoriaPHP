<?php

//funcion que convierte una cadena de caracteres a Mayúsculas

function ConvMay($cadena)
{
    $may=array('A','B','C','D','E','F','G','H','I','J',
               'K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
    
    
    
    $min=array('a','b','c','d','e','f','g','h','i','j',
               'k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    
    $convertida=""; //Variable que contendrá la cadena convertida a May
    
    for($i=0;$i<strlen($cadena);$i++)
    {
        if ( in_array($cadena[$i],$may) )     //Si la letra es una letra May
        {
            $convertida.=$cadena[$i];      //La añadimos como esta a la cadena
        }
        else   //No esta en el array de May 
        {
            $pos=array_search($cadena[$i],$min);  //Buscamos su posición dentro de array de min
            
            if ($pos===false)    //Tampoco era una letra min (es un caracter no alfabético)
            {
                $convertida.=$cadena[$i];      //La añadimos como esta a la cadena
            }
            else      //La letra es minúscula 
            {
                
                $convertida.=$may[$pos];   //Añadimos a la cadena a convertir la equivalente en May a esa letra
            }
                
        
        }
            
    }
    
    
    
    return $convertida;
    
    
}

function ConvMin($cadena)
{
    $may=array('A','B','C','D','E','F','G','H','I','J',
        'K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    
    
    
    $min=array('a','b','c','d','e','f','g','h','i','j',
        'k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    
    $convertida=""; //Variable que contendrá la cadena convertida a May
    
    for($i=0;$i<strlen($cadena);$i++)
    {
        if ( in_array($cadena[$i],$min) )     //Si la letra es una letra May
        {
            $convertida.=$cadena[$i];      //La añadimos como esta a la cadena
        }
        else   //No esta en el array de May
        {
            $pos=array_search($cadena[$i],$may);  //Buscamos su posición dentro de array de min
            
            if ($pos===false)    //Tampoco era una letra min (es un caracter no alfabético)
            {
                $convertida.=$cadena[$i];      //La añadimos como esta a la cadena
            }
            else      //La letra es minúscula
            {
                
                $convertida.=$min[$pos];   //Añadimos a la cadena a convertir la equivalente en May a esa letra
            }
            
            
        }
        
    }
    
    
    
    return $convertida;
    
    
}


strtolower($string);

strtoupper($string);

$cadena="TeLesco%%&&!Pio";

echo "Original:$cadena";

echo "<br>";

Echo "Convertida a May:".ConvMin($cadena);









