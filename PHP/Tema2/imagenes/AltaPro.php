<html>
<?php 

require_once 'libreria.php';

$nombreCarpeta="Fotos";

function ObtenerIdFoto($IdPro)
{
  $consulta="SELECT Max(IdFoto) as SigFoto
             FROM `FotosPro`
             Where IdPro=$IdPro";  
    
  $filas=ConsultaDatos($consulta);
  
  $fila=$filas[0];
  
  $IdFoto=$fila['SigFoto']+1;
  
  return $IdFoto;
}



function ObtenerMarcas()
{
    $consulta="select * from Marcas";
    
    $filas=ConsultaDatos($consulta);
    
    $marcas=array();
    
    foreach ($filas as $fila)
    {
        $marcas[$fila['Id']]=$fila;
    }
    
    return $marcas;
}


$nombre='';

if (isset($_POST['Nombre'] )  )
{
    $nombre=$_POST['Nombre'];
}

$precio='';

if (isset($_POST['Precio'] )  )
{
    $precio=$_POST['Precio'];
    
}
    
$marca='';

if (isset($_POST['Marca'] )  )
{
    $marca=$_POST['Marca'];
}

$modelo='';

if (isset($_POST['Modelo'] )  )
{
    $modelo=$_POST['Modelo'];
}


$numfot=1;  //Establecemos una foto por defecto

if (isset($_POST['NumFot'] )  )
{
    $numfot=$_POST['NumFot'];
}



?>

<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'  > 
     <fieldset><legend>Datos del Producto</legend>
            
          
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre' value='<?php echo $nombre; ?>'    ><br>
            <label for='Precio'>Precio</label><input type='text' name='Precio'  value='<?php echo $precio; ?>'><br>
            <label for='Marca'>Marca</label>
            <select name='Marca' onChange='document.f1.submit();'>
             <option></option>
            
            <?php 
           
            
            $marcas=ObtenerMarcas();   //Obtenemos las marcas
            
            $logo='';  //Para conservar el logo de marca seleccionada
            
            foreach ($marcas as $Id=>$fila)
            {
                echo "<option value='$Id' ";
                
                if (  $marca==$Id)
                {
                    echo " selected ";
                    $logo=$fila['Logo'];    
                      
                   
                }
                
                
                echo ">$fila[Nombre]</option>";
                
            }
            
            ?>    
            
            </select>
            
            <?php 
            
            if ($logo!='')    //Si hay un logo seleccionado
            {
              echo   "<img src='imagenes/$logo'  width='80' height='80' >";
            }
            
            ?>
            
            
            <br>
            
            <label for='Modelo'>Modelo</label><input type='text' name='Modelo' value='<?php echo $modelo; ?>' ><br>
             
           </fieldset> 
           
           
            <fieldset><legend>Imágenes del Producto</legend>
            
            <label for='NumFot'>Numero de Fotos </label>
            <select name='NumFot' onChange='document.f1.submit()'>
             <option></option>
           
            <?php 
           
            for($i=1;$i<=5;$i++)
            {
               echo "<option value='$i' ";
               
               if ($i==$numfot)
               {
                echo " selected ";   
               }
               
               echo ">$i</option>";
               
            }
                
            
           ?>
          
         </select>
         <br>   
         <?php 
         
         for($i=1;$i<=$numfot;$i++)
         {
             
           echo "Foto $i<input type='file' name='Foto[$i]'>";
           echo "<br>";
             
         }
         
         ?>  
                  
            <input type='submit' name='Guardar' value='Guardar'>
           
            </fieldset>
           
           
     </form> 
     
     <?php 
     
     if (isset($_POST['Guardar']) )
     {
        
         $consulta="insert into Productos values (NULL,'$nombre',$precio,$marca,'$modelo')";
             
         ConsultaSimple($consulta) ;
         
         //Recuperar el Id asignado por la BBBDD a ese producto
         
         $consulta="select Id from Productos where Nombre='$nombre' and Marca=$marca and Modelo='$modelo' and Precio=$precio";
         
         $filas=ConsultaDatos($consulta);
         
         $fila=$filas[0];
         
         $IdPro= $fila['Id'];
     
         //Insertamos para ese producto sus fotos
         
         for($i=1;$i<=$numfot;$i++)     //Para cada uno de esos campos file
         {
             $nomArchivo=$_FILES['Foto']['name'][$i];
             $nomTemp=$_FILES['Foto']['tmp_name'][$i];
                   
             copy($nomTemp,$nombreCarpeta."/".$nomArchivo );  //copiamos el archivo desde la carpeta temporal a la carpeta de imagenes con su nombre original
             
             
             $IdFoto=ObtenerIdFoto($IdPro);   //Obtenemos el siguiente IdFoto para ese producto 
             
             $consulta="insert into FotosPro values ($IdPro,$IdFoto,'$nomArchivo')";
         
             ConsultaSimple($consulta);
     
         }
        
       
     }
     
     ?>
     
     
     
     
     
     
     
     
     
      
  </body>   
