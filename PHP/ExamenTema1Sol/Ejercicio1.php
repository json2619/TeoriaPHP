<!DOCTYPE html>
<html>
<head>
    <title>Generador de Tablas</title>
</head>
<body>

<?php

$filas ="";
$columnas = "";

$subfilas =1;
$subcolumnas = 1;

function MostrarSubTablas($subfilas,$subcolumnas,$DatosTabla)    //Muestra los datos contenidos en esa matriz de tabla en subtablas
{
    
    $numEle=count($DatosTabla);   //Contamos los elementos que tiene la matriz
    
    $numTablas=ceil( $numEle/($subfilas*$subcolumnas) );   //Calculamos las tablas que harían falta
    
    $cont=0;  //Contador de elementos que vamos mostrando
    
    for($i=0;$i<$numTablas;$i++)
    {
        echo "<table border='2'>";
        
        for($j=0;$j<$subfilas;$j++)
        {
           echo "<tr>"; 
            
           for($k=0;$k<$subcolumnas;$k++)
           {
               if (isset($DatosTabla[$cont]))
               {
                   echo "<td>".$DatosTabla[$cont]."</td>";
                   $cont++;
               }
               else 
               {
                   echo "<td>&nbsp</td>";
               }
               
           }
               
           echo "</tr>";
        }
        
        echo "</table>";
        
    }
    
}


function ConvertirMatriz($tabla,$tablaFil,$tablaCol)
{
    $MatrizTabla=array(); //Matriz original a reconstruir
    
    $DatosTabla=array(); //Array con los datos del campo oculto deserializado
    
    $DatosTabla=explode(",",$tabla);
    
    $cont=0; //Contador de elementos del array Datos tabla
    
    for($i=0;$i<$tablaFil;$i++)
    {
        for($j=0;$j<$tablaCol;$j++)
        {
            $MatrizTabla[$i][$j]=$DatosTabla[$cont];
            $cont++;
        }
            
    }
    
    return $MatrizTabla;
}



function CamposOcultos($cadTabla,$filas,$columnas)               //Guardamos en campos ocultos los datos de las matriz, sus filas y columnas
{
   echo "<input type='hidden' name='Tabla' value='$cadTabla' >";
   
   echo "<input type='hidden' name='TablaFil' value='$filas' >";
    
   echo "<input type='hidden' name='TablaCol' value='$columnas' >";
}



function MostrarDividir($subfilas,$subcolumnas)         //Función que muestra los controles para dividir la table
{
    echo "</fieldset>";
    
    echo "<fieldset><legend>Dividir en subtablas</legend>";
    
    echo    "<label for='SubFilas'>SubFilas:</label>";
    echo      "<select name='SubFilas' >";
    echo        "<option value=''></option>";
    
    for ($i = 1; $i <= 10; $i++)
    {
        echo "<option value='$i' ";
        
        if ($subfilas == $i)
        {
            echo " selected ";
        }
        
        echo ">$i</option>";
        
    }
    
    echo      "</select>";
    
    echo      "<label for='SubColumnas'>SubColumnas:</label>";
    echo        "<select name='SubColumnas' >";
    echo           "   <option value=''></option>  ";
    
    for ($i = 1; $i <= 10; $i++)
    {
        echo "<option value='$i' ";
        
        if ($subcolumnas == $i)
        {
            echo " selected ";
        }
        
        echo ">$i</option>";
        
    }
    
    echo         "</select>";
    
    echo       "<input type='submit' name='Dividir' value='Dividir'>";
    
    echo      "</fieldset>"; 
    
    
    
}

function RellenarTabla($filas,$columnas)     //Rellena una tabla con números al azar y la devuelve en un matriz
{
   $MatrizTabla=array(); 
    
   for ($i = 0; $i < $filas; $i++) 
   {
      
       for ($j = 0; $j < $columnas; $j++)
       {
           $MatrizTabla[$i][$j] = rand(1, 30);     
       }
       
   }
   
   return $MatrizTabla;
}


function MostrarTabla($MatrizTabla)           //Función que muestra la tabla generada
{
    $cadTabla="";
     
    echo "<table border='2'>";
    
    foreach ($MatrizTabla as $filas) 
    {
        echo "<tr>";
        
      foreach ($filas as $campo)
      {
        
            if ($cadTabla=="")    //Si la cadena de la tabla esta vacia
            {
                $cadTabla.=$campo;  //Le concatenamos el numero
            }
            else 
            {
                $cadTabla.=",".$campo;  //Le concatenamos el numero y el separador
            }
                
             
            echo "<td>$campo</td>";
        }
        
        echo "</tr>";
    }
    
    echo "</table>";
   
    return  $cadTabla;  //Devolvemos la tabla serializada
}


if(isset($_GET['Filas']))
{
    $filas = $_GET['Filas'];
}

if(isset($_GET['Columnas']))
{
    $columnas = $_GET['Columnas'];
}

if(isset($_GET['SubFilas']))
{
    $subfilas = $_GET['SubFilas'];
}

if(isset($_GET['SubColumnas']))
{
    $subcolumnas = $_GET['SubColumnas'];
}


?>


<fieldset><legend>Tabla Original</legend>
<form name='f1'method='get' action=<?php $_SERVER['PHP_SELF']; ?> >
    <label for="Filas">Filas:</label>
    <select name="Filas" >
     <option value=''></option>
        <?php
        for ($i = 1; $i <= 10; $i++) 
        {
            echo "<option value='$i' ";
            
            if ($filas == $i) 
            {
              echo " selected ";
            } 
               
            echo ">$i</option>";
            
        }
        ?>
    </select>

    <label for="Columnas">Columnas:</label>
     
    
    <select name="Columnas" >
      <option value=''></option> 
     
        <?php
        
        for ($i = 1; $i <= 10; $i++)
        {
            echo "<option value='$i' ";
            
            if ($columnas == $i)
            {
                echo " selected ";
            }
            
            echo ">$i</option>";
            
        }
        ?>
    </select>

    <input type="submit" name="Enviar" value="Enviar">
   
<?php   


if (isset($_GET['Enviar']) )
{
    
            $MatrizTabla=RellenarTabla($filas,$columnas);   //Rellenamos la tabla y la guardamos en un matriz
                
            $cadTabla=MostrarTabla($MatrizTabla);           //Mostramos la matriz y devolvemos el resultado en un strin
    
            MostrarDividir($subfilas,$subcolumnas);         //Mostramos la parte del formulario para dividir la matriz
   
            CamposOcultos($cadTabla,$filas,$columnas);      //Creamos los campos ocultos
                 
            
}

if (isset($_GET['Dividir']) )
{
    //Recogemos los datos de los campos ocultos con los datos de la tabla creada y sus dimensiones
    
    $tabla=$_GET['Tabla'];
    $tablaFil=$_GET['TablaFil'];
    $tablaCol=$_GET['TablaCol'];
    
    $DatosTabla=explode(",",$tabla);   //Sacamos los datos del campo oculto en un array lineal

    $MatrizTabla=ConvertirMatriz($tabla,$tablaFil,$tablaCol);              //Volvemos a convertir en Matriz a patir del campo oculto y las dimensiones
    
    $cadTabla=MostrarTabla($MatrizTabla);
    
    MostrarDividir($subfilas,$subcolumnas);                 //Mostramos la parte del formulario para dividir la matriz
    
    MostrarSubTablas($subfilas,$subcolumnas,$DatosTabla);  //Mostramos esa matriz en subtablas de esa dimensión
    
    CamposOcultos($cadTabla,$filas,$columnas);      //Mostramos los campos ocultos
}


            
?>     
    
    
</form>


</body>
</html>

