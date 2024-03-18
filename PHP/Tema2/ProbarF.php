<?php

require_once 'FuncionesFechas.php';

$fecha="06/12/1901";



function FechaOk($fecha)             //Funcion que verifica si una fecha es correcta
{
    
    $DentroLim=FALSE;
    
    $LimInferior=FALSE;
    $LimSuperior=FALSE; 
    
    if (FechaValida($fecha) )    //Si la fecha es válida comprobamos que está dentro del intervalo permitido
    {
        
        $camposFecha=explode("/",$fecha);
        
        //Edades máximas y mínimas permitidas en numero de años
        
        $Min=18;
        
        $Max=122;
        
        $hoy=time();  //Cogemos la fecha actual
        
        $camposHoy=getdate($hoy); //Pasamoa a formato legible la fecha actual
        
        //Comprobamos el limite inforiror de la fecha
        
        if (  ( ( $camposHoy['year']-$camposFecha[2] )<=122  )   )
        {
            if (  $camposFecha[1]>=$camposHoy['mon']    )
            {
                if ( $camposFecha[0]>=$camposHoy['mday'] )
                {
                    $LimInferior=TRUE;    //Esa fecha no excede el límite inferior
                }
                
            }
            
        }
        
        //Comprobamos el limite superior de la fecha
        
        
        if (  ( ( $camposHoy['year']-$camposFecha[2] )>=18  )   )
        {
            if (  $camposFecha[1]<=$camposHoy['mon']    )
            {
                if ( $camposFecha[0]<=$camposHoy['mday'] )
                {
                    $LimSuperior=TRUE;    //Esa fecha no excede el límite inferior
                }
                
            }
            
        }
        
        $DentroLim=($LimInferior && $LimSuperior);
        
        return ($DentroLim )  ;  //Si cumple con ambos limites
        
    }
    
}

if (FechaOk($fecha)  )
{
  echo "La fecha $fecha es correcta ";  
}
else 
{
    echo "<b>La fecha $fecha NO es correcta</b>";  
}


?>