<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar números</title>
</head>
<body>
    
<?php
/*Crear un pagina php que reciba por pantalla
un número de filas y de columnas y un campo de 
texto que se llame contenido
Los valores del num filas deben ser un desplegable.
*/

$fil='';
$colum='';

if (isset( $_GET['Filas']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $fil=$_GET['Filas'];  
    }

    if (isset( $_GET['Columnas']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $fil=$_GET['Columnas'];  
    }
?>

    <H1>Ejercicio 3:</H1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for="Filas">Indique el número de filas</label>
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

    <label for="Columnas">Indique número de columnas:</label>
    <select name="Columnas">
        <option value=""></option>
        <?php
            for ($i=1; $i <= 10 ; $i++) { 

                if ($i==$colum) {
                    echo "<option value='$i' selected>$i</option>";
                }
                else{
                    echo "<option value='$i'>$i</option>";
                }
                
            }
        ?>
    </select>

    <br>

    <input type="submit" name='Mostrar' value="Mostrar">

    </form>

<?php

    if (isset( $_GET['Mostrar']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $fil=$_GET['Filas'];
        $colum=$_GET['Columnas'];

        //Mostramos las tabla

        $cont = 1;
        echo "<table border='2' width='300' height='300'>";

        for($i= 1;$i<=$fil;$i++)
        {
            echo "<tr>";
    
            for($j= 1;$j<=$colum;$j++)
            {
                echo "<td>";
                echo "<table border='2' width='300' height='300'>";

                for($k= 1;$k<=$fil;$k++)
                {
                    echo "<tr>";
                    for($l= 1;$l<=$colum;$l++)
                    {
                        echo "<td>$cont</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                echo "</td>";

                $cont++;
            }
    
            echo "</tr>";
        }
    
        echo "</table>";
        

    }

?>
</body>
</html>