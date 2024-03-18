<html>

<body>
    <?php

    //creacion de la agenda
    if (isset($_GET['agenda'])) { //si existe la variable
        $agenda = $_GET['agenda'];
    } else {
        $agenda = "";
    }

    //si se pulsa mostrar
    if (isset($_GET['Mostrar'])) {
        Mostraragenda($agenda);
    }
    //si se pulsa borrar
    if (isset($_GET['Borrar'])) {

        Mostraragenda($agenda);
    }
    //funcion para borrar del campo hidden con checkbox(no funciona)
    function borrar()
    {
        $agendas = array();
        if (isset($_GET["Agenda"])) {
            $agendas = $_GET["Agenda"];
        }

        $agenda2 = "";
        if (!empty($agenda)) {
            for ($i = 0; $i < count($agenda); $i = $i + 5) {
                if (!in_array($agendas[$i], $agenda))  //Si ese Dni no lo quiero eliminar
                {
                    $agenda2 = $agenda2 . $agenda[$i] . "," . $agenda[$i + 1] . "," . $agenda[$i + 2] . "," . $agenda[$i + 3] . "," . $agenda[$i + 4];
                }
            }
            $agenda = $agenda2;
        }
    }
    //meto en el archivo los datos del oculto
    if (isset($_GET['Volcar'])) {
        $repetido = false;
        //abro el archivo
        $fd = fopen("Datos.txt", "a+") or die("Error al abrir el archvio");
        //creo una copia de los datos del archivo para buscar id iguales
        while (!feof($fd)) {
            $linea = fgets($fd);
            $linea = trim($linea);
            $campos = explode(",", $linea);
            $lista=explode(",",$agenda);
            if (in_array($campos[0], $lista)) {
                $repetido = true;
            }
            if ($repetido) {
                
            } else {
                for ($i = 0; $i < count($lista); $i = $i + 5) {
                    $lista2 = $lista[$i] . "," . $lista[($i + 1)] . "," . $lista[($i + 2)] . "," . $lista[($i + 3)] . "," . $lista[($i + 4)] . "\r\n";
                    fwrite($fd, $lista2);
                }
            }
        }

        
        fclose($fd); //hay que cerrar el archivo
        $agenda = "";
    }
    //traigo la informacion del archivo al hidden y dejo vacio el archivo
    if (isset($_GET['Importar'])) {

        $repetido = false;
        //abro el archivo
        $fd = fopen("Datos.txt", "a+") or die("Error al abrir el archvio");
        //creo una copia de los datos del archivo para buscar id iguales
        while (!feof($fd)) {
            $repetido = false;
            $linea = fgets($fd);
            $linea = trim($linea);
            $campos = explode(" ", $linea);
            $lista=explode(",",$agenda);
            if (in_array($campos[0], $lista)) {
                $repetido = true;
            }
            //si esta repetido se busca la posicion del id y se sustituyen sus datos
            if ($repetido==true) {
                $pos=array_search($campos[0], $lista);
                $lista[$pos+1]=$campos[1];
                $lista[$pos+2]=$campos[2];
                $lista[$pos+3]=$campos[3];
                $lista[$pos+4]=$campos[4];
                $agenda = implode(",", $lista);
            } else {
                //sino lo suma al campo oculto
                for ($i = 0; $i < count($campos); $i++) {
                    $agenda = $agenda . $campos[$i];
                    
                }
            }
        }
        fclose($fd); //hay que cerrar el archivo
        unlink("Datos.txt");
        $fd = fopen("Datos.txt", "a+") or die("Error al abrir el archvio");
        fclose($fd);
    }
    ?>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <label for='dni'>DNI</label><input type='text' name='dni'><!-- si se mente el mismo dni se actualiza-->
        <br>
        <label for='nombre'>Nombre</label><input type='text' name='nombre'>
        <br>
        <label for='ape1'>Apellido1</label><input type='text' name='ape1'>
        <br>
        <label for='ape2'>Apellido2</label><input type='text' name='ape2'>
        <br>
        <label for='tel'>Telefono</label><input type='text' name='tel'>
        <br>
        <!--guarda en un campo oculto -->
        <input type='submit' name='Guardar' value='Guardar'>
        <!--muestra en una tabla -->
        <input type='submit' name='Mostrar' value='Mostrar'>
        <!--borra del campo oculto -->
        <input type='submit' name='Borrar' value='Borrar'>
        <!--guarda el campo oculto en un archvio, si el dni esta se actualiza el dni, y se borra del campo oculto-->
        <input type='submit' name='Volcar' value='Volcar'>
        <!--mete lo del archivo en el campo oculto -->
        <input type='submit' name='Importar' value='Importar'>

        <?php
        if (isset($_GET['Guardar'])) {
            $dni = $_GET['dni'];
            $nom = $_GET['nombre'];
            $ape1 = $_GET['ape1'];
            $ape2 = $_GET['ape2'];
            $tel = $_GET['tel'];
            //compruebo que ningun campo esta vacio
            if (!empty($dni) && !empty($nom) && !empty($ape1) && !empty($ape2) && !empty($tel)) {
                //compruebo si es el primer campo a meter
                if (empty($agenda)) {
                    $agenda = $agenda . $dni . "," . $nom . "," . $ape1 . "," . $ape2 . "," . $tel;
                } else {
                    //transformo en array
                    $lista = explode(",", $agenda);
                    //si el dni ya existe actualizo los datos
                    if (in_array($dni, $lista)) {
                        $new = array_search($dni, $lista) + 1;
                        $lista[$new] = $nom;
                        $lista[$new + 1] = $ape1;
                        $lista[$new + 2] = $ape2;
                        $lista[$new + 3] = $tel;
                        $agenda = implode(",", $lista);
                    } else {
                        $agenda = $agenda . "," . $dni . "," . $nom . "," . $ape1 . "," . $ape2 . "," . $tel;
                    }
                }
            } else {
                echo "Todos los campos tienen que estar llenos";
            }
        }
        ?>
        <input type='hidden' name='agenda' size='18' value='<?php echo $agenda; ?>'>
    </form>
    <?php
    //funcion que muestra la agenda
    function Mostraragenda($agenda)
    {
        //compruebo si esta vacia para que muestre una linea de campos vacios
        if (empty($agenda)) {
            echo "<table border=2>";
            echo "<th> </th>";
            echo "<th>dni</th>";
            echo "<th>nombre</th>";
            echo "<th>Apellido1</th>";
            echo "<th>Apellido2</th>";
            echo "<th>Telefono</th>";
            for ($j = 0; $j < 5; $j++) {
                echo "<tr>";
                echo "<td><input type='checkbox' name=Agenda["   . "]></td>";
                echo "<td></td>";
                $j++;
                echo "<td></td>";
                $j++;
                echo "<td></td>";
                $j++;
                echo "<td></td>";
                $j++;
                echo "<td></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            $lista = explode(",", $agenda);
            echo "<table border=2>";
            echo "<th> </th>";
            echo "<th>dni</th>";
            echo "<th>nombre</th>";
            echo "<th>Apellido1</th>";
            echo "<th>Apellido2</th>";
            echo "<th>Telefono</th>";
            for ($j = 0; $j < count($lista); $j++) {
                echo "<tr>";
                echo "<td><input type='checkbox' name=Agenda[" . $lista[0] . "]></td>";
                echo "<td>$lista[$j]</td>";
                $j++;
                echo "<td>$lista[$j]</td>";
                $j++;
                echo "<td>$lista[$j]</td>";
                $j++;
                echo "<td>$lista[$j]</td>";
                $j++;
                echo "<td>$lista[$j]</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>

</body>

</html>