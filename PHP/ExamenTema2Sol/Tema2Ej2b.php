<html>
<?php 

require_once 'libreria.php';

function ObtenerProfesores()
{
    
    $profesores=array();
    
    $consulta="select * from Profesores";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $profesores[$fila['NIF']]=$fila;
        
    }
    
    return $profesores;
    
}



function ObtenerSituaciones()
{
    
    $situaciones=array();
    
    $consulta="select * from Situaciones";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $situaciones[$fila['Id']]=$fila;
        
    }
    
    return $situaciones;
    
}

function ObtenerPaises()
{
    
    $paises=array();
    
    $consulta="select * from Paises";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $paises[$fila['Id']]=$fila;
        
    }
    
    return $paises;
    
}


function ObtenerProvincias($pais)
{
    
    $provincias=array();
    
    $consulta="select * from Provincias where IdPais=$pais";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $provincias[$fila['IdPro']]=$fila;
        
    }
    
    return $provincias;
    
}

function ObtenerLocalidades($pais,$provincia)
{
    
    $localidades=array();
    
    $consulta="select * from Localidades where IdPais=$pais and IdProvincia=$provincia ";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $localidades[$fila['IdLoc']]=$fila;
        
    }
    
    return $localidades;
    
}



$nif='';

if (isset($_POST['NIF']) )
{
    $nif=trim($_POST['NIF']);
}

$nifant='';

if (isset($_POST['NIFAnt']) )
{
    $nifant=trim($_POST['NIFAnt']);
}

//echo "NIF anterior:$nif<br>";

//echo "NIF actual:"


$nombre='';

if (isset($_POST['Nombre']) )
{
    $nombre=trim($_POST['Nombre']);
}

$apellido1='';

if (isset($_POST['Apellido1']) )
{
    $apellido1=trim($_POST['Apellido1']);
}

$apellido2='';

if (isset($_POST['Apellido2']) )
{
    $apellido2=trim($_POST['Apellido2']);
}


$situ='';

if (isset($_POST['Situacion']) )
{
    $situ=trim($_POST['Situacion']);
}

$direccion='';

if (isset($_POST['Direccion']) )
{
    $direccion=trim($_POST['Direccion']);
}


$pais='';

if (isset($_POST['Pais']) )
{
    $pais=$_POST['Pais'];
}

$provincia='';

if (isset($_POST['Provincia']) )
{
    $provincia=$_POST['Provincia'];
}

$localidad='';

if (isset($_POST['Localidad']) )
{
    $localidad=$_POST['Localidad'];
}


if (isset($_POST['Modificar']) )    //Si queremos modificar
{
   $consulta="update Profesores set Nombre='$nombre',
                                    Apellido1='$apellido1', 
                                    Apellido1='$apellido1', 
                                    Situacion=$situ,
                                    Direccion='$direccion',
                                    Pais=$pais,
                                    Provincia=$provincia,
                                    Localidad=$localidad
  

                      where NIF='$nif'";
   
   
   ConsultaSimple($consulta);
        
}

?>

<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Gestión de Profesores</legend>
            
            <label for='NIF'>NIF </label>
            
            <select name='NIF' onChange='document.f1.submit();'>
            <option value=''></option>
            <?php 
          
            
            $profesores=ObtenerProfesores();   //Obtenemos los profesores
            
            foreach ($profesores as $clave=>$fila)
            {
                echo "<option value='$clave' ";
                
                if (  $nif==$clave)
                {
                    echo " selected ";
                    
                    $filaAct=$fila;  //Guardamos la fila actual seleccionada
                }
                
             
                echo "> $fila[Apellido1] $fila[Apellido2],$fila[Nombre] </option>";
                
            }
            
            ?>
              
          </select><br>
           
          <?php 
          
          if ($nif!='')    //Si hay un Nif seleccionado
          {
              if ( ($nombre=='') || ($nif!=$nifant)    )   //Si se recibe el valor de ese campo en blanco o hemos cambiado de NIF
              {
                  $nombre=$filaAct['Nombre'];  //Cogemos el del profesor seleccionado
              }
              
              if ( ($apellido1=='') || ($nif!=$nifant)    )   //Si se recibe el valor de ese campo en blanco o hemos cambiado de NIF
              {
                  $apellido1=$filaAct['Apellido1'];  //Cogemos el del profesor seleccionado
              }
              
              if ( ($apellido2=='') || ($nif!=$nifant)    )   //Si se recibe el valor de ese campo en blanco o hemos cambiado de NIF
              {
                  $apellido2=$filaAct['Apellido2'];  //Cogemos el del profesor seleccionado
              }
              
              if ( ($direccion=='') || ($nif!=$nifant)    )   //Si se recibe el valor de ese campo en blanco o hemos cambiado de NIF
              {
                  $direccion=$filaAct['Direccion'];  //Cogemos el del profesor seleccionado
              }
              
              
                echo " <label for='Nombre'>Nombre </label><input type='text' name='Nombre' value='$nombre'><br>";
                echo " <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1' value='$apellido1' ><br>";
                echo "  <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'  value='$apellido2'><br>";
                echo "  <label for='Situacion'>Situacion </label>";
                  
                echo " <select name='Situacion'>";
                echo " <option value=''></option>";
                  
                  $situaciones=ObtenerSituaciones();   //Obtenemos las situaciones
                  
                  if ( ($situ=='') || ($nif!=$nifant)    )   //Si no se recibe un código de pais o hemos cambiado de NIF
                  {
                      $situ=$filaAct['Situacion'];  //Cogemos el del profesor seleccionado
                  
                  }
                      
                  foreach ($situaciones as $clave=>$fila)
                  {
                      echo "<option value='$clave' ";
                      
                      if (  $situ==$clave)
                      {
                          echo " selected ";
                      }
                      
                      
                      echo "> $fila[Nombre] </option>";
                      
                  }
                  
                 
                echo "</select><br>";
                
                echo "<label for='Direccíon'>Direccion </label>";
                
                echo "<textarea name='Direccion' rows='4' cols='30' >";
                echo  $direccion; 
                echo "</textarea><br>";
                
                echo "<label for='Pais'>Pais </label>";
                echo "<select name='Pais' onChange='document.f1.submit();'>";
                echo "<option value=''></option>";
                
                $paises=ObtenerPaises();   //Obtenemos los paises
                
                if ( ($pais=='') || ($nif!=$nifant)    )   //Si no se recibe un código de pais o hemos cambiado de NIF
                {
                    $pais=$filaAct['Pais'];  //Cogemos el del profesor seleccionado
                }
                
                
                foreach ($paises as $clave=>$fila)
                {
                    echo "<option value='$clave' ";
                    
                    if (  $pais==$clave)
                    {
                        echo " selected ";
                    }
                    
                 
                    echo "> $fila[Nombre] </option>";
                    
                }
                
              echo "</select><br>";
                
              echo "<label for='Provincia'>Provincia </label>";
              echo "  <select name='Provincia' onChange='document.f1.submit();'>";
              echo "  <option value=''></option>";
                 
              if ( ($provincia=='') || ($nif!=$nifant))
              {
                  $provincia=$filaAct['Provincia'];
              }
              
              $provincias=ObtenerProvincias($pais);   //Obtenemos las provincias de ese pais
                
                foreach ($provincias as $clave=>$fila)
                {
                    echo "<option value='$clave' ";
                    
                    if (  $provincia==$clave)
                    {
                        echo " selected ";
                    }
                    
                 
                    echo "> $fila[Nombre] </option>";
                    
                }
                              
              echo "</select><br>";  
                
              echo "<label for='Localidad'>Localidad </label>";
              echo "  <select name='Localidad' onChange='document.f1.submit();'>";
              echo "  <option value=''></option>";
           
              if ($localidad=='')
              {
                  $localidad=$filaAct['Localidad'];
              }
              
                $localidades=ObtenerLocalidades($pais,$provincia);   //Obtenemos las provincias de ese pais
                
                foreach ($localidades as $clave=>$fila)
                {
                    echo "<option value='$clave' ";
                    
                    if (  $localidad==$clave)
                    {
                        echo " selected ";
                    }
                    
                 
                    echo "> $fila[Nombre] </option>";
                    
                }
                
              echo "</select><br>";  
              
              echo "<input type='hidden' name='NIFAnt' value='$nif'>";  //Guardamos el NIF anterior
                
              echo "<input type='submit' name='Modificar' value='Modificar'>";
                  
                  
          }
   
          
          ?> 
           
          
           </fieldset> 
     </form>  
  </body>   
  
<?php 

if (isset($_POST['Guardar']) )
{
    //No hay que recoger los datos pues se han recogido arriba para mantener su valor tras una recarga
    
    
    $consulta="select count(*) as cuenta from Profesores where NIF='$nif' ";
    
    $filas=ConsultaDatos($consulta);
    
    $fila=$filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0
    
    if ($fila['cuenta']==0)
    {
    
        $consulta="insert into Profesores values('$nif','$nombre','$apellido1','$apellido2',$situ,'$direccion',$pais,$provincia,$localidad)";
        
        $resul=ConsultaSimple($consulta);
        
    }
    else 
    {
       echo "<b>ERROR, ya hay un profesor para ese NIF</b>"; 
    }
        
    
}


?>  
  
  
   
        
</html>       