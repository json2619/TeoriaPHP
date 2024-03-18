<!DOCTYPE html>
<html>

<?php 

function ObtenerAlumnos()
{
    
    $alumnos=array();
    
    mysqli_report(MYSQLI_REPORT_OFF);   //Para desabilitar las excepciones en versiones posteriores a 8.1
    
    $db = mysqli_connect("localhost", "root", "", "Tema2");
    
    
    if (!$db)
    {
        echo("Error de conexión: ".mysqli_connect_error()."<br>");
        echo("Error numero: ".mysqli_connect_errno()."<br>");
        
        exit();
    }
    else //Si me he conectado correctamente
    {
        $consulta="select * from Alumnos";
        
        $resul=mysqli_query($db, $consulta);
        
        if ($resul)   //Si hay un resultado correcto
        {
            while ( ($fila=mysqli_fetch_assoc($resul))!=null  )
            {
                $alumnos[$fila['NIF']]=$fila;
                
            }
            
        }
        else  //Devuelve el valor falso por un error en la consulta
        {
            echo "Error en la consulta:".mysqli_error($db);
            
        }
        
    }
     
    mysqli_close($db);
   
    return $alumnos;
    
}

$alu='';

if (isset($_POST['Alumno']) )
{
    $alu=$_POST['Alumno'];   
}


if (isset($_POST['Actualizar']) )      //Recogemos los datos que queremos actualizar
{
    $nif = $_POST['NIF'];
    $nombre = $_POST['Nombre'];
    $apellido1 = $_POST['Apellido1'];
    $apellido2 = $_POST['Apellido2'];
    $telefono = $_POST['Telefono'];
    $premios= $_POST['Premios'];
    
    $fechanac= $_POST['FechaNac'];
    
    //Convertimos la fecha dd/mm/yyyy a segundos
    
    $campos=explode("/",$fechanac);
    
    $fechaSeg=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);
     
    
    
    
    mysqli_report(MYSQLI_REPORT_OFF);   //Para desabilitar las excepciones en versiones posteriores a 8.1
    
    $db = mysqli_connect("localhost", "root", "", "Tema2");
    
    
    if (!$db)
    {
        echo("Error de conexión: ".mysqli_connect_error()."<br>");
        echo("Error numero: ".mysqli_connect_errno()."<br>");
        
        exit();
    }
    else //Si me he conectado correctamente
    {
        $consulta="update Alumnos set Nombre='$nombre',
                                  Apellido1='$apellido1',
                                  Apellido2='$apellido2',
                                  Telefono='$telefono',
                                  Premios=$premios,
                                  FechaNac=$fechaSeg
                                  
               where  NIF='$nif'
         ";
        
        $resul=mysqli_query($db, $consulta);
        
        if (!$resul)   //Si hay un resultado correcto
        {
            echo "Error en la consulta:".mysqli_error($db);
            
        }
      
    }
    
    mysqli_close($db);
    
    
    
}

if (isset($_POST['Borrar']) )      //Recogemos los datos que queremos actualizar
{
    $nif = $_POST['NIF'];
    
    $consulta="delete from alumnos  where NIF='$nif'";
    
    mysqli_report(MYSQLI_REPORT_OFF);   //Para desabilitar las excepciones en versiones posteriores a 8.1
    
    $db = mysqli_connect("localhost", "root", "", "Tema2");
    
    
    if (!$db)
    {
        echo("Error de conexión: ".mysqli_connect_error()."<br>");
        echo("Error numero: ".mysqli_connect_errno()."<br>");
        
        exit();
    }
    else //Si me he conectado correctamente
    {
        $consulta="delete from Alumnos  where NIF='$nif'";
   
        $resul=mysqli_query($db, $consulta);
        
        if (!$resul)   //Si hay un resultado correcto
        {
            echo "Error en la consulta:".mysqli_error($db);
            
        }
        
    }
    
    mysqli_close($db);
}

?>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        
        <fieldset><legend>Alumno a Buscar</legend>
          <select name='Alumno'>
            <option value=''></option>
            <?php 
          
            
            $alumnos=ObtenerAlumnos();   //Obtenemos los paises
            
            foreach ($alumnos as $clave=>$fila)
            {
                echo "<option value='$clave' ";
                
                if (  $alu==$clave)
                {
                    echo " selected ";
                }
                
             
                echo ">$fila[Apellido1] $fila[Nombre] </option>";
                
            }
            
            ?>
              
          </select><input type='submit' name='Buscar' value='Buscar'>
         
        </fieldset>

        <?php
        
        if (isset($_POST['Buscar'])) //
        {
            
            $nif = $_POST['Alumno'];
            
            $fila=$alumnos[$nif];   //Recuperamos la linea con los datos de ese alumno
            
            $campos=getdate($fila['FechaNac']);
            
            $fechaForm=$campos['mday']."/".$campos['mon']."/".$campos['year'];
            
            
            echo "<fieldset><legend>Datos del alumno</legend>";
            
            echo "<label for='NIF'>NIF </label><input type='text' name='NIF' value='$nif' readonly='readonly'>";
            echo "<label for='Nombre'>Nombre </label><input type='text' name='Nombre' value='$fila[Nombre]' >";
            echo "<label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1' value='$fila[Apellido1]' ><br>";
            echo "<label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2' value='$fila[Apellido2]' ><br>";
            echo "<label for='Telefono'>Telefono </label><input type='text' name='Telefono' value='$fila[Telefono]' ><br>";
            echo "<label for='Premios'>Premios </label><input type='text' name='Premios' value='$fila[Premios]' ><br>";
            echo "<label for='FechaNac'>Fecha Nac </label><input type='text' name='FechaNac' placeholder='dd/mm/year' value='$fechaForm'  ><br>";
             
            echo "<input type='submit' name='Actualizar' value='Actualizar'>";
            echo "<input type='submit' name='Borrar' value='Borrar'>";
            
           echo "</fieldset>"; 
            
        }
        
        ?>
       
       
                                                           
    </form>
</body>

</html>

