<html>
<?php

require_once 'libreria.php';

$carpeta = "img"; //Carpeta donde están las imágenes

$cols = '';
if (isset($_POST['Cols'])) {
    $cols = $_POST['Cols'];
}

?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <fieldset>
            <legend>Datos de Alumnos</legend>

            <p>
                <label for='Cols'>Columnas: </label>

                <select name='Cols' onchange='document.f1.submit()'>
                    <option value=''></option>
                    <?php
                    for ($i = 1; $i < 11; $i++) {
                        echo "<option value='$i'";

                        if ($i == $cols) {
                            echo " selected ";
                        }

                        echo ">$i</option>";
                    }
                    ?>
                </select>
            </p>

        </fieldset>
    </form>
</body>

<?php

if ($cols != '') {

    $consulta = "select count(*) as total from marcas";

    $filas = ConsultaDatos($consulta);

    $total = $filas[0]['total'];

    $fils = ceil($total / $cols);

    $consulta = "select Logo from marcas";

    $filas = ConsultaDatos($consulta);

    $contImg = 0; //Contador Imágenes que mostramos

    echo "<table border='2'>";

    for ($i = 0; $i < $fils; $i++) {
        echo "<tr>";

        for ($j = 0; $j < $cols; $j++) {
            if ($contImg > $total) {
                echo "<td>&nbsp</td>";
            } else {
                echo "<td><img src ='$carpeta/{$filas[$contImg]['Logo']}' width='80' height='80'></td>";
            }
            $contImg++;
        }

        echo "</tr>";
    }

    echo "</table>";
}

?>

</html>