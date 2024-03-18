<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda Clientes</title>
</head>

<?php

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

    if (file_exists("Deportes.txt")) //
    {
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

function obtenerClientes($estado, $Deportes)
{
    $clientes = array();

    if (file_exists("Clientes.txt")) //
    {
        $fd = fopen("Clientes.txt", "r");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if (count($campos) == 6) {
                $clientes[trim($campos[0])] = $linea;

            }
        }

        fclose($fd);
    }

    return $clientes;

}

$est = 1; // Por defecto suponemos que esta soltero

if (isset($_GET['Estado'])) {
    $est = $_GET['Estado'];
}

$sport = obtenerDeportes(); // Por defecto suponemos que esta soltero
$selectdeport = array();

foreach ($sport as $clave => $valor) {
    if (isset($_GET['$clave'])) {
        $selectdeport = $_GET['$clave'];
    }

}
?>

<body>

    <h1>Ejercicio 2: </h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Búsqueda de Clientes</legend>

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

                $deportes = obtenerDeportes();

                foreach ($deportes as $clave => $valor) {
                    echo "<input type='checkbox' name='$valor' value='$clave'";

                    echo "><label for='$valor'>$valor</label><br>";
                }

                ?>

            </p>


            <p><input type='submit' name='Enviar' value='Enviar'></p>
        </fieldset>

        <?php

        if (isset($_GET['Enviar'])) {

            $estado = $_GET['Estado'];
            $deportes = implode(" ", $selectdeport);

            if (isset($_GET['Estado'])) {

            }

            $linea = $alumnos[$nif]; //Recuperamos la linea con los datos de ese alumno
        
            $campos = explode(" ", $linea);

        }

        ?>
    </form>

</body>

</html>