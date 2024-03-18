<html>

<?php

require_once 'Producto.php';

session_start();

$id = '';

if (isset($_POST['Id'])) {
    $id = $_POST['Id'];
}

$marca = '';

if (isset($_POST['Marca'])) {
    $marca = $_POST['Marca'];
}

$modelo = '';

if (isset($_POST['Modelo'])) {
    $modelo = $_POST['Modelo'];
}

$precio = '';

if (isset($_POST['Precio'])) {
    $precio = $_POST['Precio'];
}


?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>

        <fieldset>
            <legend>Entrada de Productos</legend>

            <label for='Id'>ID: </label><input type='text' name='Id' value='<?php echo $id; ?>'>
            <p></p>
            <label for='Marca'>Marca: </label><input type='text' name='Marca' value='<?php echo $marca; ?>'>
            <p></p>
            <label for='Modelo'>Modelo </label><input type='text' name='Modelo' value='<?php echo $modelo; ?>'>
            <p></p>
            <label for='Precio'>Precio </label><input type='text' name='Precio' value='<?php echo $precio; ?>'>
            <p></p>

            <input type='submit' name='Alta' value='Alta'>
            <input type='submit' name='Mostrar' value='Mostrar'>
            <input type='submit' name='Buscar' value='Buscar'>
            <input type='submit' name='Borrar' value='Borrar'>
            <input type='submit' name='Vaciar' value='Vaciar'>

            <p></p>

            <?php

            $deletes = '';
            if (isset($_POST['Deletes'])) {
                $deletes = $_POST['Deletes'];
            }


            if (isset($_POST['Alta'])) {

                $prod = new Producto();

                $prod->__set("Id", $id);
                $prod->__set("Marca", $marca);
                $prod->__set("Modelo", $modelo);
                $prod->__set("Precio", $precio);

                if (isset($_SESSION['Producto'][$id])) {
                    $prod = $_SESSION['Producto'][$id];
                    $prod->__set("Cantidad", ($prod->__get("Cantidad") + 1));
                } else {
                    $prod->__set("Cantidad", 1);
                    $_SESSION['Producto'][$prod->__get("Id")] = $prod;
                }
            }


            if (isset($_POST['Mostrar'])) {
                echo "<b>---Contenido de la sesion---</b><br>";

                echo "<fieldset>";
                echo "<form name='f2' method='post' action='$_SERVER[PHP_SELF]'>";

                echo "<table border='2'>";

                echo "<th>Select</th><th><a href=''>Id</a></th><th><a href=''>Marca</a></th><th><a href=''>Modelo</a></th><th><a href=''>Precio</a></th><th><a href='AltaProdSesiones.php'>Cantidad</a></th>";

                foreach ($_SESSION['Producto'] as $clave => $valor) {


                    echo "<tr>";

                    echo "<td><input type='checkbox' name='Deletes[" . $clave . "]'></td>";

                    echo "<td>" . $clave . "</td>";

                    echo "<td>" . $valor->__get("Marca") . "</td>";
                    echo "<td>" . $valor->__get("Modelo") . "</td>";
                    echo "<td>" . $valor->__get("Precio") . "</td>";
                    echo "<td>" . $valor->__get("Cantidad") . "</td>";

                    echo "</tr>";
                }

                echo "</table>";

                echo "</form>";

                echo "</fieldset>";
            }


            if (isset($_POST['Buscar'])) {


                $condicion1 = false;

                $condicion2 = false;

                $condicion3 = false;

                $condicion4 = false;

                $expresion = false;

                echo "<b>---Búsqueda de la sesión---</b><br>";

                echo "<fieldset>";

                echo "<table border='2'>";

                echo "<th>Id</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Cantidad</th>";

                foreach ($_SESSION['Producto'] as $clave => $valor) {

                    if ($id != '') {
                        $condicion1 = $id == $clave;
                    }

                    if ($marca != '') {
                        $condicion2 = $marca == $valor->__get("Marca");
                    }

                    if ($modelo != '') {
                        $condicion3 = $modelo == $valor->__get("Modelo");
                    }

                    if ($precio != '') {
                        $condicion4 = $precio == $valor->__get("Precio");
                    }

                    if ($condicion1) {
                        echo "<tr>";

                        echo "<td>" . $clave . "</td>";

                        echo "<td>" . $valor->__get("Marca") . "</td>";

                        echo "<td>" . $valor->__get("Modelo") . "</td>";

                        echo "<td>" . $valor->__get("Precio") . "</td>";

                        echo "<td>" . $valor->__get("Cantidad") . "</td>";

                        echo "</tr>";
                    }
                }

                echo "</table>";
                echo "</fieldset>";

            }

            if (isset($_POST['Borrar']) && isset($_POST['Deletes'])) {
                $deletes = $_POST['Deletes'];

                foreach ($deletes as $key => $value) {

                    unset($_SESSION['Producto'][$key]);
                }
                header("Location: AltaProdSesiones.php");
            }

            if (isset($_POST['Vaciar'])) {

                foreach ($_SESSION['Producto'] as $clave => $valor) {
                    unset($_SESSION['Producto'][$clave]);
                }

                header("Location: AltaProdSesiones.php");
            }

            ?>

        </fieldset>


    </form>


</body>




</html>