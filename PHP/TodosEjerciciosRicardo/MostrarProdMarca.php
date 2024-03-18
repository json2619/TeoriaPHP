<html>
<body>
<?php 

//Creamos un objeto PDO para establecer la conexión

require_once 'libreriaPDO.php';

$db=new DB("Tema2Blobs");

?>

<form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data' >

<fieldset><legend><b>Marcas con las que trabajamos</b></legend>

 <?php
     
     $param=array();
     
     $consulta="select * from Marcas";
     
     $db->ConsultaDatos($consulta, $param);
     
     $cols=5; //Columnas por defecto 
     
     $NumFotos=count($db->filas);
     
     $filas=ceil( $NumFotos /$cols);  //Calculamos el numero de filas
     
     $contFot=0;  //contador para saber que foto estamos mostrando en cada momento
     
     echo "<table>";
     
     for ($i=0;$i<$filas;$i++)
     {
         echo "<tr>";
         
         for($j=0;$j<$cols;$j++)
         {
            if ($contFot<$NumFotos)
            {
            echo "<td>"; 
                
                $conte=$db->filas[$contFot]['Logo'];
                
                echo "<img src='data:image/jpg;base64,$conte' width=70 height=70>";
                
                echo "<input type='checkbox' name='Marcas[".$db->filas[$contFot]['Id']."]' >";
                
                echo "</td>"; 
                
                $contFot++;
            }
            else 
            {
                echo "<td>&nbsp</td>";
            }
           
         }
         
         echo "</tr>";
     }
 
     echo "</table>";
     
 ?>

  </select>
   <br>
   
  <input type='submit' name='Mostrar' value='Mostrar'> 
   
  </fieldset>
  
 </form>
 </body>
</html> 







