<html>

<body>
    <?php

    //Creamos un objeto PDO para establecer la conexión
    
    require_once('libreria.php');

    $db = new DB("Tema2Blobs");

    function SigIdFoto($IdPro)   //Función que nos indica cual es el siguiente IdFoto para ese producto
    {
        global $db;

        $consulta = "SELECT max(IdFoto) as UltId FROM fotosprodb Where IdPro=:IdPro";

        $param = array(":IdPro" => $IdPro);

        $db->consultaDatos($consulta, $param);

        $fila = $db->filas[0];

        $IdFotS = $fila['UltId'] + 1;

        return $IdFotS;

    }


    $pro = "";

    if (isset($_POST['Producto'])) {
        $pro = $_POST['Producto'];
    }


    if (isset($_POST['Guardar'])) {
        if ($_FILES['NuevaF']['name'] != "")   //
        {
            $conte = file_get_contents($_FILES['NuevaF']['tmp_name']);

            $conte = base64_encode($conte);

            $IdFoto = SigIdFoto($pro);  //funcion devuelve el Id de la última foto para ese producto
    

            $consulta = "insert into fotosprodb values(:IdPro,:IdFoto,:Foto)";

            $param = array(":IdPro" => $pro, ":IdFoto" => $IdFoto, ":Foto" => $conte);

            $db->ConsultaSimple($consulta, $param);

        }

    }

    if (isset($_POST['Borrar'])) {

        if (isset($_POST['Fotones'])) {

            $fotones = $_POST['Fotones'];

            foreach ($fotones as $key => $value) {
                $consulta = "delete from fotosprodb where IdPro=:IdPro and IdFoto=:IdFoto";

                $param = array(":IdPro" => $pro, ":IdFoto" => $key);

                $db->ConsultaSimple($consulta, $param);
            }
        }

    }

    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>

        <fieldset>
            <legend><b>Marcas con las que vamos a trabajar</b></legend>

            <label for='Producto'>Producto</label>

            <?php

            $param = array();

            $consulta = "select * from marcas";

            $db->consultaDatos($consulta, $param);

            $cols = 5; //Columnas por defecto
            
            $numFotos = count($db->filas);

            $filas = ceil($numFotos / $cols); // Calculamos el número de filas
            
            $contFot = 0; // Contador para sabes la foto que estamos mostrando
            
            echo "<table>";

            for ($i = 0; $i < $filas; $i++) {
                echo "<tr>";

                for ($j = 0; $j < $cols; $j++) {

                    echo "<td>";

                    echo "<img src='data:image/jpg;base64," . $db->filas[$contFot]['Foto'] . "' width=70 height=70>";

                    echo $db->filas[$contFot]['Nombre'];

                    echo "<input type='checkbox' name='Marcas[" . $db->filas[$contFot]['Id'] . "]'> ";

                    echo "</td>";

                    $contFot++;

                }

                echo "</tr>";
            }


            echo "</table>";

            ?>

            </select>
            <br>

            <input type='submit' name='Mostrar' value='Mostrar'>

        </fieldset>

        <?php

        if (isset($_POST['Mostrar'])) {
            echo "<fieldset><legend><b>Imagenes del producto seleccionado</b></legend>";

            $consulta = "select IdFoto,Foto from fotosprodb where IdPro=:IdPro";

            $param = array(":IdPro" => $pro);

            $db->consultaDatos($consulta, $param);

            $numfotos = count($db->filas);

            echo "<table>";
            echo "<tr>";

            for ($i = 0; $i < $numfotos; $i++) {
                echo "<td align='center'><a href='$_SERVER[PHP_SELF]?IdFoto=" . $db->filas[$i]['IdFoto'] . "'><img src='data:image/jpg;base64," . $db->filas[$i]['Foto'] . "' width=70 height=70></a>
                     <br>
                     <input type='checkbox' name='Fotones[" . $db->filas[$i]['IdFoto'] . "]'> 
                     </td>";
            }

            echo "</tr>";

            echo "<tr>";
            echo "<td></td><input type='submit' name='Borrar' value='Borrar Foto'></td>";
            echo "</tr>";

            echo "</table>";
            echo "<br>";

            echo "<input type='file' name='NuevaF' value='Nueva Foto'><br>";

            echo "<input type='submit' name='Guardar' value='Añadir Foto'><br>";

            echo "<input type='submit' name='Borrar' value='Borrar Foto'><br>";

            echo "</fieldset>";
        }

        ?>




    </form>
</body>

</html>