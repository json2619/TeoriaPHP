<html>
<?php 

require_once 'libreria.php';


$num=1;

if (isset($_POST['Numero']) )
{
   $num=$_POST['Numero'];
}

$opc=1;

if (isset($_POST['Opcion']) )
{
    $opc=$_POST['Opcion'];
}



?>


<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Estadísticas de Modulos</legend>
     <label for='Curso'>Opción:</label>
       
        <?php 
        
        $opciones=array(1=>"Aprobado",2=>"Suspenso");
        
        foreach ($opciones as $clave=>$valor)
        {
            echo "<input type='radio' name='Opcion' value=$clave ";

            if ($clave==$opc)
            {
              echo " checked ";  
            }
            echo " >$valor";
            
        }
        
        ?>
     
        
      <br>
      
      <label for='Numero'>Numero </label>
          <select name='Numero'>
            <?php 
          
            
            for ($i=0;$i<21;$i++ )
            {
                echo "<option value='$i' ";
                
                if (  $num==$i)
                {
                    echo " selected ";
                }
                
                echo "> $i </option>";
                
            }
            
            ?>
              
          </select>
     
       <input type='submit' name='Filtrar' value='Filtrar'>
     
     
      </fieldset> 
      
      <?php 
      
      if (isset($_POST['Filtrar']) )
      {
          $opc=$_POST['Opcion'];
          
          $consulta="SELECT CodMod,m.Nombre,count(Nota) as suspensos
                     FROM Notas n, Modulos m
                     where n.CodMod=m.Id ";
               
          if ($opc==1)
          {
             $consulta.=" and Nota>=5 ";
          }
          else 
          {
             $consulta.=" and Nota<5 ";
          }
          
      
        $consulta.=" GROUP by CodMod
                     having suspensos >= $num
                     order by suspensos desc ";  
      
       
        $filas=ConsultaDatos($consulta);  
          
        echo "<fieldset><legend>Resultado de la consulta</legend>";  
        
        echo "<table border='2'>";
        echo "<th>CodMod</th><th>Nombre</th><th>Numero Alumnos</th>";
        
        foreach ($filas as $fila)
        {
           echo "<tr>";
           
           foreach ($fila as $campo)
           {
              echo "<td>$campo</td>"; 
           }
           
           echo "</tr>";
            
        }
        
        echo "</table>"; 
        
        echo "</fieldset>";
          
      }
       
      ?>
       
     </form>  
  </body>  
</html>  