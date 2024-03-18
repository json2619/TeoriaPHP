<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<?php
session_start();

require_once 'libreria.php';

require_once 'DaoUsuarios.php';

$base = 'tiendadao';

$db = new DB($base);

?>

<body>
    <h1>Login de usuario</h1>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <label for='Usuario'>Usuario</label><input type='text' name='Usuario'>
        <p></p>
        <label for='Clave'>Clave</label><input type='password' name='Clave'>
        <p></p>
        <input type='submit' name='Enviar' value='Enviar'>
        <input type='submit' name='Registrarse' value='Registrarse'>
    </form>

</body>

<?php

if (isset($_POST['Enviar'])) {

    $usu = $_POST['Usuario'];

    $salt1 = "~#!()=";

    $salt2 = "?)=€@";

    $cla = $salt1 . $_POST['Clave'] . $salt2;

    $cla = sha1($cla);

    $consulta = "select count(*) as correcto from usuarios where usuario=:usuario and contrasena=:contrasena";

    $param = array();

    $param[':usuario'] = $usu;
    $param[':contrasena'] = $cla;

    $db->ConsultaDatos($consulta, $param);

    $fila = $db->filas[0]['correcto'];

    if ($fila == 1) {
        $_SESSION['usuario'] = $usu;
        echo "Se ha encontrado al usuario en la base de datos";
        header('Location: Menu.php');
    } else {
        echo "No existe un usuario con ese usuario o contraseña";
    }
}

if (isset($_POST['Registrarse'])) {

    $usu = $_POST['Usuario'];

    $salt1 = "~#!()=";

    $salt2 = "?)=€@";

    $cla = $salt1 . $_POST['Clave'] . $salt2;

    $cla = sha1($cla);

    $daoUsu = new DaoUsuarios($base);

    $usuario = new Usuario();

    $usuario->__set("usuario", $usu);
    $usuario->__set("contrasena", $cla);

    $daoUsu->insertar($usuario);

    $_SESSION['usuario'] = $usu;

    header('Location: Menu.php');
}


?>

</html>