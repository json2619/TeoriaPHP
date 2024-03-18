<html>

<body>
    <?php

    require_once 'libreria.php';

    $carpeta = "img";  //Carpeta donde se encuentran las imágenes
    

    $cols = 5;


    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Productos de estas Marcas</legend>


            <?php


            if ($cols != '') {
                //Comprobamos cuantes imágenes hay
            
                $consulta = "select count(*) as Total from Marcas";

                $filas = ConsultaDatos($consulta);

                $fila = $filas[0];

                $total = $fila['Total'];

                $fils = ceil(($total + 1) / $cols);

                $consulta = "select Id,Logo from Marcas";

                $filas = ConsultaDatos($consulta);

                $contImag = 0;   //contador de imagenes que mostramos
            
                echo "<table border='2'>";


                for ($i = 0; $i < $fils; $i++) {
                    echo "<tr>";

                    for ($j = 0; $j < $cols; $j++) {
                        if ($contImag < $total) {

                            echo "<td><a href='$_SERVER[PHP_SELF]?IdMarca=" . $filas[$contImag]['Id'] . "'>
                     <img src='$carpeta/" . $filas[$contImag]['Logo'] . "' width='80' height='80'>
                     </a> 
                     </td>";
                        } elseif ($contImag == $total) {
                            echo "<td><a href='$_SERVER[PHP_SELF]?IdMarca=0'>
                        <img src='$carpeta/Todos.png' width='80' height='80'>
                     </a>
                 </td>";

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
        </fieldset>


        <?php

        if (isset($_GET['IdMarca'])) {
            $idmarca = $_GET['IdMarca'];

            $consulta = "select * from Productos ";

            if ($idmarca != 0) {
                $consulta .= " where Marca=$idmarca ";
            }


            $filas = ConsultaDatos($consulta);


            echo "<table border='2'  width='400' height='300' >";
            echo "<th>Nombre</th><th>Precio</th><th>Modelo</th><th>Fotos</th>";

            foreach ($filas as $fila) {
                echo "<tr>";

                foreach ($fila as $clave => $valor) {
                    if (($clave != "Id") && ($clave != "Marca")) {
                        echo "<td>$valor</td>";
                    }

                }

                $consulta = "select Foto from FotosPro where IdPro=$fila[Id] ";  //Recuperamos los nombres de las fotos de ese producto
        
                $filas2 = ConsultaDatos($consulta);

                echo "<td>";

                foreach ($filas2 as $fil2) {
                    echo "<img src='Fotos/$fil2[Foto]' width='50' height='50'  >";


                }

                echo "</td>";

                echo "</tr>";
            }


            echo "</table>";
        }


        ?>


    </form>



</html>