<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repaso</title>
</head>

<body>

    <?php

    $agenda = '';

    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['Agenda'];
    }

    $tam = 0;

    if (isset($_GET['Tamaño'])) {
        $tam = $_GET['Tamaño'];
    }

    ?>

    <h1>Ejercicio Repaso:</h1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <p>
            <label for="Tamaño">Indique el tamaño:</label>
            <select name="Tamaño">
                <option value=""></option>

                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo "<option value='$i'";

                    if ($tam == $i) {
                        echo " selected ";
                    }

                    echo ">$i</option>";
                }

                ?>
            </select>
        </p>

        <input type='hidden' name='Agenda' value='<?php echo $agenda; ?>'>

        <p>
            <input type="submit" name='Mostrar' value="Mostrar">
        </p>

        <?php

        function guardarAgenda($agenda, $arraNumeros)
        {
            for ($i = 0; $i < count($arraNumeros); $i++) {
                if ($agenda == "") {
                    $agenda .= $arraNumeros[$i] . ",";
                } else {
                    $agenda .= $arraNumeros[$i] . ",";
                }
            }
            return $agenda;
        }

        function crearArray($tam)
        {

            $arrnumeros = array();

            for ($i = 0; $i < $tam * $tam; $i++) {
                $arrnumeros[$i] = rand(0, 20);
            }

            return $arrnumeros;
        }

        function mostrarTabla($arrnumeros, $tam)
        {

            $contador = 0;

            echo "<table border='2'>";

            for ($i = 1; $i <= $tam; $i++) {

                echo "<tr>";

                for ($j = 1; $j <= $tam; $j++) {

                    echo "<td>$arrnumeros[$contador]</td>";

                    $contador = $contador + 1;

                }

                echo "</tr>";



            }

            echo "</table>";

        }

        if (
            (isset($_GET['Mostrar'])) || (isset($_GET['Ascendente'])) ||
            (isset($_GET['Descendente']))
        ) {

            $numeros = array();

            if (isset($_GET['Mostrar'])) {
                $numeros = crearArray($tam);
            } else {
                $arrayAnterior = $_GET['arrayAnterior'];

                $numeros = explode(",", $arrayAnterior);
            }

            echo "<br><br>";

            mostrarTabla($numeros, $tam);

            echo "<br><br>";

            /*
            esto es por si hay que hacer otro formulario dentro de este
            echo "<form method='get' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<p>";
            echo "<input type='submit' name='Ascendente' value='Ascendente'> ";
            echo "<input type='submit' name='Descendente' value='Descendente'>";
            echo "</p>";
            echo "<input type='hidden' name='Tamaño' value='" . $tama . "'>";
            echo "<input type='hidden' name='Agenda' value='" . $copia . "'>";
            echo "</form>";
            */

            $anterior = implode(",", $numeros);
            echo "<input type='hidden' name='arrayAnterior' value='$anterior'>";

            echo "<input type='submit' name='Ascendente' value='Ascendente'>";
            echo "<input type='submit' name='Descendente' value='Descendente'><br><br>";

            if (isset($_GET['Ascendente'])) {

                sort($numeros);

                mostrarTabla($numeros, $tam);

            }

            if (isset($_GET['Descendente'])) {

                rsort($numeros);

                mostrarTabla($numeros, $tam);

            }

        }

        ?>

    </form>


</body>

</html>