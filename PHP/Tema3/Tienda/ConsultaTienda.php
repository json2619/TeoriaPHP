<html>

<body>
    <?php

    //Creamos un objeto PDO para establecer la conexión
    
    require_once('DaoTiendas.php');
    require_once('DaoFamilia.php');
    require_once('DaoProductos.php');

    $db = "tiendadao";

    $tienda = '';

    if (isset($_POST['Tienda'])) {
        $tienda = $_POST['Tienda'];
    }

    $familia = '';

    if (isset($_POST['Familia'])) {
        $familia = $_POST['Familia'];
    }

    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>

        <fieldset>
            <legend><b>Mostrar los productos según tienda y familia</b></legend>

            <p>
                <label for='Tienda'>Tienda: </label>

                <select name='Tienda'>
                    <option value=""></option>

                    <?php

                    $daotien = new DaoTienda($db);

                    $daotien->listar();

                    foreach ($daotien->tiendas as $tien) {
                        echo "<option value=" . $tien->__get("cod");

                        if ($tienda == $tien->__get("cod")) {
                            echo " selected ";
                        }

                        echo ">" . $tien->__get("nombre") . "</option>";
                    }

                    ?>

                </select>
            </p>

            <p>
                <label for='Familia'>Familia: </label>

                <select name='Familia'>
                    <option value=""></option>

                    <?php

                    $daofam = new DaoFamilia($db);

                    $daofam->listar();

                    foreach ($daofam->familias as $fam) {
                        echo "<option value=" . $fam->__get("cod");

                        if ($familia == $fam->__get("cod")) {
                            echo " selected ";
                        }

                        echo ">" . $fam->__get("nombre") . "</option>";
                    }

                    ?>

                </select>
            </p>

            <input type='submit' name='Mostrar' value='Mostrar'>

        </fieldset>

        <?php

        if (isset($_POST['Mostrar'])) {

            echo "<fieldset><legend>Productos de la familia $familia</legend>";

            $daoProd = new DaoProducto($db);

            $daoProd->listarFamilia($familia, $tienda);

            echo "<table border='2'>";

            echo "<th>Cod</th><th>Nombre</th><th>Descripción</th><th>PVP</th><th>Familia</th>";

            foreach ($daoProd->productos as $prod) {
                echo "<tr>";

                echo "<td>" . $prod->__get("cod") . "</td>";
                echo "<td>" . $prod->__get("nombre") . "</td>";
                echo "<td>" . $prod->__get("descripcion") . "</td>";
                echo "<td>" . $prod->__get("PVP") . "</td>";
                echo "<td>" . $prod->__get("familia") . "</td>";

                echo "</tr>";
            }

            echo "</table>";

            echo "</fieldset>";
        }

        ?>

    </form>
</body>

</html>