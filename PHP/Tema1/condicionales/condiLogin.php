<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar números</title>
</head>
<body>
    
<?php
/* Formulario que pida un usuario y la contraseña
Si el usuario existe pero la clave es incorrecta "Error la claves incorrecta"
Pero si el usuario no existe "Formulario de registro"
*/

//Variables de usuario y clave
    $usuarioLog='root';
    $claveLog='clave';

?>

    <H1>Log In</H1>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for="Usuario">Indique el nombre de usuario:</label>
    <input type="text" name="Usuario">

    <br>

    <label for="Contrasena">Indique el segundo número:</label>
    <input type="password" name="Contrasena">

    <br>

    <input type="submit" name='Login' value="Login">

    </form>

<?php

    if (isset( $_GET['Login']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $usuario=$_GET['Usuario'];
        $contrasena=$_GET['Contrasena'];

        if ($usuario == $usuarioLog) { //Esto es cuando el usuario está registrado
            if ($contrasena == $claveLog) {
                echo "<br> Login correcto será redireccionado";
            } else {
                echo "<br> Login incorrecto";
            }

        } else { //El usuario no está registrado
            echo "<form name='f1' method='get' action=".$_SERVER['PHP_SELF'].">";

            echo "<label for='Usuario'>Indique el nombre de usuario:</label><input type='text' name='Usuario'><br>";
        
            echo "<label for='Contrasena'>Indique la clave:</label><input type='password' name='Contrasena'><br>";

            echo "<label for='Correo'>Indique su correo:</label><input type='text' name='Correo'><br>";
        
            echo "<input type='submit' name='Login2' value='Login2'>";
        
            echo "</form>";
        }
        


    }

    if (isset( $_GET['Login2']) )  // Si pulso el botón enviar
    {
        $usuario=$_GET['Usuario'];
        $contrasena=$_GET['Contrasena'];
        $correo=$_GET['Correo'];

        echo "<br> Su usuario ha sido registrado";
    }

?>
</body>
</html>