<?php

$fd = fopen("Agenda.txt", "a+") or die("Error al abrir el archivo"); // Devuelve el descriptor del archivo

$linea = "Estoy muy bien \n";
fputs($fd, $linea);

fclose($fd);
/*
Modo de lectura de datos.

$fd = fopen("Datos.txt", "r") or die("Error al abrir el archivo"); // Devuelve el descriptor del archivo

while ($linea = fgets($fd)) { //Mientras haya líneas, las muestro por pantalla

    //    $linea = fgets($fd); // Lee una cantidad de caracteres hasta el salto de linea

    echo $linea . "<br>";
}

fclose($fd);

con r solo leemos
con w podemos escribir pero borramos lo anterior
con a+ añadimos y adicionamos es decir que se mantiene lo anterior

*/