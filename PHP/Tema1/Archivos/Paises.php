<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países</title>
</head>

<body>

    <h1>Dar de alta Países</h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Alta de Países</legend>

            <p>
                <label for="Pais"></label>
                <input type="text" name="Pais">
            </p>

            <p>
                <input type="submit" name="Guardar" value="Guardar">
            </p>
        </fieldset>
    </form>

    <?php

    function sigId()
    {

        $Id = 1;

        $Ids = array();

        $fr = fopen("Paises.txt", "r") or die("Error al abrir el archivo");

        if ($fr !== false) {
            while (!feof($fr)) { // Mientras no lleguemos al final de archivo
    
                $linea = fgets($fr);
                $campos = explode(" ", $linea);

                if (count($campos) == 2) {
                    $Ids[] = $campos[0];
                }
            }
        }

        fclose($fr);

        if (count($Ids) > 0) {
            $maxim = max($Ids);

            $Id = intval($maxim) + 1;
        }

        return $Id;
    }

    function countryExists($pais)
    {

        $booExists = false;

        $Ids = array();

        if (file_exists("Paises.txt")) {

            $fr = fopen("Paises.txt", "r") or die("Error al abrir el archivo");

            if ($fr !== false) {
                while (!feof($fr) && !$booExists) { // Mientras no lleguemos al final de archivo
    
                    $linea = fgets($fr);
                    $campos = explode(" ", $linea);

                    if (count($campos) == 2) {
                        $campos[1] = strtolower($campos[1]);

                        $booExists = (trim($campos[1]) === $pais);
                    }
                }
            }

            fclose($fr);
        }

        return $booExists;

    }

    if (isset($_GET['Guardar'])) {
        $countryName = $_GET['Pais'];

        $id = sigId();

        if (!countryExists($countryName)) {
            $linea = $id . " " . $countryName . "\n";

            $fw = fopen("Paises.txt", "a+") or die("Error al abrir el archivo");

            fputs($fw, $linea);

            fclose($fw);
        } else {
            echo "<b>ERROR, ya existe un país con ese nombre</b>";
        }

    }

    ?>
</body>

</html>