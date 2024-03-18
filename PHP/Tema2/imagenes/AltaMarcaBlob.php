<html>

<body>
    <?php

    require_once 'libreria2.php';

    if (isset($_POST['Enviar'])) {
        $nombre = $_POST['Nombre'];

        $tam = $_FILES['Logo']['size'];

        $nomArchivo = $_FILES['Logo']['name'];

        $nomTemp = $_FILES['Logo']['tmp_name'];

        //echo "Los datos del archivo son: $nomArchivo tamaño ".($tam/1000) ." y nombre temporal $nomTemp ";
    
        $logoConte = file_get_contents($nomTemp); //Extraemos el contenido en una variable
    
        $logoConte = base64_encode($logoConte); // Codificamos el archivo en base_64 para evitar errores y mostrarlo de manera efectiva.
    
        $consulta = "insert into Marcas values (NULL,'$nombre','$logoConte')";


        ConsultaSimple($consulta);

    }



    ?>


    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Alta de Marcas con Blobs</legend>

            <label for='Nombre'>Nombre </label>
            <input type='text' name='Nombre'><br>
            <label for='Logo'>Logo</label>
            <input type='file' name='Logo'>
            <br>
            <input type='submit' name='Enviar'>

        </fieldset>





</html>