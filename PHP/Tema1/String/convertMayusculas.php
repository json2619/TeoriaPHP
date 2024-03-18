<?php

$cadena = "abracadabraPATaDecabRA";

function convertMayusculas(&$cadena){

    $mayusculas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N',
                        'O','P','Q','R','S','T','U','W','X','Y','Z');

    $minusculas = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n',
                        'o','p','q','r','s','t','u','w','x','y','z');

    $palabraMayuscula = '';

    for ($i=0; $i < strlen($cadena); $i++) { 

        if (in_array($cadena[$i],$mayusculas)) {

            $palabraMayuscula.= $cadena[$i];

        } else {

            $pos = array_search($cadena[$i], $minusculas);

            if ($pos === false) {
                $palabraMayuscula.= $cadena[$i];
            }
            else {
                $palabraMayuscula.= $mayusculas[$pos];
            }
        }

    }
    return $palabraMayuscula;
}



function convertMinusculas(&$cadena){

    $mayusculas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N',
                        'O','P','Q','R','S','T','U','W','X','Y','Z');

    $minusculas = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n',
                        'o','p','q','r','s','t','u','w','x','y','z');

    $palabraMayuscula = '';

    for ($i=0; $i < strlen($cadena); $i++) { 

        if (in_array($cadena[$i],$minusculas)) {

            $palabraMayuscula.= $cadena[$i];

        } else {

            $pos = array_search($cadena[$i], $mayusculas);

            if ($pos === false) {
                $palabraMayuscula.= $cadena[$i];
            }
            else {
                $palabraMayuscula.= $minusculas[$pos];
            }
        }

    }
    return $palabraMayuscula;
}

echo "original: $cadena";

    echo "<p></p>";

    echo "La palabra en mayúsculas es: ".convertMayusculas($cadena);

    echo "<p></p>";

    echo "La palabra en minúsculas es: ".convertMinusculas($cadena);

?>