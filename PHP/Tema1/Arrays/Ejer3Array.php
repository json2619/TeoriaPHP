<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar números</title>
</head>

<body>

<?php
/*mostrar el array en un fieldlist
desplegable con ordenar por clave o por valor
checkbox claves quiero tener las claves originales
button ordenar
*/
$num = '';

if (isset($_GET['Numeros'])) {
    $num = $_GET['Numeros'];
}

$orden = '';

if (isset($_GET['Tipo'])) {
    $orden = $_GET['Tipo'];
}

?>

    <H1>Ejercicio 3:</H1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <label for="Numeros">Indique el número de elementos</label>
        <select name="Numeros">
            <option value=""></option>
            <?php
            for ($i = 5; $i < 16; $i++) {

                if ($i == $num) {
                    echo "<option value='$i' selected>$i</option>";
                } else {
                    echo "<option value='$i'>$i</option>";
                }
            }
            ?>
        </select>

        <p></p>

        <input type="submit" name='Mostrar' value="Array nuevo">

        <p></p>

    <?php

function mostrar(&$numeros)
{
    foreach ($numeros as $key => $value) {
        echo "[$value], ";
    }
}

function rellenar(&$numeros, $nums)
{
    for ($i = 0; $i < $nums; $i++) {
        $numeros[$i] = rand(1, 30);
    }
}

    if ( (isset($_GET['Mostrar'])) ||  ( isset($_GET['Ordenar'])))  // Si pulso el botón enviar
    {

        $elementos= array();

        // Recogemos los datos del nombre
        $nums = $_GET['Numeros'];

        if (isset($_GET['Mostrar'])) { //Tenemos que rellenar el array con nuevo números
            
            rellenar($elementos, $nums);

        }else { // Le he mos dado a ordenar

            $arrayAnterior = $_GET['ArrayAnterior'];

            $elementos = explode(",", $arrayAnterior); // volvemos a guardar en numeros sus datos anteriores

        }

        echo "<fieldset>";

        mostrar($elementos);

        echo "<p></p>";

        echo "<label for='Tipo'>Indique el tipo de ordenación:</label>";
        echo "<select name='Tipo'>";
        echo "<option value=''></option>";
        
        $ordenTipo = array (1=>'Ascendente', 2=>'Descendente');

        foreach ($ordenTipo as $key => $value) {

            if ($key == $orden) {
                echo "<option value='$key' selected>$value</option>";
            } else {
                echo "<option value='$key'>$value</option>";
            }

        }

        echo "</select>";

        $anterior=implode(",",$elementos); //Convertimos el array de números en cadena
        
        echo "<p></p>";

        echo "<input type='hidden' name='ArrayAnterior' value='$anterior'>";

        echo "<p></p>";

        echo "<input type='submit' name='Ordenar' value='Ordenar Array'>";

        echo "<p></p>";

        if (isset($_GET['Ordenar'])) {

            $tipo = $_GET['Tipo'];

            if ($tipo == 1) {
                sort($elementos);
            }else {
                rsort($elementos);
            }

            echo "<p>El array ordenado es: </p>";

            mostrar($elementos);
        }

        echo "</fieldset>";
    }
    ?>

</form>
</body>

</html>