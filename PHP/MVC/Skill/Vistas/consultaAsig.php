<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consulta de Asignaturas</title>
        <link rel="stylesheet" href="../resources/css/estilo.css">
    </head>
    <body>
<?php
    session_start();
    include '../web/menuAsig.php';
    require_once '../entidades/classAsignatura.php';
    
?>    
  
<div id="formConsultaAlumno" class="formulariogeneral">
    <form name="frmConsultaAlumno" method="post" action="../web/controllerAsig.php?operacion=consultarAsig">
        <fieldset id="datosAlumno">
        <legend>Formulario de Consulta</legend>
        <table width="75%" border="0">
        <tr>
        <td>Id:</td>
         
           <td><input name="Id" type="text" id="dni" size="15" maxlength="15"></td>
       
        
        </tr>
        <tr>
        <td></td>
        <td><input type="submit" name="Submit" value="Enviar"></td>
        </tr>
        </table>
        </fieldset>
    </form>
   </div>
<div id="resultadoConsulta">        
  <?php
    if(isset($_SESSION['asignatura']))
	{
		
		$asignatura=unserialize($_SESSION['asignatura']); // Recuperamos la asignatura de la Sesion
    
	?>     
    <table width="600" border="1" align="center">
    <tr>
    <th scope="col">Id</th>
    <th scope="col">NOMBRE</th>
    <th scope="col">CURSO</th>
    </tr> 
   <?php    
   
  	
     print("<tr>");
     print("<td>".$asignatura->__GET('Id')."</td>");
     print("<td>".$asignatura->__GET('Nombre')."</td>");
     print("<td>".$asignatura->__GET('Curso')."</td>");
     print("</tr>");
     print("</table>");
     unset($_SESSION['asignatura']);
	} 
    

    ?>
    
</div>
</body>
</html>
