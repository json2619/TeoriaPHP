<!DOCTYPE html>
<html>

<?php
require_once 'DaoProductos.php';
$base = "tiendadao";


$prod = new Producto();

$daoProd = new DaoProductos($base);

//Hallamos el primero de la tabla

$prod = $daoProd->obtenerPrimero();
$primero = $prod->__get("cod");

//Hallamos el último de la tabla

$prod = $daoProd->obtenerUltimo();
$ultimo = $prod->__get("cod");


$cod = '';

if (isset($_GET['cod']))   //Si hemos recibido un cod por la URL mostramos la fila de ese cod
{
    $cod = $_GET['cod'];

    $prod = $daoProd->obtener($cod);

} else {
    $prod = $daoProd->obtenerPrimero();
    $cod = $prod->__get("cod");
}

//Hallar el siguiente y anterior al cod$cod actual

$prod2 = $daoProd->obtenerSiguiente($cod);

if (!empty($prod2)) {
    $sig = $prod2->__get("cod");
} else {
    $sig = $cod;
}

$prod2 = $daoProd->obtenerAnterior($cod);

if (!empty($prod2)) {
    $ant = $prod2->__get("cod");
} else {
    $ant = $cod;
}

$nom = '';

if (isset($_POST['Nombre'])) {
    $nom = $_POST['Nombre'];
}

$fam = '';

if (isset($_POST['Fam'])) {
    $fam = $_POST['Fam'];
}

$pvp = '';

if (isset($_POST['PVP'])) {
    $pvp = $_POST['PVP'];
}

?>

<body>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Paginación de Productos</legend>

            <label for='Cod'>Código </label><input type='text' name='Cod' value='<?php echo $prod->__get("cod"); ?>'
                readonly><br>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'
                value='<?php echo $prod->__get("nombre"); ?>'><br>
            <label for='PVP'>PVP </label><input type='text' name='PVP' value='<?php echo $prod->__get("PVP"); ?>'><br>
            <label for='Fam'>Familia </label><input type='text' name='Fam' value=<?php echo $prod->__get("familia"); ?>><br>

            <a href='<?php echo $_SERVER['PHP_SELF'] . "?cod=$primero"; ?>'>
                << </a>&nbsp
                    <a href='<?php echo $_SERVER['PHP_SELF'] . "?cod=$ant"; ?>'>
                        < </a>&nbsp
                            <a href='<?php echo $_SERVER['PHP_SELF'] . "?cod=$sig"; ?>'> > </a>&nbsp
                            <a href='<?php echo $_SERVER['PHP_SELF'] . "?cod=$ultimo"; ?>'> >> </a>&nbsp

                            <p></p>

                            <input type='submit' name='Actualizar' value='Actualizar'>

        </fieldset>
    </form>
</body>

<?php

if (isset($_POST['Actualizar'])) {

    $cod = $_POST['Cod'];

    $prod->__set("cod", $cod);
    $prod->__set("nombre", $nom);
    $prod->__set("PVP", $pvp);
    $prod->__set("familia", $fam);

    $daoProd->actualizar($prod);
}

?>

</html>