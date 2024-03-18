<html>
<?php

require_once 'libreria.php';
require_once 'FuncionesFechas.php';

?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Datos de Alumnos</legend>

            <label for='NIF'>NIF </label><input type='text' name='NIF'><br>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'><br>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'><br>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'><br>
            <label for='Telefono'>Telefono </label><input type='text' name='Telefono'><br>
            <label for='Premios'>Premios </label><input type='text' name='Premios'><br>
            <label for='FechaNac'>Fecha Nac </label><input type='text' name='FechaNac' placeholder='dd/mm/year'>
            <input type='submit' name='Guardar' value='Guardar'>

        </fieldset>
    </form>
</body>

<?php

$fecha = "30/11/1901";

function FechaOk($fecha)             //Funcion que verifica si una fecha es correcta
{

    $DentroLim = FALSE;

    if (FechaValida($fecha))    //Si la fecha es válida comprobamos que está dentro del intervalo permitido 
    {

        $camposFecha = explode("/", $fecha);

        //Edades máximas y mínimas permitidas en numero de años

        $Min = 18;

        $Max = 122;

        $hoy = time();  //Cogemos la fecha actual

        $camposHoy = getdate($hoy); //Pasamoa a formato legible la fecha actual

        //Comprobamos el limite inforiror de la fecha

        if ((($camposHoy['year'] - $camposFecha[2]) <= 122)) {
            if ($camposFecha[1] >= $camposHoy['mon']) {
                if ($camposFecha[0] >= $camposHoy['mday']) {
                    $LimInferior = TRUE;    //Esa fecha no excede el límite inferior
                }

            }

        }

        //Comprobamos el limite superior de la fecha


        if ((($camposHoy['year'] - $camposFecha[2]) >= 18)) {
            if ($camposFecha[1] <= $camposHoy['mon']) {
                if ($camposFecha[0] <= $camposHoy['mday']) {
                    $LimSuperior = TRUE;    //Esa fecha no excede el límite inferior
                }

            }

        }

        $DentroLim = ($LimInferior && $LimSuperior);

        return ($DentroLim);  //Si cumple con ambos limites   

    }

}




if (isset($_POST['Guardar'])) {
    $nif = $_POST['NIF'];
    $nombre = $_POST['Nombre'];
    $apellido1 = $_POST['Apellido1'];
    $apellido2 = $_POST['Apellido2'];
    $telefono = $_POST['Telefono'];
    $premios = $_POST['Premios'];
    $fechaNac = $_POST['FechaNac'];




    $consulta = "select count(*) as cuenta from Alumnos where NIF='$nif' ";

    $filas = ConsultaDatos($consulta);

    $fila = $filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0

    if ($fila['cuenta'] == 0) {

        $consulta = "insert into Alumnos values('$nif','$nombre','$apellido1','$apellido2','$telefono',$premios)";

        $resul = ConsultaSimple($consulta);

    } else {
        echo "<b>ERROR, ya hay un alumno para ese NIF</b>";
    }


}







?>





</html>