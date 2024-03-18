<html>

<title>Mini Agenda Empleando campo oculto</title>

<body>

    <?php

    $agenda = '';  //Suponemos que la agenda esta vacia

    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['Agenda']; //Recogemos el contenido del campo oculto agenda 
    }



    if (isset($_GET['Guardar']))    //Si hemos pulsado Guardar
    {


        $nombre = $_GET['Nombre'];
        $apellido1 = $_GET['Apellido1'];
        $edad = $_GET['Edad'];

        if ($agenda == "") {
            $agenda .= $nombre . "," . $apellido1 . "," . $edad;   //Concatenamos a la variable agenda el contenido de esos tres campos
        } else {
            $agenda .= "," . $nombre . "," . $apellido1 . "," . $edad;
        }
    }


    ?>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <label for='Nombre'>Nombre</label><input type='text' name='Nombre'>
        <label for='Apellido1'>Apellido1</label><input type='text' name='Apellido1'>
        <label for='Edad'>Edad</label><input type='text' name='Edad' size='4'>



        <input type='hidden' name='Agenda' value='<?php echo $agenda; ?>'>


        <input type='submit' name='Guardar' value='Guardar'>
        <input type='submit' name='Mostrar' value='Mostrar'>


    </form>

    <?php

    if (isset($_GET['Mostrar']))    //Si hemos pulsado Guardar
    {

        if ($agenda != "") {
            $agendaArra = explode(",", $agenda);  //Convertimos la cadena con los datos de la agenda en un Array

            echo "<table border='2'>";
            echo "<th>Nombre</th><th>Apellido1</th><th>Edad</th>";

            $i = 0;

            while ($i < count($agendaArra))      //Mientras haya elementos en la agenda
            {
                echo "<tr>";

                $ini = $i;

                for ($j = $ini; $j < ($ini + 3); $j++) {
                    echo "<td>" . $agendaArra[$j] . "</td>";
                    $i++;
                }

                echo "</tr>";
            }


            echo "</table>";
        }
    }

    ?>

</body>


</html>