<html>

<body>
    <?php

    require_once 'libreria.php';

    if (isset($_POST['Enviar'])) {
        $nombre = $_POST['Nombre'];

        $tam = $_FILES['Logo']['size'];

        $nomArchivo = $_FILES['Logo']['name'];
        $nomTemp = $_FILES['Logo']['tmp_name'];

        //echo "Los datos del archivo son: $nomArchivo tamaño ".($tam/1000) ." y nombre temporal $nomTemp ";
    
        copy($nomTemp, "imagenes/" . $nomArchivo);  //copiamos el archivo desde la carpeta temporal a la carpeta de imagenes con su nombre original
    
        $consulta = "insert into Marcas values (NULL,'$nombre','$nomArchivo')";

        ConsultaSimple($consulta);

    }



    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Alta de Marcas</legend>

            <label for='Nombre'>Nombre </label>
            <input type='text' name='Nombre'><br>
            <label for='Logo'>Logo</label>
            <input type='file' name='Logo'>
            <br>
            <input type='submit' name='Enviar'>

        </fieldset>





</html>