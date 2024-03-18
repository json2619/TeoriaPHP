<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" >
	<title>Listado de alumnos</title>
        <link rel="stylesheet" href="../resources/css/estilo.css">
</head>
<?php
    include '../web/menu.php';
    require_once '../entidades/classAlumno.php';
    session_start();
    $listaalumnos=unserialize($_SESSION['listaalumnos']);
?> 
<body>
  <table width="600" border="1" align="center">
  <tr>
    <th scope="col">DNI</th>
    <th scope="col">NOMBRE</th>
    <th scope="col">CURSO</th>
  </tr>
<?php

 foreach($listaalumnos as $alumno){
     print("<tr>");
     print("<td>".$alumno->getDni()."</td>");
     print("<td>".$alumno->getNombre()."</td>");
     print("<td>".$alumno->getCurso()."</td>");
     print("</tr>");
 }
?>  
</table>
</body>
</html>




 
