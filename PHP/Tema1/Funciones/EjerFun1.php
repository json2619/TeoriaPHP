<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
/* Página que pida un número de una dimensión de una tabla,
con un desplegable que tenga par, impar o primo,
las que sean par en cada celda par hay que meter una tabla de su tamaño
y las otras pintarlas de negro.
*/
?>
<H1>Ejercicio 1 Funciones:</H1>

<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

<label for="Filas">Indique el tamaño de la tabla</label>
<select name="Filas">
    <option value=""></option>
    <?php
        for ($i=1; $i <= 10 ; $i++) { 

            if ($i==$fil) {
                echo "<option value='$i' selected>$i</option>";
            }
            else{
                echo "<option value='$i'>$i</option>";
            }
            
        }
    ?>
</select>
<br>

<label for="Relleno">Indique como se quiere la tabla:</label>
<select name="Relleno">
    <option value=""></option>
    <option value="1">Par</option>
    <option value="2">Impar</option>
    <option value="3">Primo</option>
</select>

<br>

<input type="submit" name='Mostrar' value="Mostrar">

<?php

function tabla ($tam, $conte){
    echo "<table border='2'>";
    for ($i=0; $i < $tam; $i++) { 
        echo "<tr>";

        for ($i=0; $i < $conte; $i++) { 
            echo "<td>$conte</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}

function EsPrimo ($num){
    $numPrimo = false;

    if ($num == 1) {
        $numPrimo = true;
    }

    while (!$numPrimo) {
        $i = 2;
        $ini = $num;

        while(($i < $ini) && ($ini%$i!=0)){
            $i++;
        }

        if ($i == $ini) {
            $numPrimo = true;
        }
    }

    return $numPrimo;
}


?>

<?php
if (isset( $_GET['Mostrar']) )  // Si pulso el botón enviar
{
    $numRecogido = $_GET['Filas'];
    $contenido = $_GET['Relleno'];
    $cont = 1;

    echo "<table border='2' width='300' height='300'> ";
    for ($i=0; $i < $numRecogido; $i++) { 
        echo "<tr>";

        for ($j=0; $j < $contenido; $j++) { 
            if (($contenido == 1) && ($cont%2==0)) { // Si hemos seleccionado mostrar en pares y la celda no lo es
                echo "<td>";
                    tabla($cont, $cont);
                echo "</td>";
            } else {
                echo "<td bgcolor='black'>&nbsp</td>";
            }

        }

        echo "</tr>";
    }

    echo "</table>";
}

function Par(){
    $a = 1;
    $cont = 0;
    $div = '';
    $numRecogido = $_GET['Filas'];
    while ($a <= 10 && $cont < 2) {
        $div = $numRecogido % 2; 
            if ($div == 0) {
                $cont++;
            }
        $a++;
    }
}

?>
</form>
</body>
</html>