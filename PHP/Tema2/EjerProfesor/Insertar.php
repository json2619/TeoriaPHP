<!DOCTYPE html>
<html>

<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Insercción de Alumnos en BBDD</legend>
            <label for='NIF'>NIF </label><input type='text' name='NIF'>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'>  
            <label for='Telefono'>Telefono </label><input type='text' name='Telefono'> 
            <label for='Premios'>Premios </label><input type='text' name='Premios'><br>
          
            <input type='submit' name='Guardar' value='Guardar'>
        </fieldset>

    </form>
</body>

</html>

<?php



if (isset($_GET['Guardar'])) //
{
  
    $nif = $_GET['NIF'];
    $nombre = $_GET['Nombre'];
    $apellido1 = $_GET['Apellido1'];
    $apellido2 = $_GET['Apellido2'];
    $telefono = $_GET['Telefono'];
    $premios = $_GET['Premios'];
    
    $validado=TRUE;
    
    if (strlen($nif)>9 )
    {
        echo "Error el NIF tiene que tener menos de 10 caracteres<br>";
        $validado=false;
        
    }
    
    if (strlen($nombre)>25 )
    {
        echo "Error el Nombre tiene que tener menos de 26 caracteres<br>";
        $validado=false;
        
    }
    
    if (strlen($apellido1)>25 )
    {
        echo "Error el Apellido1 tiene que tener menos de 26 caracteres<br>";
        $validado=false;
        
    }
    
    if (strlen($apellido2)>25 )
    {
        echo "Error el Nombre tiene que tener menos de 26 caracteres<br>";
        $validado=false;
        
    }
    
    if (strlen($telefono)>9 )
    {
        echo "Error el Teléfono tiene que tener menos de 10 caracteres<br>";
        $validado=false;
        
    }
    
    if (!is_numeric($premios) )
    {
        echo "Error el campos premios tiene que ser un valor numérico<br>";
        $validado=false;
    }
    
    
    $db = mysqli_connect("localhost", "root", "", "Tema2");   //Conectar
    
    //Construir el query string
    
    if ($validado)
    {
     $consulta="insert into Alumnos values ('$nif',
                                           '$nombre',
                                           '$apellido1',
                                           '$apellido2',
                                           '$telefono',
                                            $premios)"; 
    
   
    $resul=mysqli_query($db,$consulta);
   
    }
   
    
    
    //Cerrar la conexión
    
    mysqli_close($db);
    
            
}

?>



