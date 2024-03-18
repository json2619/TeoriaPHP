<?php

function Mostrar($vector){
    foreach ($vector as $key => $value) {
        echo "Clave $key valor $value";
        echo "<br>";
    }
}
$notas = array('Fol'=>5, 'Ingles'=>4, 'Cliente'=>10, 'servidor'=>1);

echo "antes de ordenar <br>";

Mostrar($notas);

echo "<p></p>";

// asort($notas); este ordena por valor de menor a mayor

// arsort($notas);  este ordena de mayor a menor

//ksort($notas); ordena por claves de menor a mayor

krsort($notas); // Ordena por clave de mayor a menor

echo "después de ordenar";

echo "<p></p>";

Mostrar($notas);
?>
