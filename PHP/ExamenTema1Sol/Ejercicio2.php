<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario PHP</title>
</head>

<body>

    <?php
    // Definimos los valores por defecto o los obtenemos del GET
    
    $nif = "";
    $nombre = "";
    $apellido1 = "";
    $apellido2 = "";

    function GuardarLinea($linea, $NombreArchivo)
    {
        $fd = fopen($NombreArchivo, "a+") or die("Error al abrir el archivo $NombreArchivo");

        fputs($fd, $linea);

        fclose($fd);

    }

    function ObtenerDatosArchivo($nombre)
    {
        $datos = array();

        if (file_exists($nombre)) //
        {
            $fd = fopen($nombre, "r");

            while (!feof($fd)) {
                $linea = fgets($fd);

                $campos = explode(" ", $linea);

                if (count($campos) == 2) //
                {
                    $datos[$campos[0]] = $campos[1];

                }
            }

            fclose($fd);

        }

        return $datos;

    }


    $deportSelec = array(); //Array con los deportes previamente seleccionados
    
    if (isset($_GET["Deportes"])) {
        $deportSelec = $_GET["Deportes"];
    }

    $estado = "";

    if (isset($_GET["Estado"])) {
        $estado = $_GET["Estado"];
    }


    if (isset($_GET['Guardar'])) //
    {

        $nif = $_GET['NIF'];
        $nombre = $_GET['Nombre'];
        $apellido1 = $_GET['Apellido1'];
        $apellido2 = $_GET['Apellido2'];

        $salto = "\r\n";

        $linea = $nif . " " . $nombre . " " . $apellido1 . " " . $apellido2 . " " . $estado . $salto;

        $NombreArchivo = "Clientes.txt";

        GuardarLinea($linea, $NombreArchivo);  //Guardamos la linea el el archivo de clientes
    
        if (count($deportSelec) > 0)  //Si hemos seleccionado algun deporte
        {
            $NombreArchivo = "CliDeportes.txt";   //Archivo que guardar los deportes de cada alumno
    
            foreach ($deportSelec as $clave => $valor)   //Para cada uno de los deportes seleccionados
            {

                $linea = $nif . " " . $clave . $salto;

                GuardarLinea($linea, $NombreArchivo);  //Guardamos la linea el el archivo de DeportesAlum
            }

        }

    }


    ?>





    <fieldset>
        <legend>Alta de Clientes</legend>

        <form name='f1' method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

            NIF: <input type="text" name="NIF" value="<?php echo $nif; ?>"><br>
            Nombre: <input type="text" name="Nombre" value="<?php echo $nombre; ?>"><br>
            Apellido1: <input type="text" name="Apellido1" value="<?php echo $apellido1; ?>"><br>
            Apellido2: <input type="text" name="Apellido2" value="<?php echo $apellido2; ?>"><br>


            <?php

            // Definimos las opciones para estado civil y deportes
            
            $estados = ObtenerDatosArchivo("Estados.txt");
            $deportes = ObtenerDatosArchivo("Deportes.txt");

            // Iteramos sobre los estados civiles
            echo "Estado Civil:<br>";

            foreach ($estados as $clave => $valor) {
                echo "<input type='radio' name='Estado' value='$clave'";

                if ($estado == $clave) {
                    echo " checked";
                }
                echo "> $valor";
            }

            echo "<br><br>";

            // Iteramos sobre los deportes
            echo "Deportes:<br>";
            foreach ($deportes as $clave => $valor) {
                echo "<input type='checkbox' name='Deportes[$clave]' ";

                if (array_key_exists($clave, $deportSelec)) {
                    echo " checked";
                }
                echo ">$valor<br>";
            }
            ?>


            <input type="submit" name='Guardar' value="Guardar">
        </form>

    </fieldset>




</body>

</html>