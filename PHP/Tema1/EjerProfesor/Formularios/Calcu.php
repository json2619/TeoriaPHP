<html>

<title>Mini Calculadora</title>
<body>

<?php 

$resul='';

$num1='';
$num2='';

if (isset( $_GET['Calcular'] )  )      //Si Pulso el botón calcular
{
    //Recogemos los datos 

    $num1=$_GET['Num1'];
    $num2=$_GET['Num2'];

    $ope=$_GET['Operacion'];
    
    
    
    switch ($ope)
    {
        case 1: $resul=($num1+$num2);
                break;  
        case 2: $resul=($num1-$num2);
                break;
        case 3: $resul=($num1*$num2);
                break;
        case 4: 
                 if ($num2!=0)
                 {  $resul=($num1/$num2) ; }
                 else 
        ;         {
                    echo "<B>ERROR, no se puede dividir por 0</b>"; 
                    $resul="ERROR";
                 }
    }
    
    

}

?>



<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

  <label for='Num1'>Numero 1</label><input type='number' name='Num1' value='<?php echo $num1;   ?>'>
  
   <label for='Operacion'>Operacion</label>
    <select name='Operacion' >        
          <option value=''></option>
          <option value='1'>+</option>
          <option value='2'>-</option>
          <option value='3'>*</option>
          <option value='4'>/</option>
         
   </select>
  
  
  <label for='Num2'>Numero 2</label><input type='number' name='Num2' value='<?php echo $num2;   ?>'>
  
   

  
 <input type='submit' name='Calcular' value='Calcular'>
   <br>
   
  <label for='Resultado'>Resultado</label><input type='text' name='Resultado' value='<?php echo $resul;   ?>' >
  
</form>















</body>