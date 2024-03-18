<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <link rel="stylesheet" href="../resources/css/estilo.css">
    </head>
    <body>
        <?php
        include '../web/menu.php';
        session_start();
        if(isset ($_SESSION['errormysql'])){
          $errormysql=$_SESSION['errormysql'];
          $codigoeerror=$errormysql[1];
          $mensajeerror=$errormysql[2];
          print("Codigo Error MySQL  ---- ".$codigoeerror."</br>");
          print("Mensaje Error MySQL  ---- ".$mensajeerror);
          unset($_SESSION['errormysql']);
        }
        if(isset ($_SESSION['errorconexion'])){
          $mensajeerror=$_SESSION['errorconexion'];
          print("Error: ".$mensajeerror);
          unset($_SESSION['errorconexion']);
        }
        ?>
    </body>
</html>

