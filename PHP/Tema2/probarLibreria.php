<?php

require_once 'libreria.php';

$consulta = "insert into Alumnos values ('88888888J', 'David', 'Fuentes', 'Molina', '777654323', 8400)";

consultaSimple($consulta);

/*
$consulta = "select * from Notas";

$filas = consultaDatos($consulta);

echo "<table border='2'>";

foreach ($filas as $fila) {
    echo "<tr>";

    foreach ($fila as $campos) {
        echo "<td>$campos</td>";
    }

    echo "</tr>";
}

echo "</table>";

*/

?>