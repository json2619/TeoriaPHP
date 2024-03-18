<html>

<title>Mini Calculadora</title>
<body>
<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

  <label for='Num'>Numero</label>
     <input type='number' name='Num'>

    <input type='submit' name='Mostrar' value='Mostrar'>
   <br>
   
</form>    




</body>

<?php 

if (isset($_GET['Mostrar']  )   )
{
    
    $num=$_GET['Num']; 
    
    $fil=$num;
    
    $cont=1;
    
    echo "<table border='2' width='300' height='300'>";
    
    while ( $fil>0 )
    {
      echo "<tr>";  
      
      $col=$num;
      
      while ( $col>0 )
      {
        
        if ( ($fil%2)==0 )   
        {
         echo "<td> </td><td bgcolor='black'> </td>";  
        }
        else 
        {
         echo "<td bgcolor='black'> </td><td> </td>";  
        }
       
        $col=$col-2;  
      }
          
      echo "</tr>";
      
      $fil--;  
    }
    
    
    echo "</table>";
}



?>

