<?php


$ahora=time();   //Obtenemos la fecha actual en formato Epoch  

//$ahora=$ahora-(60*60*2);


echo "Tiempo en segundos Epoch:".$ahora;

echo "<br>";

$campos=getdate($ahora);  //Recibimos como parámetro un valor epoch y nos devuelve un array asociativo    

echo "Tiempo en formato legible:";


echo $campos['mday']."/".$campos['month']."/".$campos['year']." ".$campos['hours'].":".$campos['minutes'].":".$campos['seconds'];

echo " El dia es :".$campos['wday'];

echo "<br>";


  $fechaEpoch=mktime(13,30,30,1,13,1997);
  
  $campos=getdate($fechaEpoch);

  echo $campos['mday']."/".$campos['mon']."/".$campos['year']." ".$campos['hours'].":".$campos['minutes'].":".$campos['seconds'];
  
  echo " El dia es :".$campos['weekday'];




?>