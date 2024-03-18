<html>

<?php
require_once 'libreria.php';

$nif = '';
if (isset($_POST['NIF'])) {
    $nif = $_POST['NIF'];
}

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
            <legend>Alta de Profesores</legend>

            <label for='NIF'>NIF </label><input type='text' name='NIF' value='<?php echo $nif ?>'><br>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre' value='<?php echo $nombre ?>'><br>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'
                value='<?php echo $apellido1 ?>'><br>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'
                value='<?php echo $apellido2 ?>'><br>

            <label for='Situacion'>Situación: </label>
            <select name='Situacion'>
                <option value=''></option>

                <?php
                $situaciones = ObtenerSituacion();

                foreach ($situaciones as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($sit == $clave) {
                        echo "selected";
                    }

                    echo ">$valor</option>";
                }
                ?>
            </select><br>

            <label for="Direccion">Dirección: </label><textarea name="Direccion" cols="30"
                rows="10"><?php echo $direccion ?></textarea><br>

            <label for='Pais'>País: </label>
            <select name='Pais' onChange='document.f1.submit()'>
                <option value=''></option>

                <?php
                $paises = ObtenerPais();

                foreach ($paises as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($pai == $clave) {
                        echo "selected";
                    }

                    echo ">$valor</option>";
                }
                ?>
            </select><br>

            <label for='Provincia'>Provincias: </label>
            <select name='Provincia' onChange='document.f1.submit()'>

                <option value=''></option>

                <?php
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
                ?>
            </select><br>

            <label for='Localidad'>Localidad: </label>
            <select name='Localidad'>

                <option value=''></option>

                <?php
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
                ?>
            </select><br>

            <input type='submit' name='Guardar' value='Guardar'>

        </fieldset>
    </form>
</body>

<?php

if (isset($_POST['Guardar'])) {

    $consulta = "select count(*) as cuenta from profesores where NIF='$nif' ";

    $filas = consultaDatos($consulta);

    $fila = $filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0

    if ($fila['cuenta'] == 0) {

        $consulta = "insert into profesores values('$nif','$nombre','$apellido1','$apellido2', $sit,'$direccion', $pai, $prov, $loc)";

        $resul = consultaSimple($consulta);

    } else {
        echo "<b>ERROR, ya hay un alumno para ese NIF</b>";
    }
}

?>

</html>