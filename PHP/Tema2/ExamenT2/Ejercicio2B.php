<!DOCTYPE html>
<html>

<?php

require_once 'libreria.php';

$nombre = '';
if (isset($_POST['Nombre'])) {
    $nombre = $_POST['Nombre'];
}

$apellido1 = '';
if (isset($_POST['Apellido1'])) {
    $apellido1 = $_POST['Apellido1'];
}

$apellido2 = '';
if (isset($_POST['Apellido2'])) {
    $apellido2 = $_POST['Apellido2'];
}

$direccion = '';
if (isset($_POST['Direccion'])) {
    $direccion = $_POST['Direccion'];
}

function ObtenerProfesor()
{

    $consulta = "select * from profesores";

    $profesores = array();

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $profesores[$fila['NIF']] = $fila;

    }

    return $profesores;
}

$nif = '';

if (isset($_POST['NIF'])) {
    $nif = $_POST['NIF'];
}

if (isset($_GET['NIF'])) {
    $nif = $_GET['NIF'];
}

function ObtenerSituacion()
{

    $consulta = "SELECT * FROM situaciones";

    $situaciones = array();

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $situaciones[$fila['Id']] = $fila['Nombre'];
    }

    return $situaciones;
}

function ObtenerPais()
{

    $consulta = "SELECT * FROM paises";

    $paises = array();

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $paises[$fila['Id']] = $fila['Nombre'];

    }

    return $paises;
}

$sit = '';

if (isset($_POST['Situacion'])) {
    $sit = $_POST['Situacion'];
}

$pai = '';

if (isset($_POST['Pais'])) {
    $pai = $_POST['Pais'];
}

if (isset($_GET['Pais'])) {
    $pai = $_GET['Pais'];
}

function ObtenerProvincia($pai)
{

    $consulta = "SELECT * FROM provincias where IdPais=$pai";

    $provincias = array();

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $provincias[$fila['IdPro']] = $fila;

    }

    return $provincias;
}

$prov = '';

if (isset($_POST['Provincia'])) {
    $prov = $_POST['Provincia'];
}

if (isset($_GET['Provincia'])) {
    $prov = $_GET['Provincia'];
}

function ObtenerLocalidad($pai, $prov)
{

    $consulta = "SELECT * FROM localidades where IdPais=$pai and IdProvincia=$prov";

    $ocalidades = array();

    $filas = consultaDatos($consulta);

    foreach ($filas as $fila) {
        $localidades[$fila['IdLoc']] = $fila;

    }

    return $localidades;
}

$loc = '';

if (isset($_POST['Localidad'])) {
    $loc = $_POST['Localidad'];
}

?>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>


        <fieldset>
            <legend>Gestión de profesores</legend>

            <p>
                <label for='NIF'>NIF: </label>
                <select name='NIF' onChange='document.f1.submit()'>
                    <option value=''></option>
                    <?php
                    $profesores = ObtenerProfesor();   //Obtenemos los paises
                    
                    foreach ($profesores as $clave => $fila) {
                        echo "<option value='$clave' ";

                        if ($nif == $clave) {
                            echo " selected ";
                        }


                        echo ">$fila[Apellido1] $fila[Apellido2], $fila[Nombre] </option>";

                    }
                    ?>
                </select>
            </p>

            <?php
            if (isset($_POST['NIF'])) {
                $fila = $profesores[$nif];
                $nombre = $fila['Nombre'];
                $apellido1 = $fila['Apellido1'];
                $apellido2 = $fila['Apellido2'];
                $direccion = $fila['Direccion'];
                $pai = $fila['Pais'];
                $prov = $fila['Provincia'];
                $loc = $fila['Localidad'];

                echo "<label for='Nombre'>Nombre </label><input type='text' name='Nombre' value=$nombre ><br>";
                echo "<label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1' value=$apellido1 ><br>";
                echo "<label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2' value=$apellido2 ><br>";

                echo "<label for='Situacion'>Situación: </label>";
                echo "<select name='Situacion'>";
                echo "<option value=''></option>";

                $situaciones = ObtenerSituacion();

                foreach ($situaciones as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($fila['Situacion'] == $clave) {
                        echo " selected ";
                    }

                    echo ">$valor</option>";

                }

                echo "</select><br>";

                echo "<label for='Direccion'>Dirección: </label><textarea name='Direccion' cols='30'
                rows='S10'>$direccion</textarea><br>";

                echo "<label for='Pais'>País: </label>";
                echo "<select name='Pais' onChange='document.f1.submit()'>";
                echo "<option value=''></option>";

                $paises = ObtenerPais();

                foreach ($paises as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($pai == $clave) {
                        echo "selected";
                    }

                    echo ">$valor</option>";
                }

                echo "</select><br>";

                echo "<label for='Provincia'>Provincia: </label>";
                echo "<select name='Provincia' onChange='document.f1.submit()'>";
                echo "<option value=''></option>";

                if ($pai != '') {
                    $provincias = ObtenerProvincia($pai);

                    foreach ($provincias as $clave => $fila) {
                        echo "<option value='$clave' ";

                        if ($prov == $clave) {
                            echo " selected ";
                        }


                        echo "> $fila[Nombre] </option>";

                    }
                }

                echo "</select><br>";

                echo "<label for='Localidad'>Localidad: </label>";
                echo "<select name='Localidad'>";
                echo "<option value=''></option>";

                if ($prov != '') {
                    $localidades = ObtenerLocalidad($pai, $prov);

                    foreach ($localidades as $clave => $fila) {
                        echo "<option value='$clave' ";

                        if ($loc == $clave) {
                            echo " selected ";
                        }

                        echo "> $fila[Nombre] </option>";

                    }
                }

                echo "</select><br>";
            }
            ?>

            <p>
                <input type='submit' name='Modificar' value='Modificar'>
            </p>

        </fieldset>

    </form>
</body>

<?php

if (isset($_POST['Calificar'])) {

    $consulta = "select count(*) as cuenta from profesores where NIF='$nif'";

    $filas = ConsultaDatos($consulta);

    $fila = $filas[0];


    if ($fila['cuenta'] == 1) {

        $consulta = "update profesores set Nombre='$nombre', Apellido1='$apellido1',
            Apellido2='$apellido2', Situacion=$sit, Direccion='$direccion', Pais=$pai, Provincia=$prov, Localidad=$loc where NIF='$nif'";

    } else {
        echo "<b>ERROR, No hay ningúnprofesor para ese NIF</b>";
    }


    consultaSimple($consulta);


}

?>


</html>