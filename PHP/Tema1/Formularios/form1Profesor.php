<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mi Página</title>
</head>
<body>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for='Nombre'>Nombre:</label>
    <input type="text" name='Nombre'>

    <p></p>

    <label for='Apellido1'>Apelllido 1:</label>
    <input type="text" name='Apellido1'>

    <p></p>

    <label for='Apellido2'>Apellido 2:</label>
    <input type="text" name='Apellido2'>

    <p></p>

    <input type="submit" name='Inicio' value="Inicio">
    <input type="submit" name='Fin' value="Fin">
    </form>

    <?php

// Recibimos los datos

    if (isset( $_GET['Nombre']))  // Me han llegado datos del formulario
    {
        // Hay datos que recoger
        $nombre=$_GET['Nombre'];
        $apellido1=$_GET['Apellido1'];
        $apellido2=$_GET['Apellido2'];
        
        echo "<table border='1' width='200' height='50' >";

            if (isset( $_GET['Inicio'])) {
                echo "<th>Nombre</th> <th>Apellido 1</th> <th>Apellido 2</th>";
                echo "<tr>";
                echo "<td>$nombre</td> <td>$apellido1</td> <td>$apellido2</td>";
                echo "</tr>";
            }
            else
            {
                echo "<th>Apellido 1</th> <th>Apellido 2</th> <th>nombre</th>";
                echo "<tr>";
                echo "<td>$apellido1</td> <td>$apellido2</td> <td>$nombre</td>";
                echo "</tr>";
            }

        echo "</table>";
    }

?>

</body>
</html>