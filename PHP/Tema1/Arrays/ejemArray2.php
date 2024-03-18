<?php
/* Este es un ejemplo de como si yo no pongo un número 
me asigna a los valores los sitios disponibles desde el numero
en el que esté

$alumnos = array();

$alumnos[5] = 'Tomás';

$alumnos[] = 'Juan';
$alumnos[] = 'Pepe';
$alumnos[] = 'Luis';

$alumnos = array('Juan'=>20, 'Pepe'=>21, 'Luis'=>19);

foreach ($alumnos as $key => $value) {
    echo "clave: $key, valor: $value";
    echo "<br>";
}
*/

/*********************************************************** */

/*Esto significa que puedo poner la clave y el valor al inicializar el array
por ejemplo en este caso la clave es el nombre y el valor la edad
*/
/*
$alumnos = array('Juan'=>20, 'Pepe'=>21, 'Luis'=>19);

foreach ($alumnos as $key => $value) {
    echo "clave: $key, valor: $value";
    echo "<br>";
}
*/

/*Aquí se ve como dentro de un array se puede tener un array como valor
*/
/*
$alumnos = array('Juan'=>array('Fol'=>4, 'Ingles'=>7, 'Cliente'=>8), 
                'Pepe'=>array('Fol'=>5, 'Ingles'=>3, 'Cliente'=>4), 
                'Luis'=>array('Fol'=>7, 'Ingles'=>1, 'Cliente'=>1)
                );

foreach ($alumnos as $key => $value) {
    echo "Para: $key, sus notas son: <br>";

    foreach ($value as $key => $value) {
        echo "$key: $value  ";
    }
    echo "<br>";

}
*/

/*
$alumnos = array('Juan'=>array('Fol'=>4, 'Ingles'=>7, 'Cliente'=>8, 'servidor'=>9), 
                'Pepe'=>array('Fol'=>5, 'Ingles'=>3, 'Cliente'=>4), 
                'Luis'=>array('Fol'=>7, 'Ingles'=>1, 'Cliente'=>1)
                );
echo "<table border='2'>";
foreach ($alumnos as $key => $value) {
    echo "<tr>";

    echo "<td>$key</td>";

    foreach ($value as $key => $value) {
        echo "<td>Modulo: $key Nota: $value</td> ";
    }
    echo "<tr>";
}


echo "</table>";
*/

/*Función in_array permite saber si un elemento existe en un 
array
*/

//$notas = array('Fol'=>4, 'Ingles'=>7, 'Cliente'=>8, 'servidor'=>9);

//in_array(10, $notas);

//array_key_exists("Fol", $notas);

$notas = array(4,7,8,9);

$valor = 4;

if (array_search($valor,$notas) !== false) {
    echo "El elemeto con valor $valor está en el array";
}else {
    echo "El elemeto con valor $valor no está en el array";
}



?>