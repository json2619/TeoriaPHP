<html>

<title>Mini Agenda Empleando campo oculto</title>

<body>

    <?php

    // TIENES QUE ACTUALIZAR LOS DATOS DE ESA PERSONA, A LA HORA DE MOSTRARLO 
    // LUEGO DEBEREMOS PONER UN DESPEGABLE QUE ELIJA EL ORDEN DEL CAMPO POR EL CUAL LO VAMOS A ORDENAR
    // SI ELIGE NOMBRE, LO ORDENAMOS LOS CAMPOS POR NOMBRE
    //a la hora de mostrar tiene que ir un select checkbox
    //Para seleccionar algún atributo, meter un boton borrar que borre 
    //las celdas seleccionadas.
    //Botón con una flecha y un textarea que se llame agendacontactos
    //y lo que hace el botón es meter los datos en el textarea

    function Mostrar($agenda)        //funcion que muestra el contenido de la agenda 
    {
        $agendaArra = explode(",", $agenda);  //Convertimos la cadena con los datos de la agenda en un Array

        echo "<table border='2'>";
        echo "<th></th><th>NIF</th><th>Nombre</th><th>Apellido1</th>";

        $i = 0;

        while ($i < count($agendaArra))      //Mientras haya elementos en la agenda
        {
            echo "<tr>";

            echo "<td><input type='checkbox' name='Confirmar'></td>";

            $ini = $i;

            for ($j = $ini; $j < ($ini + 3); $j++) {
                echo "<td>" . $agendaArra[$j] . "</td>";
                $i++;
            }

            echo "</tr>";
        }


        echo "</table>";
    }

    function InsertarAgenda($entrada, &$arraAgenda, $pos)
    {
        for ($i = 0; $i < count($entrada); $i++) {
            $arraAgenda[$pos + $i] = $entrada[$i];
        }
    }


    function BuscarNif($nif, $agenda)    //Retorna la posición de ese Dni en el array de agenda o -1 si no estaba
    {
        $pos = array_search($nif, $agenda);

        if ($pos === false) {
            $pos = -1;
        }

        return $pos;
    }


    $agenda = '';  //Suponemos que la agenda esta vacia

    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['Agenda']; //Recogemos el contenido del campo oculto agenda 
    }

    $orden = '';


    if (isset($_GET['Orden'])) {
        $orden = $_GET['Orden']; //Recogemos el campos de ordenacion
    }

    $tipo = '';


    if (isset($_GET['Tipo'])) {
        $tipo = $_GET['Tipo']; //Recogemos el campos de ordenacion
    }



    if (isset($_GET['Guardar']))    //Si hemos pulsado Guardar
    {

        $entrada = array();   //Array en el que vamos guardando los campos de ese nueva entrada de la agenda

        $entrada[] = $_GET['NIF'];
        $entrada[] = $_GET['Nombre'];
        $entrada[] = $_GET['Apellido1'];

        if ($agenda == "")     //Si la agenda esta vacia
        {
            $agenda .= $entrada[0] . "," . $entrada[1] . "," . $entrada[2];   //Concatenamos a la variable agenda el contenido de esos tres campos
        } else //La agenda contiene datos
        {

            $arraAgenda = explode(",", $agenda);  //Transformamos el string agenda en un Array

            $pos = BuscarNif($entrada[0], $arraAgenda);   //Buscamos la posición del NIF en la agenda

            if ($pos == -1)    //Si ese Dni no estaba en la agenda
            {
                $pos = count($arraAgenda);   //La posición a insertar sera al final del array


            }

            InsertarAgenda($entrada, $arraAgenda, $pos);  //Insertamos esa entrada en la posición pos

            $agenda = implode(",", $arraAgenda);   //Volvemos a convertir la agenda en un string

        }
    }


    ?>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <p>
            <label for='NIF'>NIF</label>
            <input type='text' name='NIF'>
        </p>

        <p>
            <label for='Nombre'>Nombre</label>
            <input type='text' name='Nombre'>
        </p>

        <p>
            <label for='Apellido1'>Apellido1</label>
            <input type='text' name='Apellido1'>
        </p>


        <input type='hidden' name='Agenda' value='<?php echo $agenda; ?>'>


        <p>
            <input type='submit' name='Guardar' value='Guardar'>
            <input type='submit' name='Mostrar' value='Mostrar'>
        </p>

        <p>
            <label for='Orden'>Orden</label>
            <select name='Orden'>
                <option value=''></option>
                <?php

                $campos = array('NIF', "Nombre", "Apellido1");

                foreach ($campos as $clave => $valor) {
                    echo " <option value='$clave' ";

                    if ($orden == $clave) {
                        echo " selected ";
                    }

                    echo  ">$valor</option>";
                }

                ?>

            </select>
        </p>


        <p>
            <label for='Tipo'>Tipo</label>
            <select name='Tipo'>
                <option value=''></option>
                <?php

                $campos = array();

                $campos[1] = "Ascendente";
                $campos[2] = "Descendente";


                foreach ($campos as $clave => $valor) {
                    echo " <option value='$clave' ";

                    if ($tipo == $clave) {
                        echo " selected ";
                    }

                    echo  ">$valor</option>";
                }

                ?>

            </select>

            <input type='submit' name='Ordenar' value='Ordenar'>

        </p>

        <p>
            <input type="submit" name="Borrar" value="Borrar">
        </p>


    </form>

    <?php

    if (isset($_GET['Ordenar']))    //Si hemos pulsado Guardar
    {

        if ($agenda != "")          //Si hay datos que mostrar en la agenda
        {

            $orden = $_GET['Orden'];   //Recogemos el campo de orden 0=>NIF,1=>Nombre, 2=>Apellido

            $agendaArra = explode(",", $agenda);  //Transformamos el string agenda en un Array

            $arraOrdenar = array();   // Array en el que volcamos los datos de la agenda para su ordenación
            //Su clave sera el campo por el que queremos ordenar y el valor el resto de campos de esa entrada
            $i = 0;

            while ($i < count($agendaArra))      //Mientras haya elementos en la agenda
            {
                $ini = $i;

                $entra = array();   //Array con los datos de esa entrada de la agenda

                for ($j = $ini; $j < ($ini + 3); $j++) {
                    $entra[] = $agendaArra[$j];

                    $i++;
                }

                $arraOrdenar[$agendaArra[$orden]] = $entra;   //Asigamos a esa entrada de array a ordenar su fila correspondiente

                $orden += 3;   //Para pasar al siguiente campos de ordenación

            }

            //Mostramos el contenidos del array a ordenar

            $agendaArra = array();

            if ($tipo == 1)     //Orden ascendente
            {
                ksort($arraOrdenar);
            } elseif ($tipo == 2)     //Orden descendente
            {
                krsort($arraOrdenar);
            }

            foreach ($arraOrdenar as $clave => $valor) {
                foreach ($valor as $clave2 => $valor2) {

                    $agendaArra[] = $valor2;
                }
            }

            $agenda = implode(",", $agendaArra);

            Mostrar($agenda);
        } else {
            echo "<b>Agenda vacia, no hay nada que ordenar</b>";
        }
    }

    if (isset($_GET['Mostrar']))    //Si hemos pulsado Guardar
    {

        if ($agenda != "")          //Si hay datos que mostrar en la agenda
        {
            Mostrar($agenda);    //Los mostramos en una tabla por pantalla

        }
    }

    if (isset($_GET['Borrar'])) {

        if ($agenda != "") {

            if (isset($_GET['Confrimar'])) {
                for ($i = 0; $i < count($agendaArra); $i++) {
                }
            }
        }
    }

    ?>

</body>

</html>