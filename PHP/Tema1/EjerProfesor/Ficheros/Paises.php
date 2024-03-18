<!DOCTYPE html>
<html>
<!-- Formulario fielset Alta de Paises. campo Pais y un botón Guardar y se guarada en paises.txt
en el archivo (id)1 (espacio) España, si hay mas paises 2 Francia... -->

<body>
    <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Alta de Paises</legend>
            <label for='Pais'>País: </label><input type='text' name='Pais'>

            <input type='submit' name='Guardar' value='Guardar'>
        </fieldset>

    </form>
</body>

</html>

<?php

function ExistePais($pais)     //Funcion que no indica si ya existe un pais con ese nombre
{
    $existe=false;
    
    if (file_exists("Paises.txt")) //
    {
        $fd = fopen("Paises.txt", "r");
        
        while ( !feof($fd) && (!$existe)  ) 
        {
                $linea = fgets($fd);
                
                $campos = explode(" ", $linea);
                
                if (count($campos) == 2) //
                {
                    $campos[1]=strtolower($campos[1]);
                    $pais=strtolower($pais);
                    
                    $existe=(trim($campos[1])==$pais );
                    
                }
         }
            
            fclose($fd);
    
     }
            
      return $existe;
}



function SigId()
{
    $Id = 1;

    $Ids = array();

    if (file_exists("Paises.txt")) //
    {
        $fd = fopen("Paises.txt", "r");

        if ($fd !== false) // 
        {
            while (!feof($fd)) //
            {
                $linea = fgets($fd);

                $campos = explode(" ", $linea);

                if (count($campos) == 2) //
                {
                    $Ids[] = $campos[0];
                }
            }

            fclose($fd);
        }

        if (count($Ids) > 0) // Si habia array en el id 
        {

            $Id = intval(max($Ids)) + 1;
        }
    }
    return $Id;
}

if (isset($_GET['Guardar'])) //
{
    $pais = $_GET['Pais'];

    if (!ExistePais($pais) )
    {
    
            $id = SigId();
        
            $salto = "\n";
        
            $linea = $id . " " . $pais . $salto;
        
            $fd = fopen("Paises.txt", "a+") or die("Error al abrir el archivo de Paises");
        
            fputs($fd, $linea);
        
            fclose($fd);
    }
    else 
    {
        echo "<b>ERROR, Ya existe un Pais con ese nombre</b>";
    }
        
            
}

?>
