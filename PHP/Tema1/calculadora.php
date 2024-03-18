<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    
<?php
    $num1='';
    $num2='';
    $resultado='';

    if (isset( $_GET['Calcular']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $num1=$_GET['Numero1'];
        $num2=$_GET['Numero2'];
        $resultado=0;
        $operacion=$_GET['Operacion'];
        
        switch ($operacion) {
            case '1':
                $resultado = ($num1 + $num2);
                break;
            
            case '2':
                $resultado = ($num1 - $num2);
                break;

            case '3':
                $resultado = ($num1 * $num2);
                break;

            case '4':
                if ($num2 != 0) {
                    $resultado = ($num1 / $num2);
                } else {
                    echo "<b> Error no puedes dividir por 0 </b>";
                    $resultado="ERROR";
                }
                break;
        }
        
    }
?>

    <H1>Calcuadora</H1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for="Numero1">Indique el primer número:</label>
    <input type="number" name="Numero1" value='<?php echo $num1; ?>'>

    <br>

    <label for="Numero2">Indique el segundo número:</label>
    <input type="number" name="Numero2" value='<?php echo $num2; ?>'>

    <br>

    <label for="Operacion" >Elija una operación:</label>
    <select name="Operacion">
        <option value=""></option>
        <option value="1">suma</option>
        <option value="2">resta</option>
        <option value="3">multiplicación</option>
        <option value="4">división</option>
    </select>

    <br>

    <label for="Resulatdo">Resultado</label>
    <input type="text" name="Resultado" value='<?php echo $resultado; ?>'>

    <br>

    <input type="submit" name='Calcular' value="Calcular">

    </form>

    
</body>
</html>