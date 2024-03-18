<html>
<?php

require_once 'libreria.php';

function ObtenerSituaciones()
{

    $situaciones = array();

    $consulta = "select * from Situaciones";

    $filas = ConsultaDatos($consulta);

    foreach ($filas as $fila) {
        $situaciones[$fila['Id']] = $fila;

    }

    return $situaciones;

}

function ObtenerPaises()
{

    $paises = array();

    $consulta = "select * from Paises";

    $filas = ConsultaDatos($consulta);

    foreach ($filas as $fila) {
        $paises[$fila['Id']] = $fila;

    }

    return $paises;

}


function ObtenerProvincias($pais)
{

    $provincias = array();

    $consulta = "select * from Provincias where IdPais=$pais";

    $filas = ConsultaDatos($consulta);

    foreach ($filas as $fila) {
        $provincias[$fila['IdPro']] = $fila;

    }

    return $provincias;

}

function ObtenerLocalidades($pais, $provincia)
{

    $localidades = array();

    $consulta = "select * from Localidades where IdPais=$pais and IdProvincia=$provincia ";

    $filas = ConsultaDatos($consulta);

    foreach ($filas as $fila) {
        $localidades[$fila['IdLoc']] = $fila;

    }

    return $localidades;

}



$nif = '';

if (isset($_POST['NIF'])) {
    $nif = trim($_POST['NIF']);
}

$nombre = '';

if (isset($_POST['Nombre'])) {
    $nombre = trim($_POST['Nombre']);
}


$apellido1 = '';

if (isset($_POST['Apellido1'])) {
    $apellido1 = trim($_POST['Apellido1']);
}

$apellido2 = '';

if (isset($_POST['Apellido2'])) {
    $apellido2 = trim($_POST['Apellido2']);
}


$situ = '';

if (isset($_POST['Situacion'])) {
    $situ = trim($_POST['Situacion']);
}

$direccion = '';

if (isset($_POST['Direccion'])) {
    $direccion = trim($_POST['Direccion']);
}


$pais = '';

if (isset($_POST['Pais'])) {
    $pais = $_POST['Pais'];
}

$provincia = '';

if (isset($_POST['Provincia'])) {
    $provincia = $_POST['Provincia'];
}

$localidad = '';

if (isset($_POST['Localidad'])) {
    $localidad = $_POST['Localidad'];
}


?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Alta de Profesores</legend>

            <label for='NIF'>NIF </label><input type='text' name='NIF' value='<?php echo $nif; ?>'><br>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre' value='<?php echo $nombre; ?>'><br>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'
                value='<?php echo $apellido1; ?>'><br>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'
                value='<?php echo $apellido2; ?>'><br>
            <label for='Situacion'>Situacion </label>

            <select name='Situacion'>
                <option value=''></option>
                <?php


                $situaciones = ObtenerSituaciones();   //Obtenemos las situaciones
                
                foreach ($situaciones as $clave => $fila) {
                    echo "<option value='$clave' ";

                    if ($situ == $clave) {
                        echo " selected ";
                    }


                    echo "> $fila[Nombre] </option>";

                }

                ?>

            </select><br>



            <label for='Direccíon'>Direccion </label>

            <textarea name='Direccion' rows='4' cols='30'>
            <?php echo $direccion; ?>
            </textarea><br>

            <label for='Pais'>Pais </label>
            <select name='Pais' onChange='document.f1.submit();'>
                <option value=''></option>
                <?php


                $paises = ObtenerPaises();   //Obtenemos los paises
                
                foreach ($paises as $clave => $fila) {
                    echo "<option value='$clave' ";

                    if ($pais == $clave) {
                        echo " selected ";
                    }


                    echo "> $fila[Nombre] </option>";

                }

                ?>

            </select><br>

            <label for='Provincia'>Provincia </label>
            <select name='Provincia' onChange='document.f1.submit();'>
                <option value=''></option>
                <?php


                $provincias = ObtenerProvincias($pais);   //Obtenemos las provincias de ese pais
                
                foreach ($provincias as $clave => $fila) {
                    echo "<option value='$clave' ";

                    if ($provincia == $clave) {
                        echo " selected ";
                    }


                    echo "> $fila[Nombre] </option>";

                }

                ?>

            </select><br>

            <label for='Localidad'>Localidad </label>
            <select name='Localidad' onChange='document.f1.submit();'>
                <option value=''></option>
                <?php


                $localidades = ObtenerLocalidades($pais, $provincia);   //Obtenemos las provincias de ese pais
                
                foreach ($localidades as $clave => $fila) {
                    echo "<option value='$clave' ";

                    if ($localidad == $clave) {
                        echo " selected ";
                    }


                    echo "> $fila[Nombre] </option>";

                }

                ?>

            </select><br>



            <input type='submit' name='Guardar' value='Guardar'>

        </fieldset>
    </form>
</body>

<?php

if (isset($_POST['Guardar'])) {
    //No hay que recoger los datos pues se han recogido arriba para mantener su valor tras una recarga


    $consulta = "select count(*) as cuenta from Profesores where NIF='$nif' ";

    $filas = ConsultaDatos($consulta);

    $fila = $filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0

    if ($fila['cuenta'] == 0) {

        $consulta = "insert into Profesores values('$nif','$nombre','$apellido1','$apellido2',$situ,'$direccion',$pais,$provincia,$localidad)";

        $resul = ConsultaSimple($consulta);

    } else {
        echo "<b>ERROR, ya hay un profesor para ese NIF</b>";
    }


}







?>





</html>