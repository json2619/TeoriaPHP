<html>
<body>
<?php 

require_once 'DaoTiendas.php';
require_once 'DaoFamilias.php';
require_once 'DaoProductos.php';

$base="tiendadao";

$tienda="";

if (isset($_POST['Tienda']) )
{
    $tienda=$_POST['Tienda'];
}

$familia="";

if (isset($_POST['Familia']) )
{
    $familia=$_POST['Familia'];
}



?> 
 

<form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data' >

<fieldset><legend><b>Mostrar productos según tienda y familia</b></legend>

<label for='Tienda'>Tienda</label>

<select name='Tienda' >
     <option value=""></option>
     
     <?php 
     
     $daoTien= new DaoTiendas($base);
     
     $daoTien->listar();
     
     foreach ($daoTien->tiendas as $tien)
     {
         echo "<option value=".$tien->__get("cod") ;
         
         if ($tienda==$tien->__get("cod"))
         {
             echo " selected ";
         }
         
         echo ">".$tien->__get("nombre")."</option>";
     }
 
 
     ?>

  </select>
  
  <label for='Familia'>Familia</label>

<select name='Familia' >
     <option value=""></option>
     
     <?php 
     
     $daoFami= new DaoFamilias($base);
     
     $daoFami->listar();
     
     foreach ($daoFami->familias as $fami)
     {
         echo "<option value=".$fami->__get("cod") ;
         
         if ($familia==$fami->__get("cod"))
         {
             echo " selected ";
         }
         
         echo ">".$fami->__get("nombre")."</option>";
     }
 
 
     ?>

  </select>
   
  <input type='submit' name='Mostrar' value='Mostrar'> 
   
  </fieldset>
  </form>
  
  <?php 
  
  if (isset($_POST['Mostrar']) )
  {
      echo "<fieldset><legend>Productos de la familia $familia</legend>";
      
      $daoProd= new DaoProductos($base);
      
      $daoProd->listFamTien($familia, $tienda);
      
      echo "<table border='2'>";
      echo "<th>Cod</th><th>Nombre</th><th>Descripcion</th><th>PVP</th><th>Familia</th>";
      
      foreach($daoProd->productos as $pro)
      {
        echo "<tr>";
        
        echo "<td>".$pro->__get("cod")."</td>";
        echo "<td>".$pro->__get("nombre")."</td>"; 
        echo "<td>".$pro->__get("descripcion")."</td>"; 
        echo "<td>".$pro->__get("PVP")."</td>"; 
        echo "<td>".$pro->__get("familia")."</td>"; 
        
        echo "</tr>";
          
      }
      
      
      echo "</table>";
      
      
      
      echo "</fieldset>";
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  ?>
  
  
  
  
  
  
  
 </body>  
</html>  
  