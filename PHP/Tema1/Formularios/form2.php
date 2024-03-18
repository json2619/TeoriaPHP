<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mi Página</title>
</head>
<body>

    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

    <label for='Nombre'>Nombre:</label>
    <input type="text" name='Nombre'>

    <p></p>

    <label for='Apellido1'>Apelllido 1:</label>
    <input type="text" name='Apellido1'>

    <p></p>

    <label for='Apellido2'>Apellido 2:</label>
    <input type="text" name='Apellido2'>

    <p></p>

    <fieldset>
        <legend> Intereses </legend>
            <label for="futbol">Futbol</label><input type="checkbox" name="futbol" checked><br>
            <label for="tenis">Tenis</label><input type="checkbox" name="tenis"><br>
            <label for="billar">Billar</label><input type="checkbox" name="billar"><br>
    </fieldset>

    <p></p>

    <fieldset>
        <legend>Estado civil</legend>
            Soltero<input type="radio" name="Estado" value="Soltero" checked><br>
            Casado<input type="radio" name="Estado" value="Casado"><br>
            Separado<input type="radio" name="Estado" value="Separado"><br>
            Viudo<input type="radio" name="Estado" value="Viudo"><br>
    </fieldset>

    <label for="Pais" >País</label>
    <select name="Pais">
        <option value=""></option>
        <option value="1">España</option>
        <option value="2">Francia</option>
        <option value="3">Portugal</option>

    </select>

    <br>

    <textarea name="Observaciones" cols="40" rows="5">
        Indique sus Observaciones
    </textarea>

    <input type="submit" name='Enviar' value="Enviar">
    </form>


    <?php

// Recibimos los datos

    if (isset( $_GET['Enviar']) )  // Si pulso el botón enviar
    {
        // Recogemos los datos del nombre
        $nombre=$_GET['Nombre'];
        $apellido1=$_GET['Apellido1'];
        $apellido2=$_GET['Apellido2'];

        echo "EL usuario: $nombre $apellido1 $apellido2 <br>"; 

        // Recogemos los intereses

        echo "Tiene los intereses: ";
        
        if (isset($_GET['futbol'])){
            echo "Futbol ";
        }

        if (isset($_GET['tenis'])){
            echo "Tenis ";
        }

        if (isset($_GET['billar'])){
            echo "Billar ";
        }

        if (isset($_GET['Estado']))
        {
            $estado=$_GET['Estado'];
            echo "<br>Su estado civil es: $estado";
            echo "<br>";
        }

            $pais=$_GET['Pais'];
            echo "El país seleccionado es: $pais";

            $observa=$_GET['Observaciones'];
            echo "<br>";
            echo "Las observaciones son: $observa";
    }
?>

</body>
</html>