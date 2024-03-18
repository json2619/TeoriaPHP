<!DOCTYPE html>
<html>

<?php


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



$cur = '';

if (isset($_GET['Curso'])) {
    $cur = $_GET['Curso'];
}

$pais = '';

if (isset($_GET['Pais'])) {
    $pais = $_GET['Pais'];
}

$modular = 0; // Por defecto suponemos que nos es modular

if (isset($_GET['Modular'])) {
    $modular = $_GET['Modular'];
}

?>



<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Alta de Alumnos</legend>
            <label for='NIF'>NIF </label><input type='text' name='NIF'>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'><br>

            <label for='Modular'>Modular:</label><br>

            <?php

            $modulares = array('Si' => 1, 'No' => 0);

            foreach ($modulares as $clave => $valor) {
                echo "$clave<input type='radio' name='Modular' value='$valor' ";

                if ($valor == $modular) {
                    echo " checked ";
                }

                echo ">";

            }

            ?>

            <label for='Curso'>Curso:</label>
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

            <label for='Pais'>Pais:</label>
            <select name='Pais'>
                <option value=''></option>

                <?php

                $paises = ObtenerPaises(); //Obtenemos los paises
                
                foreach ($paises as $clave => $valor) {
                    echo "<option value='$clave' ";

                    if ($pais == $clave) {
                        echo " selected ";
                    }


                    echo ">$valor</option>";

                }

                ?>

            </select>

            <input type='submit' name='Guardar' value='Guardar'>
        </fieldset>

    </form>
</body>

</html>

<?php



if (isset($_GET['Guardar'])) //
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

    GuardarLinea($linea, $NombreArchivo);


}

?>