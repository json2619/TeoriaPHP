<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar números</title>
</head>
<body>

    <H1>Ejercicio 2:</H1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for="Celdas">Indique el número de celdas:</label>
    <select name="Celdas">
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

    <label for="Formato">Indique el formato de presentación:</label>
    <select name="Formato">
        <option value=""></option>
        <option value="1">filas</option>
        <option value="2">columnas</option>
        
    </select>

    <br>

    <label for="Contenido">Indique el contenido que tendrá la tabla:</label>
    <input type="text" name="Contenido">

    <br>

    <input type="submit" name='Mostrar' value="Mostrar">

    </form>

<?php

    if (isset( $_GET['Mostrar']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $celd=$_GET['Celdas'];
        $format=$_GET['Formato'];
        $conte=$_GET['Contenido'];

        //Mostramos las tabla

        if ($format==1) { //Me piden mostrarlo en varias filas
            $fil=$celd;
            $colum=1;
        }

        if ($format==2) { //Me piden mostrarlo en varias filas
            $colum=$celd;
            $fil=1;
        }

        echo "<table border='2' width='300' height='300'>";

        for($i= 0;$i<$fil;$i++)
        {
            echo "<tr>";
    
            for($j= 0;$j<$colum;$j++)
            {
                echo "<td>$conte</td>";
            }
    
            echo "</tr>";
        }
    
        echo "</table>";
        
    }

?>
</body>
</html>