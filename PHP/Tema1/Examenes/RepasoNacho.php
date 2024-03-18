<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Repaso</title>
</head>

<body>

    <?php

    $numTabla = "";

    if (isset($_GET['numEle'])) {
        //recogemos los datos (así los podemos guardar al recargar la pag)
        $numTabla = $_GET['numEle'];
    }

    ?>

    <form name=f1 method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <label for='numEle'>Tamaño: </label>
        <select name="numEle">
            <option value=''></option>

            <?php

            for ($i = 1; $i <= 10; $i++) {

                echo "<option value='$i' ";

                if ($i == $numTabla) {
                    echo " selected ";
                }

                echo ">$i</option>";

            }

            ?>

        </select>

        <input type='submit' name='mostrar' value='Mostrar'>
        <br>

        <?php

        function rellenarArray($numeros, $numTabla)
        {
            //como será una tabla los números se multiplican por si mismos
        
            $num = $numTabla * $numTabla;

            for ($i = 0; $i < $num; $i++) {
                $numArray[$i] = rand(1, 20);
            }
            return $numArray;
        }

        function mostrarTabla($numeros, $numTabla)
        {
            $fil = $numTabla;
            $col = $numTabla;
            $cont = 0;


            echo "<table border=1>";

            for ($i = 0; $i < $fil; $i++) {

                echo "<tr>";

                for ($j = 0; $j < $col; $j++) {

                    echo "<td>" . $numeros[$cont] . "</td>";
                    $cont++;

                }

                echo "</tr>";
            }

            echo "</table>";
        }

        if (
            (isset($_GET['mostrar'])) || (isset($_GET['ascendente'])) ||
            (isset($_GET['descendente']))
        ) {

            $numeros = array();

            if (isset($_GET['mostrar'])) {

                $numeros = rellenarArray($numeros, $numTabla);
            } else {
                $arrayAnterior = $_GET['arrayAnterior'];

                $numeros = explode(",", $arrayAnterior);
            }

            echo "<br><br>";

            mostrarTabla($numeros, $numTabla);

            echo "<br><br>";

            //seguimos en el mismo formulario
        
            $anterior = implode(",", $numeros);
            echo "<input type='hidden' name='arrayAnterior' value='$anterior'>";

            echo "<input type='submit' name='ascendente' value='Ascendente'>";
            echo "<input type='submit' name='descendente' value='Descendente'><br><br>";

            if (isset($_GET['ascendente'])) {

                sort($numeros);

                mostrarTabla($numeros, $numTabla);

            }

            if (isset($_GET['descendente'])) {

                rsort($numeros);

                mostrarTabla($numeros, $numTabla);

            }

        }

        ?>

    </form>

</body>

</html>