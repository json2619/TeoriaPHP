<!DOCTYPE html>
<html>

<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Borrado Multiple</legend>

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


            function BorrarLineaDos($nifs, $NombreArchivo) //Un array de NIFS
            {
                if (file_exists($NombreArchivo)) {
                    $fd = fopen($NombreArchivo, "r");

                    $fd2 = fopen("Copia.txt", "a+") or die("Error al abrir el archivo de copia");

                    while (!feof($fd)) {
                        $lineaOrig = fgets($fd);

                        $campos = explode(" ", $lineaOrig);

                        if (count($campos) == 6) //
                        {
                            if (!in_array(trim($campos[0]), $nifs)) //Si el campo0 de esa linea no esta en el arary de los nifs a eliminar
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



            $paises = ObtenerPaises();

            $NombreArchivo = "Alumnos.txt";

            $modulares = array('Si' => 1, 'No' => 0);


            if ((isset($_GET['Borrar'])) && (isset($_GET['Selec']))) {

                $selec = $_GET['Selec']; //Recogemos el array con los códigos(NIF) de los checkboxes
            
                $nifs = array();

                foreach ($selec as $clave => $valor) {
                    //echo "Seleccionado alumno con DNI :$clave";
            
                    $nifs[] = $clave; //Añadimos los NIF que quiero borrar a un array
            
                }

                BorrarLineaDos($nifs, $NombreArchivo);
            }

            $alumnos = ObtenerAlumnos();

            echo "<table border='2'>";
            echo "<th>Selec</th>
             <th>NIF</th>
             <th>Nombre</th>
             <th>Apellido1</th>
             <th>Modular</th>
             <th>Curso</th>
             <th>Pais</th>";

            foreach ($alumnos as $alu) {
                echo "<tr>";

                $alu = explode(" ", $alu); //convertimos la linea con los datos del alumno en un array
            
                echo "<td><input type='checkbox' name='Selec[" . trim($alu[0]) . "]'></td>";

                for ($i = 0; $i < count($alu); $i++) {
                    if ($i == 3) {
                        echo "<td>" . array_search($alu[$i], $modulares) . "</td>";
                    } elseif ($i == 5) {
                        echo "<td>" . $paises[trim($alu[$i])] . "</td>";
                    } else {
                        echo "<td>$alu[$i]</td>";
                    }
                }

                echo "</tr>";
            }

            echo "</table>";




            ?>

            <input type='submit' name='Borrar' value='Borrar'>

        </fieldset>
    </form>
</body>

</html>