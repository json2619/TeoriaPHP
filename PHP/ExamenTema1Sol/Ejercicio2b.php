<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario PHP</title>
</head>
<body>

<?php

function ClienteDeportes($nif,$deportSelec, $deporTodos)
{
   
    $deportesNif=array();  //Array cuyos valores son los deportes que practica el cliente con ese Nif
    
    $deportesSel=array();  //Array cuyos valores son los deportes seleccionados
    
    
    foreach($deporTodos as $linea)
    {
       $campos=explode(" ",$linea);
        
       if ($nif==$campos[0])    //Si el Nif coincide  
       {
       
        $deportesNif[]=trim($campos[1]);  //Añadimos ese deporte para ese NIF  
       
       }
        
    }
    
    foreach($deportSelec as $clave=>$valor)    //Pasamos los deportes de la clave al valor del otro array
    {
        $deportesSelVal[]=trim($clave);
        
    }
    
    
 
    $resultado=array_diff($deportesNif,$deportesSelVal);  //Comprobamos la diferencia entre las claves 
    
  
    return empty($resultado);    //Si es vacio es que coincidían todos , sino es que no coincidían
    
}


function ObtenerCliDepor()    //Tenemos que hacer una función especial para el archivo Cli Depor, pues este si repite el DNi
{
    $nombre="CliDeportes.txt";
    
    $datos=array();
    
    if (file_exists($nombre)) //
    {
        $fd = fopen($nombre, "r");
        
        while ( !feof($fd) )
        {
            $linea = fgets($fd);
            
            $campos = explode(" ", $linea);
            
            if (count($campos) == 2) //
            {
                
               $datos[]=$linea;   //Tenemos que devolver la linea
              
            }
        }
        
        fclose($fd);
        
    }
    
    return $datos;
    
}


function ObtenerDatosArchivo($nombre,$numCampos)
{
    $datos=array();
    
    if (file_exists($nombre)) //
    {
        $fd = fopen($nombre, "r");
        
        while ( !feof($fd) )
        {
            $linea = fgets($fd);
            
            $campos = explode(" ", $linea);
            
            if (count($campos) == $numCampos) //
            {
                if ($numCampos==2)                  //Si el archivo tiene dos campos
                {
                    $datos[$campos[0]]=$campos[1];  //Lo metemos en par clave(campo[0]) valor campo[1]
                }
                else 
                {
                    $datos[$campos[0]]=$linea;      //Si no guardamos  clave(campo[0]) valor linea
                }
                
            }
        }
        
        fclose($fd);
        
    }
    
    return $datos;
    
}


$deportSelec=array();             //Array con los deportes previamente seleccionados

if (isset($_GET["Deportes"]) )
{
    $deportSelec=$_GET["Deportes"];
    
}

$estado="";                      //Variable para el estado civil

if (isset($_GET["Estado"]) )
{
 $estado = $_GET["Estado"];
}

$LineasMostrar=array();         //Array con las lineas a mostrar

if (isset($_GET["Enviar"] ) ) 
{
    $campos=5; //Numero de campos del archivo clientes
    
    $clientes = ObtenerDatosArchivo("Clientes.txt",$campos);        //Obtenemos los datos de todos los clientes
    
    $campos=2; //Numero de campos del archivo Clideportes
    
    $cliDeportes = ObtenerCliDepor() ; //Obtenemos los datos de todos los deportes que practican todos los clientes
    
    
    foreach($clientes as $lineaCli)
    {
        $ArraCli=explode(" ",$lineaCli);       //Convertimos la linea con los datos del cliente en array
          
        if ($estado!="")   //Si hemos recibido un estado
        {
          $estadoOk=trim($ArraCli[4])==$estado;  //Variable lógica que indica si el estado de ese cliente coincide con el introducido
        }
        else 
        {
            $estadoOk=true;
        }
        
        
        if ( !empty($deportSelec) )
        {
            
            $deportesOk=ClienteDeportes(trim($ArraCli[0]),$deportSelec, $cliDeportes);  //Función que nos dirá si el cliente con es NIF practica todos los deportes
          
        }
        else 
        {    
            $deportesOk=true;
        }
        
 
        if ($estadoOk && $deportesOk)      //Si coincide el estado y los deportes
        {
            $LineasMostrar[]=$lineaCli;    //Añadimos esa linea al Array de lineas a mostrar
            
        }
        
        
    }
    
    
}

?>

<fieldset><legend>Busqueda de Clientes</legend>

<form name='f1' method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    
    <?php
    
    // Definimos las opciones para estado civil y deportes
    
    $campos=2; //Numero de campos del archivo del que queremos sacar los datos
    
    $estados = ObtenerDatosArchivo("Estados.txt",$campos);
    $deportes = ObtenerDatosArchivo("Deportes.txt",$campos);

    // Iteramos sobre los estados civiles
    echo "<b>Estado Civil</b>:<br>";
    
    foreach ($estados as $clave=>$valor) 
    {
        echo "<input type='radio' name='Estado' value='$clave'";
        
        if ($estado == $clave ) 
        {
            echo " checked";
        }
        echo "> $valor";
    }

    echo "<br><br>";
    
    // Iteramos sobre los deportes
    echo "<b>Deportes</b>:<br>";
    foreach ($deportes as $clave=>$valor) 
    {
        echo "<input type='checkbox' name='Deportes[$clave]' ";
        
        if ( array_key_exists($clave,$deportSelec)  ) 
        {
            echo " checked";
        }
        echo ">$valor<br>";
    }
    
    
    if (!empty($LineasMostrar))  //Si hay lineas que mostrar
    {
        echo "<table border='2'>";
        echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Estado</th>";
            
        foreach($LineasMostrar as $linea)
        {
           $campos=explode(" ",$linea); 
            
           echo "<tr>";
           
           foreach($campos as $campo)
           {
              echo "<td>$campo</td>";
               
           }
           
           echo "</tr>";
        }
    
    
       echo "</table>";
    
    }
    
    ?>

    <input type="submit" name='Enviar' value="Enviar">
 </form>

</fieldset>

</body>
</html>

