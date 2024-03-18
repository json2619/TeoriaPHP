<?php

$ahora = time(); // Obtenemos la fecha actual en formato Epoch

$campos = getdate($ahora); // recibimos un valor Epoch y nos devuelve un array

echo $campos['mday'] . " / " . $campos['mon'] . " / " . $campos['year'];

echo "<br>";

echo $campos['mday'] . " / " . $campos['month'] . " / " . $campos['year'];

echo "<br>";

echo "El Día es: " . $campos['wday'];

echo "<br>";

$fechaEpoch = mktime(13, 30, 30, 1, 13, 1997);
$campos = getdate($fechaEpoch);
echo $campos['mday'] . " / " . $campos['month'] . " / " . $campos['year'];

echo "<br>";

echo "El Día es: " . $campos['weekday'];

?>