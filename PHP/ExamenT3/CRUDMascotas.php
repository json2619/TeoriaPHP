<html>
<?php

require_once 'DaoMascotas.php';
require_once 'DaoFamilias.php';

$base = "marzo";

$daoFam = new DaoFamilias($base);
$daoMasc = new DaoMascotas($base);


$fam = '';
if (isset($_POST['Familia'])) {
    $fam = $_POST['Familia'];
}

function FotoAnterior($Id)   //Recibimos el Id y devolvemos la foto anterior
{
    global $daoMasc;

    $mascota = $daoMasc->obtener($Id);

    return $mascota->__get("Foto");

}


function ConvertirLegible($fechaSeg)
{
    $campos = getdate($fechaSeg);

    $fechaLeg = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];

    return $fechaLeg;
}




if (isset($_POST['Actualizar']) && isset($_POST['Selec']))  //ÇSi hemos seleccionado algun mascotamno y marcado actualizar
{

    $selec = $_POST['Selec']; //Recogemos los códigos del los checkboxes seleccionados

    //Recogemos el resto de los arrays con los datos de los mascotamnos

    $nombres = $_POST['Nombres'];
    $familias = $_POST['Familias'];
    $fechaNacs = $_POST['Fechas'];


    foreach ($selec as $clave => $valor) //Para cada uno de los mascotamnos seleccinados
    {
        $camposFecha = explode("/", $fechaNacs[$clave]);  //Convertimos la fecha dd/mm/yyyy a segundos Epoch

        $fechaEpoch = mktime(0, 0, 0, $camposFecha[1], $camposFecha[0], $camposFecha[2]);

        $foto = FotoAnterior($clave); //Suponemos por defecto que el valor del campo foto es vacio

        if ($_FILES['Fotos']['name'][$clave] != '')   //Si hemos adjuntado el nombre de un archivo
        {

            $temp = $_FILES['Fotos']['tmp_name'][$clave];

            $conte = file_get_contents($temp);

            $conte = base64_encode($conte);

            $foto = $conte;
        }


        $mascota = new mascota();

        $mascota->__set("Id", $clave);
        $mascota->__set("Nombre", $nombres[$clave]);
        $mascota->__set("Familia", $familias[$clave]);
        $mascota->__set("FechaNac", $fechaEpoch);
        $mascota->__set("Foto", $foto);

        $daoMasc->actualizar($mascota);  // Actualizamos ese mascotamno

    }


}

if (isset($_POST['Borrar']) && isset($_POST['Selec'])) {

    $selec = $_POST['Selec']; //Recogemos los códigos del los checkboxes seleccionados

    foreach ($selec as $clave => $valor) //Para cada uno de los mascotamnos seleccinados
    {
        $daoMasc->borrar($clave);  // Actualizamos ese mascotamno

    }


}

if (isset($_POST['Insertar']))  //Si hemos pulsado insertar
{
    $Id = $_POST['Id'];
    $nombre = $_POST['Nombre'];
    $familia = $_POST['Familia'];
    $fechaNac = $_POST['Fecha'];

    echo $fechaNac;

    $camposFecha = explode("/", $fechaNac);  //Convertimos la fecha dd/mm/yyyy a segundos Epoch

    $fechaEpoch = mktime(0, 0, 0, $camposFecha[1], $camposFecha[0], $camposFecha[2]);

    $foto = ""; //Suponemos por defecto que el valor del campo foto es vacio

    if ($_FILES['Foto']['name'] != '')   //Si hemos adjuntado el nombre de un archivo
    {

        $temp = $_FILES['Foto']['tmp_name'];

        $conte = file_get_contents($temp);

        $conte = base64_encode($conte);

        $foto = $conte;
    }

    $mascota = new mascota();

    $mascota->__set("Id", $Id);
    $mascota->__set("Nombre", $nombre);
    $mascota->__set("Familia", $familia);
    $mascota->__set("FechaNac", $fechaEpoch);
    $mascota->__set("Foto", $foto);

    $daoMasc->insertar($mascota);

}

if (isset($_POST['Buscar'])) {
    $nombre = $_POST['Nombre'];
    $familia = $_POST['Familia'];

    $daoMasc->listFamNom($familia, $nombre);

    echo "<table border='2'>";

    echo "<th>Id</th>
             <th>Nombre</th>
             <th>Familia</th>
             <th>FechaNac</th>
             <th>Foto</th>";

    foreach ($daoMasc->mascotas as $mascota) {

        echo $mascota->__get("Id");

        echo "<tr>";
        echo "<td>" . $mascota->__get("Id") . "</td>";
        echo "<td><input type='text' name='Nombre' value='" . $mascota->__get("Nombre") . "' size='9'></td>";

        $familia = $daoFam->obtenerNomFam($mascota->__get("Familia"));

        echo "<td><input type='text' name='Familia' value='" . $familia->__get("Nombre") . "' size='9'></td>";


        $fechaLeg = ConvertirLegible($mascota->__get("FechaNac"));

        echo "<td><input type='text' name='Fecha' value='" . $fechaLeg . "' size='9' ></td>";

        $conte = $mascota->__get("Foto");

        echo "<td>";
        echo "<img src='data:image/jpg;base64,$conte' width=70 height=70>";
        echo "<input type='file' name='Foto'>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
}


?>


<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend><b>Mantenimiento(CRUD) de la tabla Mascotas</b></legend>

            <?php

            echo "<input type='submit' name='Insertar' value='Insertar'>";
            echo "<input type='submit' name='Buscar' value='Buscar'>";
            echo "<input type='submit' name='Actualizar' value='Actualizar'>";
            echo "<input type='submit' name='Borrar' value='Borrar'>";

            $daoMasc->listar();

            echo "<table border='2'>";
            echo "<th>Selec</th>
             <th>Id</th>
             <th>Nombre</th>
             <th>Familia</th>
             <th>FechaNac</th>
             <th>Foto</th>";

            //Creamos la fila de insercción
            
            echo "<tr>";

            echo "<td>*</td>";
            echo "<td><input type='text' name=Id size='9'></td>";
            echo "<td><input type='text' name=Nombre size='30'></td>";

            echo "<td>";

            echo "<select name='Familia' >";
            echo "<option value=''></option>";

            $daoFam->listar();

            foreach ($daoFam->familias as $familia) {
                echo "<option value='" . $familia->__get('Id') . "'";

                if ($fam == $familia->__get('Id')) {
                    echo " selected ";
                }

                echo ">" . $familia->__get('Nombre') . "</option>";
            }

            echo "</select>";

            echo "</td>";

            echo "<td><input type='text' name='Fecha' placeholder='dd/mm/yyyy' size='9' ></td>";

            echo "<td><input type='File' name='Foto'></td>";

            echo "</tr>";


            foreach ($daoMasc->mascotas as $mascota) {
                echo "<tr>";

                echo "<td><input type='checkbox' name=Selec[" . $mascota->__get("Id") . "]></td>";
                echo "<td>" . $mascota->__get("Id") . "</td>";
                echo "<td><input type='text' name='Nombres[" . $mascota->__get("Id") . "]' value='" . $mascota->__get("Nombre") . "' size='9'></td>";

                echo "<td>";
                echo "<select name='Familias[" . $mascota->__get("Id") . "]' >";

                $daoFam->listar();

                foreach ($daoFam->familias as $familia) {
                    echo "<option value='" . $familia->__get('Id') . "'";

                    if ($mascota->__get("Familia") == $familia->__get('Id')) {
                        echo " selected ";
                    }

                    echo ">" . $familia->__get('Nombre') . "</option>";
                }

                echo "</td>";

                $fechaLeg = ConvertirLegible($mascota->__get("FechaNac"));  //Hay que convertir la fecha de nacimiento a formato legible
            
                echo "<td><input type='text' name='Fechas[" . $mascota->__get("Id") . "]' value='" . $fechaLeg . "' size='9' ></td>";

                $conte = $mascota->__get("Foto");

                echo "<td>";
                echo "<img src='data:image/jpg;base64,$conte' width=70 height=70>";
                echo "<input type='file' name='Fotos[" . $mascota->__get("Id") . "]'>";
                echo "</td>";

                echo "</tr>";
            }

            echo "</table>";

            ?>
        </fieldset>
    </form>
</body>

</html>