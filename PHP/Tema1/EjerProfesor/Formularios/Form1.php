<html>

<title>Formulario 1</title>
<body>


<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

  <label for='Nombre'>Nombre</label><input type='text' name='Nombre'>
  <label for='Apellido1'>Apellido1</label><input type='text' name='Apellido1'>
  <label for='Apellido2'>Apellido2</label><input type='text' name='Apellido2'>

  


 <input type='submit' name='Primero' value='Primero'>
  
 <input type='submit' name='Ultimo' value='Ultimo'> 

</form>

<?php 

//Recibimos los datos 

if (isset( $_GET['Nombre'] )  )      //Me han llegado datos del formulario
{
    //Los guardamos en variables locales

$nombre=$_GET['Nombre'];           
$apellido1=$_GET['Apellido1'];
$apellido2=$_GET['Apellido2'];

echo "<table border='2'>";

    if ( isset( $_GET['Primero'] )  )
    {
            
            echo "<th>Nombre<th><th>Apellido1<th><th>Apellido2<th>";
            echo "<tr>";
            echo "<td>$nombre<td><td>$apellido1<td><td>$apellido2<td>";
            
            echo "</tr>";
            
    }
    else 
    {
        echo "<th>Apellido1<th><th>Apellido2<th><th>Nombre<th>";
        
        echo "<tr>";
        
        echo "<td>$apellido1<td><td>$apellido2<td><td>$nombre<td>";
        
        echo "</tr>";
        
    }
        
        
echo "</table>"; 
      
}


    

    
    





?>





</body>


</html>

