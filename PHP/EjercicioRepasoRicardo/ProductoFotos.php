<html>

<body>
    <?php

    require_once 'DaoFotosPro.php';
    require_once 'DaoProductos.php';

    $base = "tiendadao";

    $daoPro = new DaoProductos($base);

    $daoFotPro = new DaoFotosPro($base);



    $pro = "";

    if (isset($_POST['Producto'])) {
        $pro = $_POST['Producto'];
    }


    if (isset($_POST['Enviar'])) {
        $conte = "";

        if ($_FILES['Foto']['name'] != '') {
            $temp = $_FILES['Foto']['tmp_name'];

            $conte = base64_encode(file_get_contents($temp));

        }

        $IdFoto = $daoFotPro->ObtenerIdFoto($pro) + 1;

        $FotoPro = new FotosPro();

        $FotoPro->__set("IdPro", $pro);
        $FotoPro->__set("IdFoto", $IdFoto);
        $FotoPro->__set("Foto", $conte);

        $daoFotPro->insertar($FotoPro);

    }

    if (isset($_POST['Borrar']) && isset($_POST['Selec'])) {
        $selec = $_POST['Selec'];

        foreach ($selec as $clave => $valor) {
            $daoFotPro->borrar($pro, $clave);
        }


    }

    ?>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Fotos Productos</legend>

            <label for='Producto'>Producto</label>
            <select name='Producto'>
                <option value=""></option>

                <?php

                $daoPro->listar();

                foreach ($daoPro->productos as $producto) {
                    echo "<option value=" . $producto->__get('cod');

                    if ($pro == $producto->__get('cod')) {
                        echo " selected ";
                    }

                    echo ">" . $producto->__get('nombre') . "</option>";
                }


                ?>
            </select>
            Foto<input type='file' name='Foto'>
            <br>

            <input type='submit' name='Enviar' value='Enviar'>
            <input type='submit' name='Mostrar' value='Mostrar'>
            <input type='submit' name='Borrar' value='Borrar'>

            <?php

            if (isset($_POST['Mostrar'])) {


                $daoFotPro->listarPro($pro);

                echo "<table border='2'>";
                echo "<th>Selec</th><th>IdPro</th><th>NumFoto</th><th>Foto</th>";

                foreach ($daoFotPro->fotoPro as $fotopro) {
                    echo "<tr>";

                    echo "<td><input type='checkbox' name='Selec[" . $fotopro->__get("IdFoto") . "]' ></td>";

                    echo "<td>" . $fotopro->__get("IdPro") . "</td><td>" . $fotopro->__get("IdFoto") . "</td>";

                    $conte = $fotopro->__get("Foto");

                    echo "<td><img src='data:image/jpg;base64,$conte' width=70 height=70></td>";

                    echo "</tr>";
                }

                echo "</table>";
            }

            ?>




        </fieldset>
    </form>
</body>

</html>