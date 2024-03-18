<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Ciclos</title>
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

    $ciclo = '';


    if (isset($_GET['Ciclo'])) {
        $ciclo = $_GET['Ciclo']; //Recogemos el campos de ordenacion
    }

    function getCiclos()
    {
        $ciclos = array();

        $fr = fopen("Ciclos.txt", "r") or die("Error al abrir el archivo");

        if ($fr !== false) {
            while (!feof($fr)) { // Mientras no lleguemos al final de archivo
    
                $linea = fgets($fr);
                $campos = explode(" ", $linea);

                if (count($campos) == 2) {
                    $ciclos[$campos[0]] = $campos[1];
                }
            }

        }
        return $ciclos;
    }

    ?>

    <h1>Dar de alta Modulos</h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Alta de Modulos</legend>

            <p>
                <label for="Nombre">Nombre:</label>
                <input type="text" name="Nombre">
            </p>

            <p>
                <label for='Curso'>Curso:</label>
                <select name='Curso'>
                    <option value=''></option>

                    <?php

                    $cursoArra = array(1, 2);

                    foreach ($cursoArra as $clave => $valor) {
                        echo "<option value='$valor' ";

                        if ($curso == $valor) {
                            echo " selected ";
                        }


                        echo ">$valor</option>";

                    }

                    ?>

                </select>
            </p>

            <p>
                <label for="Ciclo">Ciclo:</label>
                <select name="Ciclo">
                    <option value=""></option>
                    <?php

                    $ciclosArra = getCiclos();

                    foreach ($ciclosArra as $key => $value) {
                        echo " <option value='$key' ";

                        if ($ciclo == $key) {
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
        
        function codExists($codMod)
        {

            $booExists = false;

            $codigos = array();

            if (file_exists("Ciclos.txt")) {

                $fr = fopen("Ciclos.txt", "r") or die("Error al abrir el archivo");

                if ($fr !== false) {
                    while (!feof($fr) && !$booExists) { // Mientras no lleguemos al final de archivo
        
                        $linea = fgets($fr);
                        $campos = explode(" ", $linea);

                        if (count($campos) == 6) {
                            $campos[1] = strtolower($campos[0]);

                            $booExists = (trim($campos[0]) === $codMod);
                        }
                    }
                }

                fclose($fr);
            }

            return $booExists;

        }

        if (isset($_GET['Alta'])) {
            $nombre = $_GET['Nombre'];
            $curso = $_GET['Curso'];
            $ciclo = $_GET['Ciclo'];

            $nomCiclo = $ciclosArra[$ciclo];

            $codMod = codigoModulo($nombre, $curso, $nomCiclo);

            if (!codExists($codMod)) {

                $linea = $codMod . " " . $nombre . " " . $curso . " " . $ciclo . "\n";

                $fw = fopen("Modulos.txt", "a+") or die("Error al abrir el archivo");

                fputs($fw, $linea);

                fclose($fw);
            } else {
                echo "<b>ERROR, ya existe un Alumno con ese nif</b>";
            }

        }

        function codigoModulo($nombre, $curso, $ciclo)
        {
            $codM = '';

            $codM .= $nombre[0];

            $codM .= $curso;

            $codM .= substr($ciclo, 0, 3);

            return $codM;
        }

        ?>
    </form>
</body>

</html>