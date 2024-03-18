<?php

$num1=10;
function Ejemplo($num1)
{
    global $num1;  //Esto indica que la variable estará fuera de la función.
    $num1 = $num1 + 10;
}

Ejemplo($num1);

echo "El valor de numero es: ".$num;

?>