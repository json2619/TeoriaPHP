<!DOCTYPE html>
<html>

<body>

  <?php 
  
  function ConsultaAlumo($consulta)  //Funcion que retorna una fila con los datos el ese alumno
  {
     
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
          $resul=mysqli_query($db, $consulta);
          
          if (mysqli_num_rows($resul)>0 )   //Si la consulta ha devuelto filas
          {
           $fila=mysqli_fetch_assoc($resul);   //Extraemos la fila
          }
          else 
          {
            $fila=array();    //Devolvemos un array vacio
          }
         
      }
     
      mysqli_close($db);
      
      return $fila;
      
  }
  
  
  
  function FilaAlumno($nif)         //Devuelve la fila correspondiente a ese NIF
  {
      
      $consulta="select * from Alumnos where NIF='$nif'";
      
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
          $resul=mysqli_query($db, $consulta);
          
          $fila=mysqli_fetch_assoc($resul);   //Extraemos la fila
          
      }
      
      mysqli_close($db);
      
      return $fila;
      
      
      
  }
  
  
  //Hallamos el primero de la tabla
  
  $consultaPrim="SELECT * FROM Alumnos limit 1"; //Conusulta para sacar el primer NIF de la tabla
  
  $fila=ConsultaAlumo($consultaPrim);
  
  $primero=$fila['NIF'];  //Guardamos en una variable el NIF del primero de la tabla
  
  
  //Hallamos el último de la tabla
  
  $consultaUlt="SELECT * FROM Alumnos order by NIF desc limit 1;"; //Conusulta para sacar el primer NIF de la tabla
  
  $fila=ConsultaAlumo($consultaUlt);
  
  $ultimo=$fila['NIF'];  //Guardamos en una variable el NIF del primero de la tabla
  
  
  $nif='';
  
  if ($nif=='')       //Si el nif esta vacio mostramos los datos del primero      
  {
      $fila=FilaAlumno($primero);
      $nif=$fila['NIF'];          
  }
  
  
  if (isset($_GET['NIF'])  )   //Si hemos recibido un NIF por la URL mostramos la fila de ese NIF
  {
      $nif=$_GET['NIF'];
      
      $fila=FilaAlumno($nif);
      
  }
  
  //Hallar el siguiente y anterior al NIF actual
  
  $consultaSig="SELECT * FROM Alumnos where NIF>'$nif' limit 1";
  
  $fila2=ConsultaAlumo($consultaSig);
  
  if (!empty($fila2) )
  {
    $sig=$fila2['NIF'];
  }
  else 
  {
    $sig=$nif;
  }
      
  
  $consultaAnt="SELECT * FROM Alumnos where NIF<'$nif' order by NIF desc limit 1";
  
  $fila2=ConsultaAlumo($consultaAnt);
  
  if (!empty($fila2) )
  {
      $ant=$fila2['NIF'];
  }
  else
  {
      $ant=$nif;
  }
  
  
  
  ?>




            
  <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>          
            
     <fieldset><legend>Paginación de Alumnos</legend>     
           
            <label for='NIF'>NIF</label><input type='text' name='NIF' value='<?php echo $fila['NIF']; ?>' ><br>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'  value='<?php echo $fila['Nombre']; ?>' ><br>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1' value='<?php echo $fila['Apellido1']; ?>' ><br>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2' value=<?php echo $fila['Apellido2']; ?> ><br>
            <label for='Telefono'>Telefono </label><input type='text' name='Telefono'  value=<?php echo $fila['Telefono']; ?>><br>
            <label for='Premios'>Premios </label><input type='text' name='Premios' value=<?php echo $fila['Premios']; ?> ><br>
                         
            <a href='<?php echo $_SERVER['PHP_SELF']."?NIF=$primero";   ?>'> << </a>&nbsp
            <a href='<?php echo $_SERVER['PHP_SELF']."?NIF=$ant";   ?>'> < </a>&nbsp
            <a href='<?php echo $_SERVER['PHP_SELF']."?NIF=$sig";   ?>'> > </a>&nbsp
            <a href='<?php echo $_SERVER['PHP_SELF']."?NIF=$ultimo";   ?>'> >> </a>&nbsp
        
        
        
     </fieldset>
  </form> 
</body>    
    
</html>     