<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PosPalabra</title>
</head>

<body>
    <h1>Ejercicio buscar cadena</h1>

    <form action="" method="get">
        <p>
            <label for="Palabra1">Introduzca la palabra grande:</label>
            <input type="text" name="Palabra1">
        </p>

        <p>
            <label for="Palabra2">Introduzca la palabra corta:</label>
            <input type="text" name="Palabra2">
        </p>

        <input type="submit" name="Buscar" value="Buscar">
    </form>

    <?php

    if (isset($_GET['Buscar'])) {
        $palabra1 = $_GET['Palabra1'];
        $palabra2 = $_GET['Palabra2'];

        $posinit = palabraContenida($palabra1, $palabra2);
        echo "La palabra se encunetra en la posición: " . $posinit;
    }

    function palabraContenida($palabra1, $palabra2)
    {
        $puntInicio = 0;
        $palabraAux = '';
        $punt2 = 0;

        if (strlen($palabra1) > strlen($palabra2)) {
            $contenida = false;

            for ($i = 0; $i < strlen($palabra1) && !$contenida; $i++) {

                if ($palabra1[$i] === $palabra2[$punt2]) {
                    $puntInicio = $i;
                    $palabraAux .= $palabra1[$i];
                    $punt2++;

                    if ($palabra2 === $palabraAux) {
                        $contenida = true;
                    }
                } else {
                    $i -= $punt2;
                    $punt2 = 0;
                }
            }
        } else {
            echo "La cadena " . $palabra2 .  " no puede estar contenida al ser menor que " . $palabra1;
        }

        return $puntInicio;
    }

    ?>
</body>

</html>