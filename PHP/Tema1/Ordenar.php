<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar números</title>
</head>
<body>
    
<?php
/* Programa que me pida tres números en tres campos de un formulario y 
luego un desplegable con los valores ascendente o descendente y un botón ordenar
*/

    $num1='';
    $num2='';
    $num3='';
    $resultado='';

    if (isset( $_GET['Ordenar']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $num1=$_GET['Numero1'];
        $num2=$_GET['Numero2'];
        $num3=$_GET['Numero3'];

        $condicion1 = ($num1 >= $num2) && ($num1>=$num3);
        $condicion2 = ($num2 >= $num1) && ($num2>=$num3);
        $condicion3= ($num3 >= $num1) && ($num3>=$num2);
        $condicion4= ($num2>=$num3);
        $condicion5= ($num1>=$num3);
        $condicion6= ($num1>=$num2);

        $resultado='';
        $ordenar=$_GET['Comp'];
        
        switch ($ordenar) {
            case '1':
                if ($condicion1) {
                    if ($condicion4) {
                        $resultado= "$num3 $num2 $num1";
                    }else{
                        $resultado= "$num2 $num3 $num1";
                    }
                } elseif ($condicion2) {
                    if ($condicion5) {
                        $resultado= "$num3 $num1 $num2";
                    }else{
                        $resultado= "$num1 $num3 $num2";
                    }
                } elseif ($condicion3) {
                    if ($condicion6) {
                        $resultado= "$num2 $num1 $num3";
                    }else{
                        $resultado= "$num1 $num2 $num3";
                    }
                } 
                
                break;

                case '2':
                    if ($condicion1) {
                        if ($condicion4) {
                            $resultado= "$num1 $num2 $num3";
                        }else{
                            $resultado= "$num1 $num3 $num2";
                        }
                    } elseif ($condicion2) {
                        if ($condicion5) {
                            $resultado= "$num2 $num1 $num3";
                        }else{
                            $resultado= "$num2 $num3 $num1";
                        }
                    } elseif ($condicion3) {
                        if ($condicion6) {
                            $resultado= "$num3 $num1 $num2";
                        }else{
                            $resultado= "$num3 $num2 $num1";
                        }
                    } 
                    
                    break;
        }
        
    }
?>

    <H1>Ordenar números</H1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for="Numero1">Indique el primer número:</label>
    <input type="number" name="Numero1" value='<?php echo $num1; ?>'>

    <br>

    <label for="Numero2">Indique el segundo número:</label>
    <input type="number" name="Numero2" value='<?php echo $num2; ?>'>

    <br>

    <label for="Numero3">Indique el tercer número:</label>
    <input type="number" name="Numero3" value='<?php echo $num3; ?>'>

    <br>

    <label for="Comp" >Elija la forma de comparar:</label>
    <select name="Comp">
        <option value=""></option>
        <option value="1">ascendente</option>
        <option value="2">descendente</option>
    </select>

    <br>

    <label for="Resulatdo">Resultado</label>
    <input type="text" name="Resultado" value='<?php echo $resultado; ?>'>

    <br>

    <input type="submit" name='Ordenar' value="Ordenar">

    </form>

    
</body>
</html>