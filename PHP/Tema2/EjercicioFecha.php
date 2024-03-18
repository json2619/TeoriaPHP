<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php

$fechaIni = '';

function DifSegundos($ini, $fin)
{

    if ($fin > $ini) {

    }

}

if (isset($_POST['FechaIni'])) {
    $fechaIni = $_POST['FechaIni'];
}

$fechaFin = '';

if (isset($_POST['FechaFin'])) {
    $fechaFin = $_POST['FechaFin'];
}

$uni = '';

if (isset($_POST['Unidades'])) {
    $uni = $_POST['Unidades'];
}


?>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Datos de Alumnos</legend>

            <label for='FechaIni'>Fecha Inicial: </label><input type='text' name='FechaIni' placeholder='dd/mm/aaa'
                value='<?php echo "$fechaIni" ?>'><br>
            <label for='FechaFin'>Fecha Final: </label><input type='text' name='FechaFin' placeholder='dd/mm/aaa'
                value='<?php echo "$fechaFin" ?>'><br>

            <?php

            $unidades = array('segundos', 'minutos', 'Horas', 'dias', 'Semanas', 'Meses', 'años');

            echo "<label for='FechaIni'>Unidades: </label><br>";

            foreach ($unidades as $key => $value) {
                echo "<input type='radio' name='Unidades' value='$key' ";

                if ($key == $uni) {
                    echo "checked";
                }

                echo ">$value<br>";
            }
            echo "<br>";
            ?>

            <input type='submit' name='Calcular' value='Calcular'>

        </fieldset>
    </form>
</body>

<?php

if (isset($_POST['Calcular'])) {

    $diferencia = 0;

    $campos = explode("/", $fechaIni);

    $ini = mktime(0, 0, 0, $campos[1], $campos[0], $campos[2]);

    switch ($uni) {
        case 0:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en segundos es: $diferencia";
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;

        case 1:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en minutos es:" . ($diferencia / 60);
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;

        case 2:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en horas es:" . ($diferencia / (60 * 60));
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;

        case 3:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en dias es:" . ($diferencia / (60 * 60 * 24));
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;

        case 4:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en semanas es:" . ($diferencia / (60 * 60 * 24 * 7));
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;

        case 5:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en meses es:" . ($diferencia / (60 * 60 * 24));
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;

        case 6:
            $diferencia = DifSegundos($fechaIni, $fechaFin);

            if ($diferencia) {
                echo "La diferencia en años es:" . ($diferencia / (60 * 60 * 24));
            } else {
                echo "<b>Error, valores de intervalo incorrectos</b>";
            }
            break;
    }

}

?>

</html>