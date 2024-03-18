<html>
<body>


    <?php 
    
    $mes='';
    $anio='';
    
    if ( isset($_POST['Enviar'] ) )
    {
        $mes=$_POST['Mes'];
        $anio=$_POST['Anio'];
    }
    
    if ( isset($_GET['Mes']) && isset($_GET['Anio'])   )
    {
        
        $mes=$_GET['Mes'];
        $anio=$_GET['Anio'];
        
    }
 
   ?>

   <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Calendario</legend>
     
     <label for='Mes'>Mes:</label>
     <input type='text' name='Mes' value='<?php echo $mes ; ?>'>
     
     <label for='Anio'>Año:</label>
     <input type='text' name='Anio' value='<?php echo $anio ; ?>'>
    
     <input type='submit' name='Enviar' value='Enviar'>
   
    </fieldset>
    
   
   <?php  
    
    function Anteriores($mes,$anio)
    {
       $anteriores=array();
        
       if ($mes>1) //Si no estamos en el primer mes del año
       {
          $mes--;   
       }
       else
       {
           $mes=12;
           $anio--;
       }
       
       $anteriores[0]=$mes;
       $anteriores[1]=$anio;
       
     return $anteriores; 
       
    }
    
    function Siguientes($mes,$anio)
    {
        $siguientes=array();
        
        if ($mes<12) //Si no estamos en el último mes del año
        {
            $mes++;
        }
        else
        {
            $mes=1;
            $anio++;
        }
        
        $anteriores[0]=$mes;
        $anteriores[1]=$anio;
        
        return $anteriores;
        
    }
    
    
    
    function SigDia($dia)    //Recibe un dia eh formato Epoch y devuelve la marca Epoch de dia siguiente
    {
        $dia+=(60*60*25);  //Le sumamos los segundos de un diá y una hora más
        
        $campos=getdate($dia);
        
        $dia=mktime(0,0,0,$campos['mon'],$campos['mday'],$campos['year']);
        
        return $dia;
        
    }
    
    function DiasMes($mes,$anio)
    {
        $contDias=0;  //Contador dias
        
        $diaSeg=mktime(0,0,0,$mes,1,$anio);   //Cogemos la marca Epoch de dia 1 de ese mes
        
        do
        {
            $contDias++;  //Incrementamos el contador de dias
            
            $diaSeg=SigDia($diaSeg);  //Avanzamos al siguiente dia
            
            $campos=getdate($diaSeg);
            
            
        } while ($mes== $campos['mon'] );
        
        return $contDias;
        
    }
    
    
    
    
    if ( ($mes!='') && ($anio!='')  )
    {
        
        $contDia=1;  //Empezamos con el dia 1 del mes
        
        $segDia=mktime(0,0,0,$mes,$contDia,$anio); //Sacamos la marcha Epoch del dia 1 de ese mes y año
        
        $campos=getdate($segDia);
        
        $diaIniSem=$campos['wday'];  //Comprobamos que dia de la semana(En número) corresponde
        
        if ($diaIniSem==0)  //Si es Dominego
        {
            $diaIniSem=7;   
        }
            
        
        $celdasPrevias=$diaIniSem-1;  //Calculamo el numero de celdas que preceden al día 1 de ese mes
        
        $DiasMes=DiasMes($mes,$anio);  //Calculamos los dias para ese mes y año
        
        $semanas=ceil( ($celdasPrevias+$DiasMes)/7 ) ;   //Calculamos las semanas que va a tener ese mes
        
        
       
        echo "<fieldset>";
        
        $ant=Anteriores($mes,$anio);   //Funcion que devolvera un array con el mes y año siguientes al dado
        
        echo "Prev <a href='$_SERVER[PHP_SELF]?Mes=$ant[0]&Anio=$ant[1]'> < </a>&nbsp&nbsp";
        
        $sig=Siguientes($mes,$anio);   //Funcion que devolvera un array con el mes y año siguientes al dado
        
        echo "<a href='$_SERVER[PHP_SELF]?Mes=$sig[0]&Anio=$sig[1]'> > </a> Sig";
        
        
        echo "<table border='2'>";
        echo "<th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th>";
        
        
        for ($i=0;$i<$semanas;$i++)
        {
            echo "<tr>";
            
            for($j=1;$j<=7;$j++)
            {
             
              if ( ($i==0) && ( $diaIniSem>$j ) )  //Si es la primera semana y la posicion del dia es anterior al del inicio del mes
              {
                  echo "<td>&nbsp</td>";
              }
              elseif ($contDia>$DiasMes)    //Si hemos llegado al último dia del mes
              {
                  echo "<td>&nbsp</td>";
              }
              else 
              {
                 echo "<td>$contDia</td>";
                 $contDia++;
              }
              
            }
            
            echo "</tr>";
        }
        
        
        echo "</table>";
        
       
        
        
        echo "</fieldset>";
    }
    
    
    
    
    
    
    
    
    ?>
    
    
     
  </form> 

</body>
</html>


     
     
     