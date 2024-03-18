<!DOCTYPE html>
<html>

<?php 


function CodigoModulo($nombre,$curso,$cicl)
{
   $codM='';
   
   $codM.=$nombre[0];   //La primera letra del nombre
   
   $codM.=$curso;       //Mas el curso
   
   $codM.=substr($cicl,0,3);    //Mas las tres primeras del nombre del ciclo
   
   
   return $codM;
    
}


function GuardarLinea($linea,$NombreArchivo)
{
    $fd = fopen($NombreArchivo,"a+") or die("Error al abrir el archivo $NombreArchivo");
    
    fputs($fd, $linea);
    
    fclose($fd);

}


function ObtenerCiclos()      //Obtenemos 
{
    $ciclos=array();
    
    if (file_exists("Ciclos.txt")) //
    {
        $fd = fopen("Ciclos.txt", "r");
        
        while ( !feof($fd) )
        {
            $linea = fgets($fd);
            
            $campos = explode(" ", $linea);
            
            if (count($campos) == 2) //
            {
                $ciclos[$campos[0]]=$campos[1]   ;
                
            }
        }
        
        fclose($fd);
        
    }
    
    return $ciclos;
    
}



$cur='';

if (isset($_GET['Curso'] ) )
{
    $cur=$_GET['Curso'];
}

$cicl='';

if (isset($_GET['Ciclo'] ) )
{
    $cicl=$_GET['Ciclo'];
}

?>



<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Alta de Modulos</legend>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'>
            
            <label for='Curso'>Curso:</label>
            <select name='Curso'>
               <option value=''></option>
             
               <?php 
               
               $curso=array(1,2);
               
               foreach ($curso as $clave=>$valor)
               {
                  echo "<option value='$valor' ";
                  
                  if (  $cur==$valor)
                  {
                      echo " selected ";
                  }
                      
                   
                  echo ">$valor</option>"; 
                   
               }
               
               ?>
            
            </select>
            
            <label for='Ciclo'>Ciclo:</label>
            <select name='Ciclo'>
               <option value=''></option>
             
               <?php 
               
               $ciclos=ObtenerCiclos();   //Obtenemos los paises
               
               foreach ($ciclos as $clave=>$valor)
               {
                  echo "<option value='$clave' ";
                  
                  if (  $cicl==$clave)
                  {
                      echo " selected ";
                  }
                      
                   
                  echo ">$valor</option>"; 
                   
               }
               
               ?>
            
            </select>
          
            <input type='submit' name='Guardar' value='Guardar'>
        </fieldset>

    </form>
</body>

</html>

<?php



if (isset($_GET['Guardar'])) //
{

    $nombre = $_GET['Nombre'];
    
    $cur = $_GET['Curso']; 
    
    $cicl = $_GET['Ciclo'];   //El valor que recibimos el el codigo del ciclo
    
    $salto = "\r\n";
    
    $nombreCiclo=$ciclos[$cicl];   //Recuperamos para ese codigo de ciclo su valor, osea, el nombre del ciclo

    $codMod=CodigoModulo($nombre,$cur,$nombreCiclo);   //Función que nos devuelve el codigo de ese modulo

    $linea=$codMod." ".$nombre." ".$cur." ".$cicl.$salto;
 
    //echo $linea;
    
    $NombreArchivo="Modulos.txt";
    
    GuardarLinea($linea,$NombreArchivo);
        
            
}

?>
