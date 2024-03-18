<?php

//Conectar a BBDD con PDO

$usuario="root";
$clave="";

$host="localhost";
$dbname="Tema2Blobs";

$dns="mysql:host=$host;dbname=$dbname";


try {
    $pdo = new PDO($dns, $usuario, $clave);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    
    }
    
    
    $consulta="select * from Profesores ";
    
    $sta=$pdo->prepare($consulta);  //Preparamos la consulta y recibimos el obejto de tipo statement
    
    $param=array();
    
    $sta->execute($param);   //Ejecutamos la consulta
    
    $filas=$sta->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($filas as $fila)
    {
        echo $fila['IdFoto']." ". $fila['IdPro'].",".$fila['Foto'];
        echo "<br>";
    }
    
   
    /*
    
    while($fila=$sta->fetch(PDO::FETCH_ASSOC)    )  
    {
        echo $fila['Apellido1']." ". $fila['Apellido2'].",".$fila['Nombre'];
        echo "<br>";
        
    }
    
    
    */
    
    /* Ejemplo consulta Simple con PDO
      
    $nif="98765432J";
    
    $consulta="delete from Profesores where NIF=:nif";

    $sta=$pdo->prepare($consulta);  //Preparamos la consulta para su ejecución

    $param=array(":nif"=>$nif);  //Creamos el array con los parámetros de sustitución

    $sta->execute($param);      //Ejecutamos la consulta preparado con ese array de parámetros   

    
    $pdo=null; //Cerramos la conexión
    
    
    */
    
    
    
?>