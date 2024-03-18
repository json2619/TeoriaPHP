<?php

$condicion1=true;
$condicion2=1;

$condicion3=false;

$expresion=$condicion1 && ($condicion2 || $condicion3);

if ( $expresion) {
    echo "La condición es cierta";
}elseif ($condicion2) {
    echo "Se cumple la condición 2";
}
else {  //Valor por defecto
    echo "La condición es falsa";
}

if ( $condicion1 &&  $condicion2) {
    echo "La condición es cierta";
} else {
    echo "La condición es falsa";
}

if ( $condicion1 ||  $condicion2) {
    echo "La condición es cierta";
} else {
    echo "La condición es falsa";
}

//En esta condición los dos valores se comparan
if ( $condicion1==$condicion2) {
    echo "La condición es cierta";
} else {
    echo "La condición es falsa";
}

// En esta condición los dos valores deben ser del mismo tipo
if ( $condicion1===$condicion2) {
    echo "La condición es cierta";
} else {
    echo "La condición es falsa";
}
?>