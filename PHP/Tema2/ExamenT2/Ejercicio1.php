<!DOCTYPE html>
<html>

<?php

require_once 'libreria.php';

function ObtenerAlumnos()
{

    $consulta = "select * from Alumnos";

    $alumnos = array();

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $alumnos[$fila['NIF']] = $fila;

    }

    return $alumnos;

}

function ObtenerModulos()
{

    $modulos = array();

    $consulta = "select * from Modulos";

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $modulos[$fila['Id']] = $fila;

    }

    return $modulos;

}

$fil = 1;

if (isset($_POST['Filas'])) {
    $fil = $_POST['Filas'];
}

if (isset($_GET['Filas'])) {
    $fil = $_GET['Filas'];
}

$alu = '';

if (isset($_POST['Alumno'])) {
    $alu = $_POST['Alumno'];
}

$mod = '';

if (isset($_POST['Modulo'])) {
    $mod = $_POST['Modulo'];
}

$nota = '';

if (isset($_POST['Nota'])) {
    $nota = $_POST['Nota'];
}
?>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>


        <fieldset>
            <legend>Poner notas a un alumno</legend>

            <p>
                <label for='Filas'>Número de Filas: </label>
                <select name='Filas' onChange='document.f1.submit()'>
                    <option value=''></option>
                    <?php
                    for ($i = 1; $i < 11; $i++) {
                        echo "<option value='$i' ";

                        if ($fil == $i) {
                            echo " selected ";
                        }

                        echo ">$i</option>";
                    }
                    ?>
                </select>
            </p>

            <?php
            for ($i = 0; $i < $fil; $i++) {

                echo "<label for='Alumno'>Alumno </label>";
                echo "<select name='Alumno'>";
                echo "<option value=''></option>";


                $alumnos = ObtenerAlumnos();

                foreach ($alumnos as $clave => $fila) {
                    echo "<option value='$clave' ";

                    if ($alu == $clave) {
                        echo " selected ";
                    }


                    echo ">$fila[Apellido1] $fila[Nombre]</option>";

                }

                echo "</select>";

                echo "<label for='Modulo'>Módulo </label>";
                echo "<select name='Modulo'>";
                echo " <option value=''></option>";

                $modulos = ObtenerModulos();

                foreach ($modulos as $clave => $fila) {
                    echo "<option value='$clave' ";

                    if ($mod == $clave) {
                        echo " selected ";
                    }


                    echo "> $fila[Nombre] </option>";

                }

                echo "</select>";

                echo "<label for='Nota'>Nota </label>";
                echo "<select name='Nota'>";
                echo "<option value=''></option>";

                for ($z = 1; $z < 11; $z++) {
                    echo "<option value='$z' ";

                    if ($nota == $z) {
                        echo " selected ";
                    }

                    echo ">$z</option>";

                }

                echo "</select>";
                echo "<br>";
            }
            ?>

            <p>
                <input type='submit' name='Calificar' value='Calificar'>
            </p>

        </fieldset>

    </form>
</body>

<?php

if (isset($_POST['Calificar'])) {

    $consulta = "select count(*) as cuenta from Notas where NIF='$alu' and CodMod=$mod ";

    $filas = ConsultaDatos($consulta);

    $fila = $filas[0];

    if ($fila['cuenta'] == 1) {

        $consulta = "update Notas set Nota=$nota   where NIF='$alu' and CodMod=$mod";

    } else
    {

        $consulta = "insert into Notas values('$alu',$mod,$nota) ";
        ;
    }


    consultaSimple($consulta);


}

?>


</html>