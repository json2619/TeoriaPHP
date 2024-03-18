<?php
/* Array de numero como parámetros y que devuelva -1
si no se encuenta y en caso de estar me tiene que 
devolver la posicion.
*/



function rellenar(&$numeros){

    for ($i=0; $i < 30; $i++) { 
        $numeros[$i] = rand(0,20);
    }

}

function mostrar($numeros){
    foreach ($numeros as $clave => $valor) {
        echo "[ $valor ],";
    }
    echo "<br>";
}

function encontrar($numeros, $num){
    $i = 0;
    
    while ($i < count($numeros) && ($numeros[$i] != $num)) {
        $i++;
    }

    if ($i == count($numeros)) {
        $i = -1;
    }

    echo "La posición del número ".$num." es: ".$i;
}

$numeros = array();
rellenar($numeros);
mostrar($numeros);
encontrar($numeros, 100);

?>