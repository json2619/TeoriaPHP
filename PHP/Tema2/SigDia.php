<?php

/*

$inicio="01/09/2023";

$final="29/11/2023";

*/


$mes=2;

$anio=2023;


function DiasMes2($mes,$anio)
{
   if ($mes==12)    //Si el mes es Diciembre
   {
    $SigMes=1;      //Nos pasamos a Enero
    $anio=$anio+1;  //Pasamos al siguiente año
   }
   else   //Si no
   {
    $SigMes=$mes+1;  //Avanzamos al mes siguiente
   }
   
   $segSigMes=mktime(0,0,0,$SigMes,1,$anio);         //Sacamos la marca Epoch del dia 1 del mes siguiente
   
   $segSigMes=$segSigMes-(60*60);  //Le restamos una hora para ir al día anterior 
   
   $campos=getdate($segSigMes);    //Sacamos los datos en formato legible de ese dia
   
   return $campos['mday'];
    
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


function SigDia($dia)    //Recibe un dia eh formato Epoch y devuelve la marca Epoch de dia siguiente
{
   $dia+=(60*60*25);  //Le sumamos los segundos de un diá y una hora más 
    
   $campos=getdate($dia);
   
   $dia=mktime(0,0,0,$campos['mon'],$campos['mday'],$campos['year']);
 
 return $dia;  
   
}


echo "El mes $mes del año $anio tiene:".DiasMes2($mes,$anio)." dias";


/*

$campos=explode("/",$inicio);   //Cogemos la fecha legible

$ini=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);  //Y la convertimos a Epoch


$campos=explode("/",$final);   //Cogemos la fecha legible

$fin=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);  //Y la convertimos a Epoch

echo $inicio."<br>";

while($ini<$fin)
{
   $ini=SigDia($ini); //Actualizmos el valor de ini al siguiente dia
    
   $campos=getdate($ini);
    
   echo $campos['mday']."/".$campos['mon']."/".$campos['year'];
   
   echo "<br>"; 
}

*/





?>