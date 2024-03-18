<html>

<body>
    <?php

    //Creamos un objeto PDO para establecer la conexión
    
    require_once('DaoTiendas.php');
    require_once('DaoProductos.php');
    require_once('DaoFamilia.php');
    require_once('DaoStock.php');

    $db = "tiendadao";

    function formAlta($cod)
    {
        global $db;
        global $familia;

        echo "<fieldset><legend>Añada todos los datos del producto para darle de alta</legend>";

        echo "<p></p><label for='cod'>Código Producto: </label>
        <input type='text' name='cod' value='$cod' readonly='readonly'></p>";

        echo "<p></p><label for='nombre'>nombre: </label>
        <input type='text' name='nombre'></p>";

        echo "<p></p><label for='descripcion'>Descripción del Producto: </label>
        <textarea name='descripcion' rows='3' cols='15'></textarea></p>";

        echo "<p></p><label for='PVP:'>Precio venta al público: </label>
        <input type='text' name='PVP'></p>";

        echo "<p>";
        echo "<label for='familia'>Familia: </label>";

        echo "<select name='familia'>";
        echo "<option value=''></option>";

        $daofam = new DaoFamilia($db);

        $daofam->listar();

        foreach ($daofam->familias as $fam) {
            echo "<option value=" . $fam->__get("cod");

            if ($familia == $fam->__get("cod")) {
                echo " selected ";
            }

            echo ">" . $fam->__get("nombre") . "</option>";
        }

        echo "</select>";
        echo "</p>";

        echo "<label for='Foto'>Foto producto:</label>
            <input type='file' name='Foto'>";
        echo "<p></p>";

        echo "<input type='submit' name='Alta' value='Alta'>";

        echo "</fieldset>";

    }

    function formStock($cod)
    {
        global $db;
        global $tienda;

        echo "<fieldset><legend>Seleccione la tienda y la cantidad para ese producto</legend>";

        echo "<label for='cod'>Código Producto: </label><input type='text' name='cod' value='$cod' readonly='readonly'><p></p>";

        echo "<label for='tienda'>Tienda: </label><select name='tienda' >";
        echo "<option value=''></option>";

        $daoTien = new DaoTienda($db);

        $daoTien->listar();

        foreach ($daoTien->tiendas as $tien) {
            echo "<option value=" . $tien->__get("cod");

            if ($tienda == $tien->__get("cod")) {
                echo " selected ";
            }

            echo ">" . $tien->__get("nombre") . "</option>";
        }

        echo "</select> <p></p>";

        echo "<label for='cantidad'>Cantidad: </label> <input type='number' name='cantidad' value=''><p></p>";


        echo "<input type='submit' name='Stock' value='Almacenar'>";

        echo "</fieldset>";
    }

    if (isset($_POST['Alta'])) {
        $cod = $_POST['cod'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $PVP = $_POST['PVP'];
        $familia = $_POST['familia'];

        $conte = "";

        if ($_FILES['Foto']['name'] != "") {
            $temp = $_FILES['Foto']['tmp_name'];
            $conte = base64_encode(file_get_contents($temp));
        }


        $pro = new Producto();

        $pro->__set("cod", $cod);
        $pro->__set("nombre", $nombre);
        $pro->__set("descripcion", $descripcion);
        $pro->__set("PVP", $PVP);
        $pro->__set("familia", $familia);
        $pro->__set("Foto", $conte);

        $daoProd = new DaoProducto($db);

        $daoProd->insertar($pro);
    }

    if (isset($_POST['Stock']))    //Si hay que registrar el producto en la tabla Stock
    {
        $cod = $_POST['cod'];
        $tienda = $_POST['tienda'];
        $cantidad = $_POST['cantidad'];

        $sto = new Stock();

        $sto->__set("producto", $cod);
        $sto->__set("tienda", $tienda);
        $sto->__set("unidades", $cantidad);

        $daoStock = new DaoStocks($db);

        $daoStock->insertar($sto);

    }

    $tienda = '';

    if (isset($_POST['Tienda'])) {
        $tienda = $_POST['Tienda'];
    }

    $cod = '';

    if (isset($_POST['CodPro'])) {
        $cod = $_POST['CodPro'];
    }

    if (isset($_POST['cod'])) {
        $cod = $_POST['cod'];
    }

    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>

        <fieldset>
            <legend><b>Introduzca el código del producto al almacén</b></legend>

            <p>
                <label for='CodPro'>Código Producto: </label>
                <input type="text" name='CodPro'>
            </p>

            <input type='submit' name='Comprobar' value='Comprobar'>

            <p></p>

            <?php

            if (isset($_POST['Comprobar'])) {

                $daoProd = new DaoProducto($db);

                $producto = $daoProd->obtener($cod);

                if ($producto == null) {

                    formAlta($cod);

                } else {
                    formStock($cod);
                }

            }

            ?>
        </fieldset>

    </form>
</body>

</html>