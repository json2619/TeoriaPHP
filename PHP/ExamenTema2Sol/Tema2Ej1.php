<!DOCTYPE html>
<html>

<?php

require_once 'libreria.php';


function ObtenerAlumnos()
{

    $consulta = "select * from Alumnos";

    $alumnos = array();

    $filas = ConsultaDatos($consulta);

    foreach ($filas as $fila) {
        $alumnos[$fila['NIF']] = $fila;

    }

    return $alumnos;

}

function ObtenerModulos()
{

    $modulos = array();

    $consulta = "select * from Modulos";

    $filas = ConsultaDatos($consulta);

    foreach ($filas as $fila) {
        $modulos[$fila['Id']] = $fila;

    }

    return $modulos;

}


function InsertarFila($fil, $alums, $mods, $notas)  //Inserta una fila $i de introducción de datos en la página
{

    echo "<label for='Alumno'>Alumno </label>";
    echo "  <select name='Alumnos[$fil]'>";
    echo "     <option value=''></option>";

    $alumnos = ObtenerAlumnos();   //Obtenemos los alumnos

    foreach ($alumnos as $clave => $fila) {
        echo "<option value='$clave' ";

        if (!empty($alums) && isset($alums[$fil])) {
            if ($alums[$fil] == $clave) {
                echo " selected ";
            }

        }

        echo ">$fila[Apellido1] $fila[Nombre] </option>";

    }


    echo "</select>";

    echo "<label for='Modulos'>Módulo </label>";
    echo "   <select name='Modulos[$fil]'>";
    echo "     <option value=''></option>";

    $modulos = ObtenerModulos();   //Obtenemos los paises

    foreach ($modulos as $clave => $fila) {
        echo "<option value='$clave' ";

        if (!empty($mods) && isset($mods[$fil])) {

            if ($mods[$fil] == $clave) {
                echo " selected ";
            }

        }

        echo "> $fila[Nombre] </option>";

    }

    echo "</select>";


    echo "<label for='Nota'>Nota </label>";
    echo "   <select name='Notas[$fil]'>";

    for ($i = 0; $i < 11; $i++) {
        echo "<option value='$i' ";


        if (!empty($notas) && isset($notas[$fil])) {

            if ($notas[$fil] == $i) {
                echo " selected ";
            }

        }

        echo "> $i </option>";
    }

    echo "</select>";


}






function GuardarNota($alu, $nota, $mod)     //Guarda(Inserta o actualiza) para ese alumno esa nota en ese módulo 
{
    $consulta = "select count(*) as cuenta from Notas where NIF='$alu' and CodMod=$mod ";

    $filas = ConsultaDatos($consulta);

    $fila = $filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0


    if ($fila['cuenta'] == 1)    //Ya había una nota para ese alumno en ese módulo y hay que actualirla
    {

        $consulta = "update Notas set Nota=$nota   where NIF='$alu' and CodMod=$mod";

    } else //NO había una nota para ese alumno en ese módulo y hay que insertar
    {

        $consulta = "insert into Notas values('$alu',$mod,$nota) ";
        ;
    }


    ConsultaSimple($consulta);



}



$alums = array();

if (isset($_POST['Alumnos'])) {
    $alums = $_POST['Alumnos'];
}

$mods = array();

if (isset($_POST['Modulos'])) {
    $mods = $_POST['Modulos'];
}

$notas = array();

if (isset($_POST['Notas'])) {
    $notas = $_POST['Notas'];
}



$numFils = 1;    //Numero de filas de introducción de datos a mostrar

if (isset($_POST['NumFils'])) {
    $numFils = $_POST['NumFils'];
}


?>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>


        <fieldset>
            <legend>Poner notas a un alumno</legend>

            <label for='NumFil'>Numero de Filas</label>

            <select name='NumFils' onchange='document.f1.submit()'>
                <option value=''></option>
                <?php

                for ($i = 1; $i < 11; $i++) {
                    echo "<option value='$i' ";

                    if ($numFils == $i) {
                        echo " selected ";
                    }

                    echo "> $i </option>";

                }

                ?>

            </select><br><br>


            <?php

            //Mostramos tantas filas como indique el desplegable  
            
            for ($i = 0; $i < $numFils; $i++) {
                InsertarFila($i, $alums, $mods, $notas);    // Insertamos una fila de campos de introducción de datos
            
                echo "<br>";
            }

            ?>

            <input type='submit' name='Calificar' value='Calificar'>

        </fieldset>

    </form>
</body>

<?php

if (isset($_POST['Calificar'])) //
{



    foreach ($alums as $clave => $valor)    //Para cada uno de los desplegables de alumnos
    {
        if (($alums[$clave] != '') && ($notas[$clave] != '') && ($mods[$clave] != '')) {
            GuardarNota($alums[$clave], $notas[$clave], $mods[$clave]);
        } else {
            echo "<B>Debe seleccionar un alumno, modulo y nota</B>";
        }


    }



}

?>



</html>