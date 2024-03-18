<?php

  
   $fd=fopen("Agenda.txt","a+") or die("Error al abrir el archivo")  ;     //Devuelve el descriptor de archivo 

   $salto="\r\n";
   
   $linea=" No Estoy mal";
   
   $linea.=$salto;
   
   fputs($fd,$linea);  //guardamos este string en el archivo
   
   fclose($fd);   //Cerramos el archivo

  
   
  /*

  Apertura en modo lectura

   $fd=fopen("Datos.txt","r") or die("Error al abrir el archivo")  ;     //Devuelve el descriptor de archivo   

   while( $linea=fgets($fd)  )    //Mientras haya lineas
   {
       echo $linea."<br>";
       
   }
   
   fclose($fd);   //Cerramos el archivo
   

  */


?>