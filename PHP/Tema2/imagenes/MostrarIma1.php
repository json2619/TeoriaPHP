<html>

<body>
    <?php

    require_once 'libreria.php';

    $carpeta = "imagenes";  //Carpeta donde se encuentran las imágenes
    

    $cols = '';

    if (isset($_POST['Cols'])) {
        $cols = $_POST['Cols'];
    }



    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Alta de Marcas</legend>

            <label for='Cols'>Columnas </label>
            <select name='Cols' onChange='document.f1.submit()'>
                <option></option>

                <?php

                for ($i = 1; $i < 11; $i++) {
                    echo "<option value='$i' ";

                    if ($i == $cols) {
                        echo " selected ";
                    }

                    echo ">$i</option>";

                }

                ?>

            </select>

    </form>


    </fieldset>

    <?php

    if ($cols != '') {
        //Comprobamos cuantes imágenes hay
    
        $consulta = "select count(*) as Total from Marcas";

        $filas = ConsultaDatos($consulta);

        $fila = $filas[0];

        $total = $fila['Total'];

        $fils = ceil($total / $cols);

        $consulta = "select Logo from Marcas";

        $filas = ConsultaDatos($consulta);

        $contImag = 0;   //contador de imagenes que mostramos
    
        echo "<table border='2'>";


        for ($i = 0; $i < $fils; $i++) {
            echo "<tr>";

            for ($j = 0; $j < $cols; $j++) {
                if ($contImag < $total) {
                    echo "<td><img src='$carpeta/" . $filas[$contImag]['Logo'] . "' width='80' height='80'></td>";
                } else {
                    echo "<td>&nbsp</td>";
                }

                $contImag++;

            }
            echo "</tr>";
        }


        echo "</table>";


    }

    ?>






</html>