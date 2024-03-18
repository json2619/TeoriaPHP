<?php

$cad = "oso";

$cad2 = "en un lugar de la mancha";

echo str_replace(" ", "", $cad2);

echo "<p></p>";

function palindroma($cad)
{
    $ini = 0;   // inicio de la cadena

    $fin = strlen($cad) - 1;    // final de la cadena

    while (($ini < $fin) && $cad[$ini] == $cad[$fin]) {
        $ini++;
        $fin--;
    }

    return ($ini >= $fin);
}

if (palindroma($cad)) {
    echo "La cadena $cad es palíndoma";
} else {
    echo "la cadena $cad no es palíndroma";
}
