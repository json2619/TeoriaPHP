<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<?php

require_once 'libreria.php';

function obtenerCiclos()
{
    $ciclos = array();

    $consulta = "select * from ciclos";

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $ciclos[$fila['Id']] = $fila['Nombre'];
    }

    return $ciclos;
}

$cicl = '';
if (isset($_POST['Ciclos'])) {
    $cicl = $_POST['Ciclos'];
}

$cur = '';

if (isset($_POST['Curso'])) {
    $cur = $_POST['Curso'];
}

?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Datos de Ciclos</legend>

            <p>
                <label for="Ciclos">Seleccione el ciclo: </label>
                <select name="Ciclos">
                    <option value=""></option>
                    <?php
                    $ciclos = obtenerCiclos();
                    foreach ($ciclos as $clave => $valor) {
                        echo "<option value='$clave' ";

                        if ($cicl == $clave) {
                            echo " selected ";
                        }

                        echo ">$valor</option>";

                    }


                    ?>
                </select>
            </p>

            <p>
                <label for='Curso'>Curso </label>
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

            <input type='submit' name='Recargar' value='Recargar'>

        </fieldset>
    </form>

    <?php

    if (isset($_POST['Recargar'])) {

        $consulta = "select Id, Nombre from modulos where Curso='$cur' and Ciclo=$cicl";

        $filas = consultaDatos($consulta);

        echo "<fieldset>";
        echo "<legend>Estos son los módulos del curso y ciclos seleccionados</legend>";
        foreach ($filas as $fila) {
            echo "<a href='$_SERVER[PHP_SELF]?IdMod=$fila[Id]'>$fila[Nombre]</a>";
            echo "<br>";
        }
        echo "</fieldset>";

    }

    if (isset($_GET['IdMod'])) {

        $codmod = $_GET['IdMod'];

        $consulta = "select a.Nombre, a.Apellido1, a.Apellido2, n.Nota from notas n , alumnos a where CodMod=$codmod and n.NIF=a.NIF";

        $filas = consultaDatos($consulta);

        echo "<table border='2'>";
        echo "<th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Nota</th>";

        foreach ($filas as $fila) {
            echo "<tr>";

            foreach ($fila as $campo) {
                echo "<td>$campo</td>";
            }

            echo "</tr>";
        }

        echo "</table>";

    }



    ?>

</body>

</html>