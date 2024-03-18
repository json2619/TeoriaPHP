
<!DOCTYPE html>
<html>

<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Insercción de Alumnos en BBDD</legend>
            <label for='NIF'>NIF </label><input type='text' name='NIF'>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'>  
            <label for='Telefono'>Telefono </label><input type='text' name='Telefono'> 
            <label for='Premios'>Premios </label><input type='text' name='Premios'><br>
          
            <input type='submit' name='Guardar' value='Guardar'>
        </fieldset>

    </form>
</body>

</html>




<?php









?>