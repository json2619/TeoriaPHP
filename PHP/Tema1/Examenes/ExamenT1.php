<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EjercicioExamen</title>
</head>

<body>

    <?php

    $cur = '';

    if (isset($_GET['Curso'])) {
        $cur = $_GET['Curso'];
    }

    function GuardarLinea($linea, $NombreArchivo)
    {
        $fd = fopen($NombreArchivo, "a+") or die("Error al abrir el archivo $NombreArchivo");

        fputs($fd, $linea);

        fclose($fd);

    }

    ?>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Alta y baja de Alumnos</legend>

            <p>
                <label for='NIF'>NIF </label><input type='text' name='NIF'>
            </p>

            <p>
                <label for='Nombre'>Nombre </label><input type='text' name='Nombre'>
            </p>

            <p>
                <label for='Apellido1'>Apellido 1: </label><input type='text' name='Apellido1'>
            </p>

            <p>
                <label for='Apellido2'>Apellido 2: </label><input type='text' name='Apellido2'>
            </p>

            <p>
                <label for='Curso'>Curso:</label>
                <select name='Curso'>
                    <option value=''></option>

                    <?php

                    $curso = array(1, 2);

                    foreach ($curso as $clave => $valor) {
                        echo "<option value='$valor' ";

                        if ($cur == $valor) {
                            echo " selected ";
                        }


                        echo ">$valor</option>";

                    }

                    ?>

                </select>
            </p>

            <p>
                <input type='submit' name='Guardar' value='Guardar'>

                <input type="submit" name='Mostrar' value="Mostrar">

                <input type='submit' name='Borrar' value='Borrar'>

                <input type='submit' name='Importar' value='Importar'>

                <input type='submit' name='Volcar' value='Volcar'>
            </p>

            <?php

            if (isset($_GET['Guardar'])) {
                $nif = $_GET['NIF'];
                $nomb = $_GET['Nombre'];
                $apell1 = $_GET['Apellido1'];
                $apell2 = $_GET['Apellido2'];
                $curso = $_GET['Curso'];


                if (!empty($nif) && !empty($nomb) && !empty($apell1) && !empty($apell2) && !empty($curso)) {

                    $linea = $nif . " " . $nomb . " " . $apell1 . " " . $apell2 . " " . $curso . "\n";

                    $nombDocumento = "Datos.txt";

                    GuardarLinea($linea, $nombDocumento);

                } else {
                    echo "Todos los campos deben estar llenos";
                }

            }

            if (isset($_GET["Mostrar"])) {
                mostrarAlumnos();
            }

            function mostrarAlumnos() //Obtenemos 
            {
                $alumnos = array();

                if (file_exists("Datos.txt")) //
                {
                    $fd = fopen("Datos.txt", "r");

                    $linea = fgets($fd);

                    $campos = explode(" ", $linea);


                    fclose($fd);

                }

            }

            ?>
    </form>
</body>

</html>