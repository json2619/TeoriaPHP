<!DOCTYPE html>
<html>

<?php

// actualizara el documento cambiando los datos de la línea por los que guardamos anteriormente
function actualizarLinea($nif, $escritura, $nombreArchivo)
{
    if (file_exists($nombreArchivo)) {
        $fileReader = fopen($nombreArchivo, "r");
        $fileWriter = fopen("alumnosCopia.txt", "a+") or die("Error al abrir el archivo de copia.");

        while (!feof($fileReader)) {
            $lineaArchivo = fgets($fileReader);

            $campos = explode(" ", $lineaArchivo);

            if (count($campos) == 6) {
                if ($campos[0] == $nif) { //si encuentra el dni del campo modificado, escribe la linea modificada
                    fputs($fileWriter, $escritura);
                } else {
                    fputs($fileWriter, $lineaArchivo); //si no, escribe una linea normal
                }
            }
        }

        fclose($fileReader);
        fclose($fileWriter);

        copy("alumnosCopia.txt", $nombreArchivo);
        unlink("alumnosCopia.txt");
    }
}

// borrara el alumno una vez encuentre el id que coincida con el pasado por parametro y no escribira esa línea
function borrarAlumno($dni)
{
    if (file_exists("Alumnos.txt")) //
    {
        $fd = fopen("Alumnos.txt", "r");
        $fcp = fopen("AlumnosCP.txt", "w");
        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if ($campos[0] !== $dni) {
                fwrite($fcp, $linea);
            }
        }
        copy("AlumnosCP.txt", "Alumnos.txt", );
        fclose($fcp);
        fclose($fd);
        unlink("AlumnosCP.txt");
    }
}

// nos ayudara a optener el país a través del id de mismo
function ObtenerPaises()
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

// nos sacará el nombre del alumno y su apellido 
function obtenerNombres()
{
    $arrAlumnos = array();

    if (file_exists("Alumnos.txt")) {
        $fd = fopen("Alumnos.txt", "r");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(" ", $linea);

            if (count($campos) == 6) {
                $arrAlumnos[$campos[0]] = $campos[1] . " " . $campos[2];
            }
        }

        fclose($fd);
    }

    return $arrAlumnos;
}

// esto nos sirve para mantener el valor de alumno (dni)
$alumnos = '';

if (isset($_GET['Alumnos'])) {
    $alumnos = $_GET['Alumnos'];
}

// esto nos sirve para mantener el valor de curso
$cur = '';

if (isset($_GET['Curso'])) {
    $cur = $_GET['Curso'];
}

// esto nos sirve para mantener el valor de pais
$pais = '';

if (isset($_GET['Pais'])) {
    $pais = $_GET['Pais'];
}

// esto nos sirve para mantener el valor de modulo
$modular = 0;

if (isset($_GET['Modular'])) {
    $modular = $_GET['Modular'];
}

// cunado pulse el boton de borrar recogera el dni del alumno y llamara a la funcion para borrar el alumno 
if (isset($_GET['Borrar'])) {
    $alumnos = $_GET['Alumnos'];
    borrarAlumno($alumnos);
}

// cuando se pulsa el botón de actualizar, se recogen los datos
if (isset($_GET['Actualizar'])) {
    $nif = $_GET['Nif'];
    $nombre = $_GET['Nombre'];
    $apellido = $_GET['Apellido'];
    $modular = $_GET['Modular'];
    $curso = $_GET['Curso'];
    $pais = trim($_GET['Pais']);
    $salto = "\r\n";

    // se genera la linea que se escribrira en el documento
    $escritura = $nif . " " . $nombre . " " . $apellido . " " . $modular . " " . $curso . " " . $pais . $salto;

    // ponemos el nombre del  archivo y llamamos a la función para actualizar la línea
    $nombreArchivo = "Alumnos.txt";
    actualizarLinea($nif, $escritura, $nombreArchivo);
}

?>

<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Borrado de Alumnos</legend>

            <label for='Alumnos'>Alumnos</label>
            <select name='Alumnos'>
                <?php
                $arrAlumnos = obtenerNombres();
                foreach ($arrAlumnos as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($alumnos == $clave) {
                        echo " selected ";
                    }


                    echo ">$valor</option>";
                }
                ?>
            </select>
            <input type='submit' name='Mostrar' value='Mostrar'>
            <br>
            <?php

            // una vez le damos a mostrar
            if (isset($_GET['Mostrar'])) {
                $alumnos = $_GET['Alumnos'];
                echo "<fieldset>";

                // comprobaciones sobre el fichero
                if (file_exists("Alumnos.txt")) // si existe o no
                {
                    $fd = fopen("Alumnos.txt", "r"); // abrimos 
            
                    while (!feof($fd)) { // mientras no acabe
                        $linea = fgets($fd); // recoge lineas
            
                        $campos = explode(" ", $linea); // separa campos
            
                        if (count($campos) == 6) {
                            if ($campos[0] === $alumnos) {

                                // guardamos en los (for, name) los valores guardados para recogerlos después al actualizar
            
                                echo "<label for='Nif'>NIF</label>
                                <input type='text' name='Nif' value=$campos[0] readonly='readonly'>"; //Permite que este campo solo sea de lectura pero podamos recoger datos
            
                                echo "<label for='Nombre'>Nombre</label>
                                <input type='text' name='Nombre' value=$campos[1]>";

                                echo "<label for='Apellido'>Apellido</label>
                                <input type='text' name='Apellido' value=$campos[2]>";

                                echo "<br>";

                                // sacamos los modulares
                                $modulares = array('Si' => 1, 'No' => 0);

                                foreach ($modulares as $clave => $valor) {
                                    echo "$clave<input type='radio' name='Modular' value='$valor' ";

                                    // para dejarlo seleccionado
                                    if ($valor == $campos[3]) {
                                        echo " checked ";
                                    }

                                    echo ">";
                                }

                                // sacamos el desplegable de curso
                                $curso = array(1, 2);
                                echo " <label for='Curso'>Curso:</label>";
                                echo " <select name='Curso'>";
                                echo " <option value=''></option>";

                                foreach ($curso as $clave => $valor) {
                                    echo "<option value='$valor' ";

                                    // para dejarlo seleccionado
                                    if ($campos[4] == $valor) {
                                        echo " selected ";
                                    }


                                    echo ">$valor</option>";
                                }

                                echo "</select>";

                                // sacamos el desplegable de paises
                                echo "<label for='Pais'>Pais:</label>";
                                echo "<select name='Pais'>";
                                echo "<option value=''></option>";

                                $paises = ObtenerPaises(); //Obtenemos los paises
            
                                foreach ($paises as $clave => $valor) {
                                    echo "<option value='$clave' ";

                                    // para dejarlo seleccionado
                                    if ($campos[5] == $clave) {
                                        echo " selected ";
                                    }


                                    echo ">$valor</option>";
                                }

                                echo "</select>";
                            }
                        }
                    }

                    fclose($fd);
                }

                echo "<br>";

                // los botones de uso finales
            
                echo "<input type='submit' name='Borrar' value='Borrar'>";
                echo "<input type='submit' name='Actualizar' value='Actualizar'>";
                echo "
        </fieldset>";
            }

            ?>
        </fieldset>

    </form>
</body>

</html>