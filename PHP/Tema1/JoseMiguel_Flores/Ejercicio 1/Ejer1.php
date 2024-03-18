<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas</title>
</head>

<body>
    <?php

    /*
    En esta sección, vamos a recoger todos los datos que tenemos en nuestro formulario.

    */

    $agenda = '';

    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['Agenda'];
    }

    $fil = 0;

    if (isset($_GET['Fila'])) {
        $fil = $_GET['Fila'];
    }

    $col = 0;

    if (isset($_GET['Columna'])) {
        $col = $_GET['Columna'];
    }

    $subfil = 0;

    if (isset($_GET['Subfila'])) {
        $subfil = $_GET['Subfila'];
    }

    $subcol = 0;

    if (isset($_GET['Subcolumna'])) {
        $subcol = $_GET['Subcolumna'];
    }

    ?>

    <h1>Ejercicio 1:</h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <p>
                <label for='Fila'>Indique el tamaño de las filas:</label>
                <select name="Fila">
                    <option value=''></option>

                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'";

                        if ($fil == $i) {
                            echo " selected ";
                        }

                        echo ">$i</option>";
                    }

                    ?>
                </select>
            </p>

            <p>
                <label for='Columna'>Indique el tamaño de las columnas:</label>
                <select name='Columna'>
                    <option value=''></option>

                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'";

                        if ($col == $i) {
                            echo " selected ";
                        }

                        echo ">$i</option>";
                    }

                    ?>
                </select>
            </p>

            <p>
                <input type='submit' name='Enviar' value='Enviar'>
            </p>
        </fieldset>

        <p></p>


        <?php

        function crearArray($fil, $col)
        {
            /* En esta función vamos a crear el array dependiendo de l numero de filas y columnas
            que haya, ya que el tamaño de array será la multiplicació de filas * columnas
            */

            $arrnumeros = array();

            for ($i = 0; $i < ($fil * $col); $i++) {
                $arrnumeros[$i] = rand(1, 30);
            }

            return $arrnumeros;
        }

        function mostrarTabla($arrnumeros, $fil, $col)
        {
            /*
            Esta función es la que mostrará la tabla al dar a mostrar, para ello anidamos dos for, el cuál el primero me servirá
            para las filas y el segundo para las columnas. El contador es para poder acceder a todos los datos del array.
            */
            $cont = 0;

            echo "<table border='2'>";

            for ($i = 1; $i <= $fil; $i++) {

                echo "<tr>";

                for ($j = 1; $j <= $col; $j++) {

                    echo "<td>$arrnumeros[$cont]</td>";

                    $cont++;

                }

                echo "</tr>";

            }

            echo "</table>";

        }

        if (
            (isset($_GET['Enviar'])) || (isset($_GET['Dividir']))
        ) {

            echo "<fieldset>";
            $numeros = array();

            if (isset($_GET['Enviar'])) {
                $numeros = crearArray($fil, $col);
            } else {
                $arrayAnterior = $_GET['arrayAnterior'];

                $numeros = explode(",", $arrayAnterior);
            }

            echo "<br><br>";

            mostrarTabla($numeros, $fil, $col);

            echo "<br><br>";

            /*
            Aquí seguimos en el mismo formulario y lo que vamos a hacer es crearnos e formulario que
            debería salir al mostrar la tabla con los datos, crearemos un campo oculto con el que
            guardar el array para no perderlo
            */

            $anterior = implode(",", $numeros);
            echo "<input type='hidden' name='arrayAnterior' value='$anterior'>";

            echo "<p>";
            echo "<label for='Subfila'>Indique el tamaño de las subfilas:</label>";
            echo "<select name='Subfila'>";
            echo "<option value=''></option>";

            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'";

                if ($subfil == $i) {
                    echo " selected ";
                }

                echo ">$i</option>";
            }

            echo "</select>";
            echo "</p>";

            echo "<p>";
            echo "<label for='Subcolumna'>Indique el tamaño de las subcolumnas:</label>";
            echo "<select name='Subcolumna'>";
            echo "<option value=''></option>";

            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'";

                if ($subcol == $i) {
                    echo " selected ";
                }

                echo ">$i</option>";
            }

            echo "</select>";
            echo "</p>";

            echo "<p>";
            echo "<input type='submit' name='Dividir' value='Dividir'>";
            echo "</p>";

            if (isset($_GET['Dividir'])) {

                $cont = 0;

                while ($cont < count($numeros)) {
                    echo "<table border='2'>";

                    for ($i = 1; $i <= $subfil; $i++) {

                        echo "<tr>";

                        for ($j = 1; $j <= $subcol; $j++) {

                            if ($cont >= count($numeros)) {
                                echo "<td width='20' height='20'></td>";
                            } else {
                                echo "<td width='20' height='20'>$numeros[$cont]</td>";
                            }

                            $cont++;

                        }

                        echo "</tr>";

                    }

                    echo "</table>";
                }
            }

            echo "</fieldset>";
        }

        ?>

    </form>
</body>

</html>