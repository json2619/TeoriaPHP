<!DOCTYPE html>
<html lang="en">
<head>
    <title>Página de recepción</title>
</head>
<body>


<?php

// Recibimos los datos

    $nombre=$_GET['Nombre'];
    $apellido1=$_GET['Apellido1'];
    $apellido2=$_GET['Apellido2'];

    echo "Hola $nombre $apellido1 $apellido2";

?>

</body>
</html>