<html>

<?php

require_once 'DaoFotosProd.php';
require_once 'DaoProductos.php';
$carpeta = "Fotos";
$base = "fotosprodb";
$base2 = "tiendadao";

session_start();

$daoFotProd = new DaoFotosProd($base);
$daoProd = new DaoProductos($base2);


$pro = '';

if (isset($_POST['Producto'])) {
    $pro = $_POST['Producto'];
}

?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>

        <fieldset>
            <legend>Alta Fotos de Productos</legend>

            <label for='Producto'>Producto: </label>
            <select name='Producto'>
                <option value=''></option>

                <?php
                $daoProd->listar();

                foreach ($daoProd->productos as $producto) {
                    echo "<option value='" . $producto->__get("cod") . "'";

                    if ($pro == $producto->__get("cod")) {
                        echo "selected";
                    }
                    echo ">" . $producto->__get("nombre") . "</option>";
                }
                ?>

            </select>

            <p></p>

            <input type="file" name='Foto'>

            <p></p>


            <input type='submit' name='Enviar' value='Enviar'>
            <input type='submit' name='Mostrar' value='Mostrar'>

        </fieldset>
    </form>

    <?php

    if (isset($_POST['Enviar'])) {

        $logoConte = "";

        if ($_FILES['Foto']['tmp_name'] != "") {

            $nomTemp = $_FILES['Foto']['tmp_name'];

            $logoConte = file_get_contents($nomTemp); //Extraemos el contenido en una variable
    
            $logoConte = base64_encode($logoConte); // Codificamos el archivo en base_64 para evitar errores y mostrarlo de manera efectiva. 
        }



    }

    ?>

</body>




</html>