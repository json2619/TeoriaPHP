<html>
<?php

require_once 'libreria.php';
require_once 'DaoClientes.php';
require_once 'DaoFamilia.php';
require_once 'DaoProductos.php';
require_once 'DaoPedidos.php';
require_once 'DaoDetPedidos.php';
require_once 'Pedido.php';

$db = "tiendadao";

$cli = '';

if (isset($_POST['Cliente'])) {
    $cli = $_POST['Cliente'];
}

$fam = '';

if (isset($_POST['Familia'])) {
    $fam = $_POST['Familia'];
}

$nom = '';

if (isset($_POST['Nombre'])) {
    $nom = $_POST['Nombre'];
}

$daoClien = new DaoCliente($db);
$daoFam = new DaoFamilia($db);
$daoPro = new DaoProducto($db);
$daoDetPed = new DaoDetPedido($db);

if (isset($_POST['Pedir']) && (isset($_POST['Select']))) {

    $daoPedido = new DAoPedido($db);

    $pedido = new Pedido();

    $fecha = time();

    $pedido->__set("Id", null);
    $pedido->__set("Cliente", $cli);
    $pedido->__set("Fecha", $fecha);

    $daoPedido->insertar($pedido);

    $pedido2 = $daoPedido->recuperarId($pedido->__get("Cliente"), $pedido->__get("Fecha"));

    $idPedido = $pedido2->__get("Id");

    $select = $_POST['Select'];

    $cantidades = $_POST['solicitado'];

    foreach ($select as $clave => $valor) {

        $detPedido = new DetPedido();

        $detPedido->__set("IdPro", $clave);
        $detPedido->__set("IdPed", $idPedido);
        $detPedido->__set("Cantidad", $cantidades[$clave]);

        $daoDetPed->insertar($detPedido);

    }

}


?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Seleccione cliente: </legend>
            <p>
                <label for='Cliente'>Cliente: </label>

                <select name='Cliente'>
                    <option value=""></option>

                    <?php

                    $daoClien->listar();

                    foreach ($daoClien->clientes as $cliente) {
                        echo "<option value=" . $cliente->__get("NIF");

                        if ($cli == $cliente->__get("NIF")) {
                            echo " selected ";
                        }

                        echo ">" . $cliente->__get("Apellido1") . " " . $cliente->__get("Apellido2") . ", " . $cliente->__get("Nombre") . "</option>";
                    }

                    ?>

                </select>
            </p>
        </fieldset>

        <fieldset>

            <legend>Buscar Producto: </legend>

            <p>
                <label for='Familia'>Familia: </label>

                <select name='Familia'>
                    <option value=""></option>

                    <?php

                    $daoFam->listar();

                    foreach ($daoFam->familias as $familia) {
                        echo "<option value=" . $familia->__get("cod");

                        if ($fam == $familia->__get("cod")) {
                            echo " selected ";
                        }

                        echo ">" . $familia->__get("nombre") . "</option>";
                    }

                    ?>

                </select>

                <b>(+)</b>

                <label for='Nombre'>Nombre:</label>
                <input type='text' name='Nombre' value='<?php echo $nom ?>'>
            </p>

            <p>
                <input type='submit' name='Buscar' value='Buscar'>
            </p>

        </fieldset>

        <?php

        if (isset($_POST['Buscar'])) {

            echo "<fieldset>";

            echo "<legend>Resultados de la búsqueda: </legend>";

            $daoPro->listarFamNom($fam, $nom);

            echo "<table border='2'>";
            echo "<th>Select</th><th>Nombre</th><th>Precio</th><th>Disponible</th><th>Pedidos</th>";

            foreach ($daoPro->productos as $producto) {
                echo "<tr>";

                echo "<td><input type='checkbox' name='Select[" . $producto->__get("cod") . "]'></td>";

                echo "<td>" . substr($producto->__get("nombre"), 0, 20) . "</td>";

                echo "<td>" . $producto->__get("PVP") . "</td>";

                echo "<td>" . $producto->__get("disponible") . "</td>";

                echo "<td><input type='number' name='solicitado[" . $producto->__get("cod") . "]'></td>";

                echo "</tr>";
            }

            echo "</table>";

            echo "<p>";

            echo "<input type='submit' name='Pedir' value='Pedir'>";

            echo "</p>";

            echo "</fieldset>";

        }
        ?>
    </form>
</body>

</html>