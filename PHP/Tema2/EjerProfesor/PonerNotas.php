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

function ObtenerModulos()
{
    
    $modulos=array();
    
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
        $consulta="select * from Modulos";
        
        $resul=mysqli_query($db, $consulta);
        
        if ($resul)   //Si hay un resultado correcto
        {
            while ( ($fila=mysqli_fetch_assoc($resul))!=null  )
            {
                $modulos[$fila['Cod']]=$fila;
                
            }
            
        }
        else  //Devuelve el valor falso por un error en la consulta
        {
            echo "Error en la consulta:".mysqli_error($db);
            
        }
        
    }
    
    mysqli_close($db);
    
    return $modulos;
    
}



$alu='';

if (isset($_POST['Alumno']) )
{
    $alu=$_POST['Alumno'];   
}

$mod='';

if (isset($_POST['Modulo']) )
{
    $mod=$_POST['Modulo'];
}

$nota='';

if (isset($_POST['Nota']) )
{
    $nota=$_POST['Nota'];
}

?>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        
        <fieldset><legend>Poner notas a un alumno</legend>
        
          <label for='Alumno'>Alumno </label>
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
              
          </select>
          
          <label for='Modulo'>Módulo </label>
          <select name='Modulo'>
            <option value=''></option>
            <?php 
          
            
            $modulos=ObtenerModulos();   //Obtenemos los paises
            
            foreach ($modulos as $clave=>$fila)
            {
                echo "<option value='$clave' ";
                
                if (  $mod==$clave)
                {
                    echo " selected ";
                }
                
             
                echo "> $fila[Nombre] </option>";
                
            }
            
            ?>
              
          </select>
          
          
          <label for='Nota'>Nota </label>
          <select name='Nota'>
            <option value=''></option>
            <?php 
          
            
            for ($i=0;$i<11;$i++ )
            {
                echo "<option value='$i' ";
                
                if (  $nota==$i)
                {
                    echo " selected ";
                }
                
                echo "> $i </option>";
                
            }
            
            ?>
              
          </select>
          
          <input type='submit' name='Calificar' value='Calificar'>
         
        </fieldset>
                                                                  
    </form>
</body>

<?php

if (isset($_POST['Calificar']) ) //
{
  

    $db = mysqli_connect("localhost", "root", "", "Tema2");
    
    if (!$db)
    {
        echo("Error de conexión: ".mysqli_connect_error()."<br>");
        echo("Error numero: ".mysqli_connect_errno()."<br>");
        
        exit();
    }
    else //Si me he conectado correctamente
    {
       $consulta="select count(*) as cuenta from Notas where NIF='$alu' and CodMod='$mod' "; 
        
       $resul=mysqli_query($db, $consulta);
       
       $fila=mysqli_fetch_assoc($resul);  //Extraemos la fila
       
       //echo $fila['cuenta'];
       
       
       if ($fila['cuenta']==1)    //Ya había una nota para ese alumno en ese módulo y hay que actualirla
       {
           
         $consulta="update Notas set Nota=$nota   where NIF='$alu' and CodMod='$mod'";  
           
       }
       else //NO había una nota para ese alumno en ese módulo y hay que insertar
       {
          
          $consulta="insert into Notas values('$alu','$mod',$nota) ";   ;  
       }
           
       
      //echo $consulta; 
        
       mysqli_query($db, $consulta);
        
        
    }
    
    mysqli_close($db);
    
    
    
}

?>







</html>
