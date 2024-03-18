<html>

<body>
    <?php

    require_once 'libreria2.php';

    if (isset($_POST['Actualizar']) && isset($_POST['Marcas'])) {
        $marcas = $_POST['Marcas']; //Recogemos los checkbox marcados
    
        foreach ($marcas as $clave => $valor) {
            if (isset($_FILES['LogoN']['tmp_name'][$clave]) != "") {

                $temp = $_FILES['LogoN']['tmp_name'][$clave];

                $conte = file_get_contents($temp);

                $conte = base64_encode($conte);

                $consulta = "update Marcas set Logo='$conte' where Id=$clave";

                ConsultaSimple($consulta);

            } else {
                echo "<b>Error, ha marcado el checkbox con id $clave sin seleccionar archivo de imagen</b>";
            }
        }
    }

    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Actualización de imagen de marca</legend>

            <input type='submit' name='Actualizar'>
            <?php

            //Comprobamos cuantes imágenes hay
            
            $consulta = "select * from Marcas";

            $filas = ConsultaDatos($consulta);

            echo "<table border='2'>";

            echo "<th>Selec</th><th>Nombre</th><th>Logo Act</th><th>Logo Nuevo</th>";

            foreach ($filas as $fila) {
                echo "<tr>";

                echo "<td><input type='checkbox' name=Marcas[" . $fila['Id'] . "]></td>";

                echo "<td>$fila[Nombre]</td>";

                $conte = $fila['Logo'];

                echo "<td><img src='data:image/jpg;base64,$conte' width='80' height='80'></td>";

                echo "<td><input type='file' name=LogoN[" . $fila['Id'] . "]></td>";

                echo "</tr>";
            }

            echo "</table>";

            ?>

    </form>


    </fieldset>


</html>