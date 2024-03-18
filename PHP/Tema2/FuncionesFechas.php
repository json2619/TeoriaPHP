<?php


function FechaValida($fecha)    //Recibimos la fecha en formato dd/mm/yyyy
{
    $valida=FALSE;
    
    $campos=explode("/",$fecha);
    
    if ( ($campos[1]>0) && ($campos[1]<13  )  )
    {
        $Numdias=DiasMes($campos[1],$campos[2]);   //Comprobamos los dias de ese mes
        
        if ( ($campos[0]>0 ) &&  ($campos[0]<=$Numdias)  )
        {
            $valida=TRUE;
        }
        
    }
    
    return $valida;
}

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



?>

