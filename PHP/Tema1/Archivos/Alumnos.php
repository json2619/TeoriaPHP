<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Alumnos</title>
</head>

<body>
    <?php
    /* Crear alta de alumnos, con varios campos: nif, 
    nombre, apellido, modular que sera un click,
    curso 1 o 2, País desplegable sacar los paises de Paises.txt
    y unn botón alta. Guardar todo en un Alumnos.txt
    */

    $curso = '';


    if (isset($_GET['Curso'])) {
        $curso = $_GET['Curso']; //Recogemos el campos de ordenacion
    }

    $pais = '';


    if (isset($_GET['Pais'])) {
        $pais = $_GET['Pais']; //Recogemos el campos de ordenacion
    }

    function getCountries()
    {
        $paises = array();

        $fr = fopen("Paises.txt", "r") or die("Error al abrir el archivo");

        if ($fr !== false) {
            while (!feof($fr)) { // Mientras no lleguemos al final de archivo
    
                $linea = fgets($fr);
                $campos = explode(" ", $linea);

                if (count($campos) == 2) {
                    $paises[] = $campos[1];
                }
            }

        }
        return $paises;
    }

    ?>

    <h1>Dar de alta Alumnos</h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Alta de Alumnos</legend>

            <p>
                <label for="Nif">NIF:</label>
                <input type="text" name="Nif">
            </p>

            <p>
                <label for="Nombre">Nombre:</label>
                <input type="text" name="Nombre">
            </p>

            <p>
                <label for="Apellido">Apellidos:</label>
                <input type="text" name="Apellido">
            </p>

            <p>
                <label for="Modular">Modular:</label>
                Si<input type="radio" name="Modular" value="1">
                No<input type="radio" name="Modular" value="0">
            </p>

            <p>
                <label for="Curso">Curso:</label>
                <select name="Curso">
                    <option value=""></option>
                    <?php

                    $curs = array(1, 2);

                    foreach ($curs as $clave => $valor) {
                        echo " <option value='$valor' ";

                        if ($curso == $valor) {
                            echo " selected ";
                        }

                        echo ">$valor</option>";
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="Pais">País:</label>
                <select name="Pais">
                    <option value=""></option>
                    <?php

                    $countryArra = getCountries();

                    foreach ($countryArra as $key => $value) {
                        echo " <option value='$key' ";

                        if ($pais == $key) {
                            echo " selected ";
                        }

                        echo ">$value</option>";
                    }
                    ?>
                </select>
            </p>

            <p>
                <input type="submit" name="Alta" value="Alta">
            </p>
        </fieldset>

        <?php

        // Aquí empieza el php
        
        function nifExists($alumnoNif)
        {

            $booExists = false;

            $Ids = array();

            if (file_exists("Alumnos.txt")) {

                $fr = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo");

                if ($fr !== false) {
                    while (!feof($fr) && !$booExists) { // Mientras no lleguemos al final de archivo
        
                        $linea = fgets($fr);
                        $campos = explode(" ", $linea);

                        if (count($campos) == 6) {
                            $campos[1] = strtolower($campos[0]);

                            $booExists = (trim($campos[0]) === $alumnoNif);
                        }
                    }
                }

                fclose($fr);
            }

            return $booExists;

        }

        if (isset($_GET['Alta'])) {
            $nif = $_GET['Nif'];
            $nombre = $_GET['Nombre'];
            $apellido = $_GET['Apellido'];
            $modular = $_GET['Modular'];
            $curso = $_GET['Curso'];
            $pais = $_GET['Pais'];

            if (!nifExists($nif)) {
                $linea = $nif . " " . $nombre . " " . $apellido . " " . $modular . " " . $curso . " " . $pais . "\n";

                $fw = fopen("Alumnos.txt", "a+") or die("Error al abrir el archivo");

                fputs($fw, $linea);

                fclose($fw);
            } else {
                echo "<b>ERROR, ya existe un Alumno con ese nif</b>";
            }

        }

        ?>
    </form>

</body>

</html>