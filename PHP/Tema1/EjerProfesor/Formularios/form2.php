<html>

<title>Formulario 1</title>
<body>


<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

  <label for='Nombre'>Nombre</label><input type='text' name='Nombre'>
  <label for='Apellido1'>Apellido1</label><input type='text' name='Apellido1'>
  <label for='Apellido2'>Apellido2</label><input type='text' name='Apellido2'>

 
  <fieldset>
  <legend>Intereses</legend>   

    <label for='Futbol'>Futbol</label><input type='checkbox' name='Futbol' ><br>
    <label for='Tenis'>Tenis</label><input type='checkbox' name='Tenis' ><br>
    <label for='Billar'>Billar</label><input type='checkbox' name='Billar' ><br>

  </fieldset> 
  <fieldset>
  <legend>Estado Civil</legend>   

   
       Soltero<input type='radio' name='Estado' value='Soltero' checked>
       Casado<input type='radio' name='Estado' value='Casado'>
       Separado<input type='radio' name='Estado' value='Separado'>
       Viudo<input type='radio' name='Estado' value='Viudo'>
   
  </fieldset> 

  <label for='Pais'>Pais</label>
    <select name='Pais' >        
          <option value=''></option>
          <option value='1'>España</option>
          <option value='2'>Francia</option>
          <option value='3' >Portugal</option>
         
   </select><br>
   
   <textarea rows="5" cols="40" name="Observaciones">
     Indique sus observaciones
   
   
   </textarea>
   
   


 <input type='submit' name='Enviar' value='Enviar'>
  
 

</form>


<?php 

if (isset( $_GET['Enviar'] )  )      //Si Pulso el botón enviar
{
    //Recogemos los datos del nombre

$nombre=$_GET['Nombre'];           
$apellido1=$_GET['Apellido1'];
$apellido2=$_GET['Apellido2'];

echo "EL usuario: $nombre $apellido1 $apellido2 <br>";

   //Recogemos los intereses
   

echo "Tiene los intereses: ";
   
if ( isset($_GET['Futbol'] ) )
{
    echo " Futbol ";
    
}
if ( isset($_GET['Tenis'] ) )
{
    echo " Tenis ";
    
}

if ( isset($_GET['Billar'] ) )
{
    echo " Billar ";
    
}



$estado=$_GET['Estado'];

echo "Su estado civil es: $estado ";

echo "<br>";


$pais=$_GET['Pais']; //Recogemos el Pais

echo "Su pais seleccionado es: $pais ";

//Recogemos las observaciones

$observa=$_GET['Observaciones']; //Recogemos el Pais

echo "<br>";

echo "Observaciones indicadas: $observa";





}

?>













</body>