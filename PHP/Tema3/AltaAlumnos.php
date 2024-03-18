<html>
<?php

require_once 'libreria.php';
require_once 'DaoAlumnos.php';

?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Datos de alus</legend>

            <label for='NIF'>NIF </label><input type='text' name='NIF'>
            <p></p>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre'>
            <p></p>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'>
            <p></p>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'>
            <p></p>
            <label for='Telefono'>Telefono </label><input type='text' name='Telefono'>
            <p></p>
            <label for='Premios'>Premios </label><input type='text' name='Premios'>
            <p></p>
            <label for='FechaNac'>Fecha Nacimiento: </label><input type='text' name='FechaNac' placeholder='dd/mm/year'>
            <p></p>
            <label for='Foto'>Foto alumno:</label>
            <input type='file' name='Foto'>
            <p></p>
            <input type='submit' name='Guardar' value='Guardar'>

        </fieldset>
    </form>
</body>

<?php

if (isset($_POST['Guardar'])) {

    $daoAl = new DaoAlumnos("tema2blobs");

    $nif = $_POST['NIF'];
    $nombre = $_POST['Nombre'];
    $apellido1 = $_POST['Apellido1'];
    $apellido2 = $_POST['Apellido2'];
    $telefono = $_POST['Telefono'];
    $premios = $_POST['Premios'];
    $fechaNac = $_POST['FechaNac'];

    $campoFecha = explode("/", $fechaNac);

    $fechaEpoch = mktime(0, 0, 0, $campoFecha[1], $campoFecha[0], $campoFecha[2]);

    $foto = ""; // Suponemos por defecto el campo foto está vacio en casa de tener alguna foto se guardará abajo

    if ($_FILES['Foto']['name'] != '') {

        $temp = $_FILES['Foto']['tmp_name'];

        $conte = file_get_contents($temp);

        $conte = base64_encode($conte);

        $foto = $conte;
    }

    $alu = new Alumno();

    $alu->__set("NIF", $nif);
    $alu->__set("Nombre", $nombre);
    $alu->__set("Apellido1", $apellido1);
    $alu->__set("Apellido2", $apellido2);
    $alu->__set("Telefono", $telefono);
    $alu->__set("Premios", $premios);
    $alu->__set("FechaNac", $fechaEpoch);
    $alu->__set("Foto", $foto);

    $daoAl->insertar($alu);
}


?>


</html>