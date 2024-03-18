 <?php
 
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
         echo "<table border='2'>";
         echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th>";
         echo "<th>Telefono</th><th>Premios</th>";
         
         while ( ($fila=mysqli_fetch_assoc($resul))!=null  )
         {
             echo "<tr>";
             
             echo "<td>".$fila['NIF']."</td>";
             echo "<td>$fila[Nombre]</td>";
             echo "<td>$fila[Apellido1]</td>";
             echo "<td>$fila[Apellido2]</td>";
             echo "<td>$fila[Telefono]</td>";
             echo "<td>$fila[Premios]</td>";
             
             echo "</tr>";
             
        }
         
       echo "</table>"; 
        
     }
     else  //Devuelve el valor falso por un error en la consulta 
     {
       echo "Error en la consulta:".mysqli_error($db);
       
     }
     
         
 }
     
   
 mysqli_close($db);
 


?> 
