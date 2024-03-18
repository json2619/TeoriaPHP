<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Clientes</title>
</head>

<?php
function GuardarLinea($linea, $NombreArchivo)
{
    $fd = fopen($NombreArchivo, "a+") or die("Error al abrir el archivo $NombreArchivo");

    fputs($fd, trim($linea));

    fclose($fd);

}

function obtenerEstado()
{
    $estado = array();

    if (file_exists("Estado.txt")) {
        $fd = fopen("Estado.txt", "r");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if (count($campos) == 2) {
                $estado[$campos[0]] = $campos[1];

            }
        }

        fclose($fd);

    }

    return $estado;

}

function obtenerDeportes()
{
    $deportes = array();

    if (file_exists("Deportes.txt")) {
        $fd = fopen("Deportes.txt", "r");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if (count($campos) == 2) //
            {
                $deportes[$campos[0]] = $campos[1];

            }
        }

        fclose($fd);

    }

    return $deportes;

}

$est = 1; // Por defecto suponemos que esta soltero

if (isset($_GET['Estado'])) {
    $est = $_GET['Estado'];
}
?>

<body>
    <h1>Ejercicio 2: </h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Alta de Clientes</legend>

            <p><label for='NIF'>NIF: </label><input type='text' name='NIF'></p>

            <p><label for='Nombre'>Nombre: </label><input type='text' name='Nombre'></p>

            <p><label for='Apellido1'>Apellido 1: </label><input type='text' name='Apellido1'></p>

            <p><label for='Apellido2'>Apellido 2: </label><input type='text' name='Apellido2'></p>

            <p>
                <label for='Estado'>Estado Civil :</label><br>

                <?php

                $estado = obtenerEstado();

                foreach ($estado as $clave => $valor) {
                    echo "<input type='radio' name='Estado' value='$valor' ";

                    if ($valor == $est) {
                        echo " checked ";
                    }

                    echo ">$clave ";

                }

                ?>
            </p>

            <p>
                <label for="">Deportes: </label><br>
                <?php

                $arrDeportes = obtenerDeportes();

                foreach ($arrDeportes as $alu) {

                    $alu = explode(" ", $alu);

                    echo "<input type='checkbox' name='Selec[" . trim($alu[0]) . "]'";

                    for ($i = 0; $i < count($alu); $i++) {
                        echo "><label>$alu[$i]</label><br>";
                    }
                }
                ?>

            </p>


            <p><input type='submit' name='Guardar' value='Guardar'></p>

        </fieldset>

        <?php

        if (isset($_GET['Guardar']) && (isset($_GET['Selec']))) {
            $nif = $_GET['NIF'];
            $nombre = $_GET['Nombre'];
            $apellido1 = $_GET['Apellido1'];
            $apellido2 = $_GET['Apellido2'];
            $estado = $_GET['Estado'];
            $selec = $_GET['Selec']; //Recogemos el array con los códigos(NIF) de los checkboxes
        
            $deportes = array();

            foreach ($selec as $clave => $valor) {

                $deportes[] = $clave;

            }

            $deportes = implode(' ', $deportes);

            $linea = $nif . " " . $nombre . " " . $apellido1 . " " . $apellido2 . " " . $estado . " " . trim($deportes) . "\n";

            $nombArchivo = "Clientes.txt";

            GuardarLinea($linea, $nombArchivo);

        }

        ?>
    </form>

</body>

</html>