<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consulta de Alumnos</title>
        <link rel="stylesheet" href="../resources/css/estilo.css">
    </head>
    <body>
<?php
    include '../web/menu.php';
    require_once '../entidades/classAlumno.php';
    session_start();
    if(isset($_SESSION['alumnoabuscar']))
        $alumno=$_SESSION['alumnoabuscar']; 
?>    
  
<div id="formConsultaAlumno" class="formulariogeneral">
    <form name="frmConsultaAlumno" method="post" action="../web/controller.php?operacion=consultaralumno">
        <fieldset id="datosAlumno">
        <legend>Formulario de Consulta</legend>
        <table width="75%" border="0">
        <tr>
        <td>Dni:</td>
        <?php
        if(isset($_SESSION['dni'])){?>
           <td><input name="dni" type="text" value="<?php print($_SESSION['dni'])?>" id="dni" size="15" maxlength="15"></td>
        <?php
        }
        else{?>
           <td><input name="dni" type="text" id="dni" size="15" maxlength="15"></td>
        <?php
        }
        ?>
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
    if(isset($_SESSION['alumnoabuscar'])){
?>     
    <table width="600" border="1" align="center">
    <tr>
    <th scope="col">DNI</th>
    <th scope="col">NOMBRE</th>
    <th scope="col">CURSO</th>
    </tr> 
 <?php    
     print("<tr>");
     print("<td>".$alumno->getDni()."</td>");
     print("<td>".$alumno->getNombre()."</td>");
     print("<td>".$alumno->getCurso()."</td>");
     print("</tr>");
     print("</table>");
     unset($_SESSION['alumnoabuscar']);
    }
    if(isset($_SESSION['noexistealumno'])){
        unset($_SESSION['noexistealumno']);
        
    ?>
    <table width="600" border="1" align="center">
    <tr>
        <td>No existe el alumno con el dni indicado</td>
    </tr> 
    </table>
<?php
    }
?> 
</div>
</body>
</html>
