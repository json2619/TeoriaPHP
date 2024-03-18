<?php

$numeros = array(); // COn esto digo que quiero declarar un array, no hace falta decir el tamaño.

$numeros[3] = 90;

for ($i=0; $i < 10; $i++) { 
    $numeros[] = $i*3; 
/* Si tuno le pones nunguna clave te va asignando
claves ibres desde el último
    $numeros[] = $i*3;
*/
}

// lo mostramos

for ($i=0; $i < 10; $i++) { 
//    echo "[ $numeros[$i] ]";
    echo "Pos: $i [ $numeros[$i] ]<br>";
}

//función para saber la longitud de un array
for ($i=3;$i < count($numeros); $i++) { 
    //    echo "[ $numeros[$i] ]";
        echo "Pos: $i [ $numeros[$i] ]<br>";
    }

?>