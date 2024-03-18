<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" >
	<title>Registro  de Asignaturas</title>
        <link rel="stylesheet" href="../resources/css/estilo.css">
</head>
<?php
    include '../web/menuAsig.php';
?> 
<body>
<div id="formAlumno" class="formulariogeneral">
    <form name="frmAlumno" method="post" action="../web/controllerAsig.php?operacion=nuevaAsig">
        <fieldset id="datosAlumno">
        <legend>Formulario de Registro</legend>
        <table width="75%" border="0">
        <tr>
        <td>Id:</td>
        <td><input name="Id" type="text" id="Id" size="15" maxlength="15"></td>
        </tr>
        <tr>
        <td>Nombre:</td>
        <td><input name="Nombre" type="text" id="nombre" size="30" maxlength="30">    
        </tr>
        <tr>
        <td>Curso:</td>
        <td><input name="Curso" type="text" id="curso" size="10" maxlength="10">    
        </tr>        
        <tr>
        <td></td>
        <td><input type="submit" name="Submit" value="Enviar"></td>
        </tr>
        </table>
        </fieldset>
    </form>
   </div>
</body>
</html>



