<!DOCTYPE html>
<html>

<?php


function BorrarLinea($nif, $NombreArchivo)
{
    if (file_exists($NombreArchivo)) {
        $fd = fopen($NombreArchivo, "r");

        $fd2 = fopen("Copia.txt", "a+") or die("Error al abrir el archivo de copia");

        while (!feof($fd)) {
            $lineaOrig = fgets($fd);

            $campos = explode(" ", $lineaOrig);

            if (count($campos) == 6) //
            {
                if (trim($campos[0]) != $nif) //Si el nif no coincide con el del alumno que quiero borrar
                {
                    fputs($fd2, $lineaOrig); //Guardamos en el archivo copia esa linea
                }


            }
        }

        fclose($fd);
        fclose($fd2);

        copy("Copia.txt", $NombreArchivo); //Sobreescribimos en el archivo original con los datos de la copia

        unlink("Copia.txt"); //Eliminamos el archivo de copia auxiliar
    }



}




function ActualizarLinea($nif, $linea, $NombreArchivo)
{
    if (file_exists($NombreArchivo)) {
        $fd = fopen($NombreArchivo, "r");

        $fd2 = fopen("Copia.txt", "a+") or die("Error al abrir el archivo de copia");

        while (!feof($fd)) {
            $lineaOrig = fgets($fd);

            $campos = explode(" ", $lineaOrig);

            if (count($campos) == 6) //
            {
                if (trim($campos[0]) == $nif) //Si el nif coincide con el del alumno que quiero actualizar
                {
                    fputs($fd2, $linea); //Guardamos en el archivo copia la linea recibida
                } else {
                    fputs($fd2, $lineaOrig); //Guardamos en el archivo la linea original
                }

            }
        }

        fclose($fd);
        fclose($fd2);

        copy("Copia.txt", $NombreArchivo); //Sobreescribimos en el archivo original con los datos de la copia

        unlink("Copia.txt"); //Eliminamos el archivo de copia auxiliar
    }



}

function GuardarLinea($linea, $NombreArchivo)
{
    $fd = fopen($NombreArchivo, "a+") or die("Error al abrir el archivo $NombreArchivo");

    fputs($fd, $linea);

    fclose($fd);

}


function ObtenerPaises() //Obtenemos
{
    $paises = array();

    if (file_exists("Paises.txt")) //
    {
        $fd = fopen("Paises.txt", "r");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if (count($campos) == 2) //
            {
                $paises[$campos[0]] = $campos[1];

            }
        }

        fclose($fd);

    }

    return $paises;

}

function ObtenerAlumnos()
{
    $alumnos = array();

    if (file_exists("Alumnos.txt")) //
    {
        $fd = fopen("Alumnos.txt", "r");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if (count($campos) == 6) {
                $alumnos[trim($campos[0])] = $linea;

            }
        }

        fclose($fd);
    }

    return $alumnos;

}

$alu = '';

if (isset($_GET['Alumno'])) {
    $alu = $_GET['Alumno'];
}


if (isset($_GET['Actualizar'])) //Recogemos los datos que queremos actualizar
{
    $nif = $_GET['NIF'];
    $nombre = $_GET['Nombre'];
    $apellido1 = $_GET['Apellido1'];

    $modular = $_GET['Modular'];
    $cur = $_GET['Curso'];

    $pais = $_GET['Pais'];

    $salto = "\r\n";

    $linea = $nif . " " . $nombre . " " . $apellido1 . " " . $modular . " " . $cur . " " . $pais . $salto;

    $NombreArchivo = "Alumnos.txt";

    ActualizarLinea($nif, $linea, $NombreArchivo);

}


if (isset($_GET['Borrar'])) //Recogemos los datos que queremos actualizar
{
    $nif = $_GET['NIF'];

    $NombreArchivo = "Alumnos.txt";

    BorrarLinea($nif, $NombreArchivo);


}






?>

<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>


        <fieldset>
            <legend>Alumno a Buscar</legend>
            <select name='Alumno'>
                <option value=''></option>
                <?php


                $alumnos = ObtenerAlumnos(); //Obtenemos los paises
                
                foreach ($alumnos as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($alu == $clave) {
                        echo " selected ";
                    }

                    $campos = explode(" ", $valor);

                    echo ">$campos[2],$campos[1]</option>";

                }

                ?>

            </select><input type='submit' name='Buscar' value='Buscar'>

        </fieldset>

        <?php

        if (isset($_GET['Buscar'])) //
        {

            $nif = $_GET['Alumno'];

            $linea = $alumnos[$nif]; //Recuperamos la linea con los datos de ese alumno
        
            $campos = explode(" ", $linea);

            echo "<fieldset><legend>Datos del alumno</legend>";

            echo "<label for='NIF'>NIF </label><input type='text' name='NIF' value='$campos[0]' readonly='readonly'>";
            echo "<label for='Nombre'>Nombre </label><input type='text' name='Nombre' value='$campos[1]' >";
            echo "<label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1' value='$campos[2]' ><br>";

            echo "<label for='Modular'>Modular:</label><br>";

            $modulares = array('Si' => 1, 'No' => 0);

            foreach ($modulares as $clave => $valor) {
                echo "$clave<input type='radio' name='Modular' value='$valor' ";

                if ($valor == $campos[3]) {
                    echo " checked ";
                }

                echo ">";

            }

            echo "<label for='Curso'>Curso:</label>";
            echo "<select name='Curso'>";
            echo "<option value=''></option>";

            $curso = array(1, 2);

            foreach ($curso as $clave => $valor) {
                echo "<option value='$valor' ";

                if ($campos[4] == $valor) {
                    echo " selected ";
                }


                echo ">$valor</option>";

            }

            echo "</select>";

            echo "<label for='Pais'>Pais:</label>";
            echo "<select name='Pais'>";
            echo "<option value=''></option>";

            $paises = ObtenerPaises(); //Obtenemos los paises
        
            foreach ($paises as $clave => $valor) {
                echo "<option value='$clave' ";

                if ($campos[5] == $clave) {
                    echo " selected ";
                }


                echo ">$valor</option>";

            }

            echo "</select>";

            echo "<input type='submit' name='Actualizar' value='Actualizar'>";
            echo "<input type='submit' name='Borrar' value='Borrar'>";

            echo "</fieldset>";

        }

        ?>



    </form>
</body>

</html>