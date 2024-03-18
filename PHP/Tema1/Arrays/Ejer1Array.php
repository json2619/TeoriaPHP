<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

function rellenar(&$numeros){

    for ($i=0; $i < 30; $i++) { 
        $numeros[$i] = rand(0,50);
    }

}

function mostrar(&$numeros){
    echo "[";
    foreach ($numeros as $key => $value) {
        echo "$value], ";
    }
}

function contar($numeros,&$repeticiones){

    for ($i=0; $i < count($numeros); $i++) { 

        if (!isset($repeticiones[$numeros[$i]])) { //Si ese número ya está en el array de repeticiones

            $repeticiones[$numeros[$i]] = 1;

        } else {

            $repeticiones[$numeros[$i]]++;

        }

    }
}

function mostrarTabla ($repeticiones){
    echo "<table border='2' width='300' height='300'> ";
    echo "<th>Número</th><th>Repeticiones</th>";
    foreach ($repeticiones as $key => $value) {
        echo "<tr>";

        echo "<td>";
            echo "$key";
        echo "</td>";

        echo "<td>";
            echo "$value";
        echo "</td>";

        echo "</tr>";
    }
    

    echo "</table>";
}

$numeros = array();
$repeticiones = array();
rellenar($numeros);
mostrar($numeros);
contar($numeros,$repeticiones);
mostrarTabla ($repeticiones);



?>


</body>
</html>