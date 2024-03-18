<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<?php

require_once 'libreria.php';

$num = '';

if (isset($_POST['Numero'])) {
    $num = $_POST['Numero'];
}

$opc = 1;

if (isset($_POST['Opcion'])) {
    $num = $_POST['Opcion'];
}

?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Estadísticas de Alumnos</legend>

            <p>
                <label for="Opcion">Opción: </label>

                <?php
                $opciones = array(1 => "Aprobado", 2 => "Suspenso");

                foreach ($opciones as $key => $value) {
                    echo "<input type='radio' name='Opcion' value=$key";

                    if ($key == $opc) {
                        echo " checked";
                    }

                    echo "> $value";
                }
                ?>
            </p>

            <p>
                <label for="Numero">Número: </label><select name='Numero'>
                    <option value=''></option>
                    <?php

                    for ($i = 0; $i <= 10; $i++) {
                        echo "<option value='$i' ";

                        if ($num == $i) {
                            echo " selected ";
                        }


                        echo ">$i</option>";
                    }

                    ?>

                </select>
            </p>

            <input type='submit' name='Filtrar' value='Filtrar'>

        </fieldset>
    </form>

    <?php

    if (isset($_POST['Filtrar'])) {

        $option = $_POST['Opcion'];

        $consulta = "select CodMod, m.Nombre, count(Nota) as Suspensos from notas n, Modulos m where ";

        if ($option == 1) {
            $consulta .= "Nota>=5 and ";
        } else {
            $consulta .= "Nota<5 and ";
        }

        $consulta .= "n.CodMod=m.ID group by CodMod having Suspensos >= $num order by Suspensos desc";

        $filas = consultaDatos($consulta);

        echo "<fieldset><legend>Resultado de la consulta</legend>";

        echo "<table border='2'>";
        echo "<th>Código Módulo</th><th>Nombre 1</th><th>Número Alumnos</th>";

        foreach ($filas as $fila) {
            echo "<tr>";

            foreach ($fila as $campo) {
                echo "<td>$campo</td>";
            }

            echo "</tr>";
        }

        echo "</table>";


        echo "</fieldset>";

    }

    ?>

</body>

</html>