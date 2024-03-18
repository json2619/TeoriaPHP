<?php

$numeros = array(); // COn esto digo que quiero declarar un array, no hace falta decir el tamaño.


rand(0,50);
$numeros[3] = 90;

for ($i=0; $i < 10; $i++) { 
    $numeros[] = $i*3; 
}


/*
Si se guardan asi los numeros el foreach se
muestra en funcion de como los guardo.
*/

$numeros[3] = 30;
$numeros[9] = 90;
$numeros[5] = 50;
$numeros[2] = 20;
$numeros[1] = 10;

foreach ($numeros as $clave => $valor) {
    echo "Clave: $clave  Valor: $valor <br>";
}

?>