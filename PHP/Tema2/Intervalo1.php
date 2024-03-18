<html>


<?php 

$fechaini='';

require_once 'FuncionesFechas.php';

function MesAnt($mes)
{
  if ($mes==12)  
  {
     $mes=1; 
  }
  else
  {
     $mes--; 
  }
  
  return $mes;
}



function SiguienteMes($mes)
{
    
   if ($mes==12) 
   {
     $mes=1;  
   }
   else 
   {
      $mes++;
   }
   
  return $mes; 
   
}

function CalcDifDias($camposFin,$camposIni)
{
    
    if ($camposFin['mday']>=$camposIni['mday'] ) 
    {
        $dias=$camposFin['mday']-$camposIni['mday'];  //Añadimos los dias adicionales
        
    }
    else  //El último mes es no esta completo
    {
        $mesAnt=MesAnt($camposFin['mon']);  //Hallamos el mes anterior al de la fecha fin
        
        if ($mesAnt==12)                   //Si es Dicimebre restamos al año
        {
            $anio=$camposFin['year']-1;
        }
        
        $dias=$camposFin['mday']+( DiasMes($mesAnt,$anio)-($camposIni['mday']-1) );  //Formula para sacar los dias entre dos fechas de diferentes meses, siendo el dia de inicio posterior al de fin
        
        
    }
    
  return $dias;  

}



function CalcMesesDias($camposFin,$camposIni)   //Calcula la diferencia en meses y dias
{
   $DiasMeses=array();  //Array que devuelve la diferencia en meses y dias
   
   if ( $camposFin['mon']>=$camposIni['mon']  )  // si el mes del fin es posterior al de la fecha inicial
   {
       $meses+=($camposFin['mon']-$camposIni['mon']);   //Calculamos la diferencia en meses
       
       if ($camposFin['mday']<$camposIni['mday']  )  // Si el dia del de fecha final es anterior
       {
           $meses--;  //Hay que restar un mes
           
       }
       
   }
       
       

       CalcDifDias($camposFin,$camposIni);  // Calculamos los dias de diferencia
   
       $DiasMeses[0]=$meses;
       $DiasMeses[1]=$dias;
    
   return $DiasMeses;
}


function DifMeses($ini,$fin)
{
    
    $salida=array();
    
    //Contadores de meses, semanas y dias
    
    $meses=0;
    $semanas=0;
    $dias=0;
    
    $mesAnt=0;
    
    $anio=0;
    
    //Indicadores del dia, mes y año de la fecha incial
    
    $camposIni=getdate($ini);
    
    $camposFin=getdate($fin);
    
    if ( $camposFin['year']>=$camposIni['year']  )   //Si el año de fin es mayor que el año de inicio
    {
        $anios=(  $camposFin['year']-$camposIni['year']  );  //Restamos la diferencia en años
        
        if ( $camposFin['mon']<$camposIni['mon']  )  // si el mes de fin es anterior al mes inicial
        {
            $anios--;  //No se cumple el ultimo año completo
           
        } 
        
        //calculamos la diferencia en meses y dias entre las fechas
         
        $DiasMeses=CalcMesesDias($camposFin,$camposIni);
        
        
    }
    
    $semanas=floor($DiasMeses[1]/7);
    
    $dias=$DiasMeses[1]%7;
    
    
    $salida[0]=$DiasMeses[0]+($anios*12);   //Los meses son los años multiplicado por 12 mas la diferencia entre los meses
    $salida[1]=$semanas;
    $salida[2]=$dias;
    
    return $salida;
    
    
    
}

/*

function DifMeses2($ini,$fin)
{
    $salida=array();
    
    //Contadores de meses, semanas y dias
    
    $meses=0;
    $semanas=0;
    $dias=0;
    
    //Indicadores del dia, mes y año de la fecha incial
    
     $campos=getdate($ini);
     
     $dia=$campos['mday'];
     
     $mes=$campos['mon'];
     $anio=$campos['year'];
     
     
     $mesSig=SiguienteMes($mes);   //Obtenemos el siguiente mes al actual
     
     if ($mesSig==1)
     {
      $anio=$anio+1;      // Y el siguiente año
     }
     
     
     if ( $dia>DiasMes($mesSig,$anio)  )   //Si el dia de inicio es mayor que el número de días del mes siguiente
     {
         $dia=1;          //Fijamos el día de inicio al dia 1 del mes siguiente
         $mes=$mesSig;
         
         $ini=mktime(0,0,0,$mes,$dia,$anio);  // Fijamos la marca Epoch de inicio a ese dia
        
     }
     
     $diaAct=$ini;
     
     while($diaAct<=$fin)     //Mientras no lleguemos a la fecha fin
     {
         $dias++;   //Contamos un día
         
         $diaAct=SigDia($diaAct);  //Avanzamos al siguiente dia
         
         if ($dias==7)   //Si contamos 7 dias
         {
             $semanas++; // Incrementamos el contador de semanas
             
             $dias=0;    // Resesteamos el contador de dias
             
         }
         
         $camposAct=getdate($diaAct);  //Necesitamos los datos de este dia (dia,mes..)
         
         if ( ($camposAct['mday']==$dia  )   )  //Si volvemos al mismo numero de día que el día de partida
         {
             $meses++;  //Contamos un mes
             
             $semanas=0;
             $dias=0;
            
         }
         
         
     }
     
     $salida[0]=$meses;
     $salida[1]=$semanas;
     $salida[2]=$dias;
     
   return $salida;
    
}

*/


function DifSemanas($ini,$fin)
{
    $salida=array(); 
    
    
    if ($fin>=$ini ) 
    {
      
        $segSemana=(60*60*24*7);
        
        $segDia=(60*60*24);
        
        $diferencia=($fin-$ini);     //Calculamos la diferencia
        
        $semanas=intdiv($diferencia,$segSemana);
        
        $resto=($diferencia%$segSemana);
        
        $dias=($resto/$segDia);
        
        $salida[0]=$semanas;
        $salida[1]=$dias;
    
    }
    
   return $salida;
   
}

function DifSegundos($ini,$fin)    //Devuelve la diferencia en segundos entre ambas fechas
{
    if ($fin<$ini)
    {
      $diferencia=FALSE; 
        
    }
    else
    {
        $diferencia=$fin-$ini;
    }
    
  return $diferencia;  
}

if (isset($_POST['FechaIni'] ) )
{
    $fechaini=$_POST['FechaIni'];
}

$fechafin='';

if (isset($_POST['FechaFin'] ) )
{
    $fechafin=$_POST['FechaFin'];
}

$unidad='';

if (isset($_POST['Unidades'] ) )
{
    $unidad=$_POST['Unidades'];
}


?>


<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Intervalo de fechas</legend>
            
            
            <label for='FechaIni'>Fecha Inicial</label>
            <input type='text' name='FechaIni' placeholder='dd/mm/year' value='<?php echo $fechaini; ?>'><br>
            <label for='FechaFin'>Fecha Final </label>
            <input type='text' name='FechaFin' placeholder='dd/mm/year' value='<?php echo $fechafin; ?>'><br>
            
            
            <label for='Unidades'>Unidades:</label>
            
            <?php 
            
            $unidades=array('Segundos','Minutos','Horas','Dias','Semanas','Meses','Años');
            
            foreach ($unidades as $clave=>$valor)
            {
               echo "<input type='radio' name='Unidades' value='$clave' ";

               if ($clave==$unidad)
               {
                 echo " checked ";  
                   
               }
               echo ">$valor";  
            }
            
            
            ?>  
            
          
            <br>
            <input type='submit' name='Mostrar' value='Mostrar'>
            
           </fieldset> 
     </form>  
  </body>   
</html>

<?php 

if (isset($_POST['Mostrar']) )
{
   
    $diferencia=0;  //Variable para mostrar la diferencia entre fechas en las unidades indicadas
    
    $campos=explode("/", $fechaini);    //Cogemos la fecha en tipo strin dd/mm/yyyyy y la dividimos en campos
     
    $ini=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);  //Con esos campos calculamos el valor epoch 
    
    $campos=explode("/", $fechafin);    //Cogemos la fecha en tipo strin dd/mm/yyyyy y la dividimos en campos
    
    $fin=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);  //Con esos campos calculamos el valor epoch 
    
   
    switch ($unidad)
    {
    case 0:   $diferencia=DifSegundos($ini,$fin);
             
              if ($diferencia)  //Si ha diferencia
              {
                  echo "La diferencia en segundos es: ".$diferencia;
              }
              else 
              {
                 echo "<b>ERROR, valores de intervalo incorrectos</b>"; 
              }
              
              break;
              
    case 1:   $diferencia=DifSegundos($ini,$fin);
    
    if ($diferencia)  //Si ha diferencia
    {
        echo "La diferencia en minutos es: ".($diferencia/60);
    }
    else
    {
        echo "<b>ERROR, valores de intervalo incorrectos</b>";
    }
    
    break;
    
    case 2:   $diferencia=DifSegundos($ini,$fin);
    
    if ($diferencia)  //Si ha diferencia
    {
        echo "La diferencia en horas es: ".( ($diferencia)/(60*60) );
    }
    else
    {
        echo "<b>ERROR, valores de intervalo incorrectos</b>";
    }
    
    break;
    
    case 3:   $diferencia=DifSegundos($ini,$fin);
    
    if ($diferencia)  //Si ha diferencia
    {
        echo "La diferencia en dias es: ".( ($diferencia)/(60*60*24) );
    }
    else
    {
        echo "<b>ERROR, valores de intervalo incorrectos</b>";
    }
    
    break;
    
    case 4:   $salida=DifSemanas($ini,$fin);
    
    if (!empty($salida))  //Si la salida no es un array vacio
    {
        echo "La diferencia en semanas es: $salida[0] semanas y $salida[1] dias" ;
    }
    else
    {
        echo "<b>ERROR, valores de intervalo incorrectos</b>";
    }
    
    break;
    
    
    case 5:   $salida=DifMeses($ini,$fin);
    
    if (!empty($salida))  //Si la salida no es un array vacio
    {
        echo "La diferencia en meses es:  $salida[0] meses $salida[1] semanas $salida[2] dias";
    }
    else
    {
        echo "<b>ERROR, valores de intervalo incorrectos</b>";
    }
    
    break;
    
    
    
    
    }
    
}






?>

