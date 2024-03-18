<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" >
	<title>Listado de alumnos</title>
        <link rel="stylesheet" href="../resources/css/estilo.css">
</head>
<?php
    include '../web/menuAsig.php';
    require_once '../entidades/classAsignatura.php';
    session_start();
    $listaAsignaturas=unserialize($_SESSION['listaAsignaturas']);
?> 
<body>
  <table width="600" border="1" align="center">
  <tr>
    <th scope="col">Id</th>
    <th scope="col">NOMBRE</th>
    <th scope="col">CURSO</th>
  </tr>
<?php

 foreach($listaAsignaturas as $asignatura ){
     print("<tr>");
     print("<td>".$asignatura->__GET('Id')."</td>");
     print("<td>".$asignatura->__GET('Nombre')."</td>");
     print("<td>".$asignatura->__GET('Curso')."</td>");
     print("</tr>");
 }
?>  
</table>
</body>
</html>




 
