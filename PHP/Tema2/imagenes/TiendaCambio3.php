<html>

<body>
    <?php

    require_once 'libreria.php';

    $carpetaLogos = "img";  //Carpeta donde se encuentran las imágenesde los logos
    $carpetaProd = "Fotos";  //Carpeta donde se encuentran las imágenesde los logos
    
    function BorrarMarca($IdMarca)
    {
        global $carpetaLogos;

        //Recuperamos el nombre del archivo de imagen
    
        $consulta = "select Logo from Marcas where Id=$IdMarca";

        $filas = ConsultaDatos($consulta);

        $fila = $filas[0];  //Solo devolveria una fila
    
        $Logo = $fila['Logo'];  //Obtenemos el logo
    
        unlink("$carpetaLogos/$Logo");  //Eliminamos el archivo de imagen del logo
    
        $consulta = "Delete from Marcas where Id=$IdMarca ";   //Eliminamos la fila de esa marca de la tabla Marcas
    
        ConsultaSimple($consulta);

    }

    function BorrarProductos($IdMarca)
    {
        global $carpetaProd;

        $consulta = "SELECT f.Foto,f.IdPro,f.IdFoto 
               FROM Productos p, FotosPro f  
               where p.Id=f.IdPro and p.Marca=$IdMarca";

        $filas = ConsultaDatos($consulta);   //Obtenemos los nombres de las fotos para los productos de esa marca
    
        foreach ($filas as $fila) {

            $consulta = "Delete from FotosPro where IdPro=$fila[IdPro] and IdFoto=$fila[IdFoto] ";

            ConsultaSimple($consulta);  //Eliminamos esa foto de la tabla FotosPro
    
            unlink("$carpetaProd/$fila[Foto]"); //Eliminamos la foto con ese nombre de la carpeta Fotos
    

        }

        $consulta = "Delete from Productos where Marca=$IdMarca ";

        ConsultaSimple($consulta);

    }






    $cols = 5;






    if (isset($_POST['Marcas']))   //Si hemos checkeado alguna/s marca a borrar
    {
        $marcas = $_POST['Marcas'];   //Recogemos los checkbox de las marcas a borrar 
    
        foreach ($marcas as $clave => $valor) {
            BorrarMarca($clave);       //Elimina una marca 
            BorrarProductos($clave);    //Elimina los productos de esa marca
    
        }

    }


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

                $fils = ceil($total / $cols);

                $consulta = "select Id,Logo from Marcas";

                $filas = ConsultaDatos($consulta);

                $contImag = 0;   //contador de imagenes que mostramos
            
                echo "<table border='2'>";


                for ($i = 0; $i < $fils; $i++) {
                    echo "<tr>";

                    for ($j = 0; $j < $cols; $j++) {
                        if ($contImag < $total) {

                            echo "<td><a href='$_SERVER[PHP_SELF]?IdMarca=" . $filas[$contImag]['Id'] . "'><img src='$carpetaLogos/" . $filas[$contImag]['Logo'] . "' width='80' height='80'></a>
                     &nbsp&nbsp
                     <input type='checkbox' name='Marcas[" . $filas[$contImag]['Id'] . "]'> 
                     </td>";
                        } else {
                            echo "<td>&nbsp</td>";
                        }

                        $contImag++;

                    }
                    echo "</tr>";
                }


                echo "</table>";

                echo "<input type='submit' name='Borrar' value='Borrar'>";
            }

            ?>
        </fieldset>


        <?php

        if (isset($_GET['IdMarca'])) {
            $idmarca = $_GET['IdMarca'];

            $consulta = "select * from Productos where Marca=$idmarca ";

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