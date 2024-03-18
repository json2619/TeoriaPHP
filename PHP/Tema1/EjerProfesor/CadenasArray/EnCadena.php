<?php



function DentroCadena($pos,$cad)    //Si un número de posiciṕn se encuentra dentro de la cadena
{
    
  return ( $pos>=0 && ($pos<strlen($cad)) );  
}

function SubCadena($cad,$ini,$tam)
{
   $sub="";  //Subcadena que vamos a retornar 
    
   $num=abs($tam);  //Hallamos el valor absoluto del parámetro tamaño
   
   if ($ini<strlen($cad) ) 
   {
       while ( DentroCadena($ini,$cad) && ($num>0) )   //Mientras exista esa posicion de la cadena y haya tam
           {
              
              $sub.=$cad[$ini];
               
              if ($tam>0)  
              {
                $ini++;
                
              }
              else
              {
                $ini--;
                  
              }
              
              $num--;
              
           }
               
    }
       
    if ($tam<0)
    {
        $sub=strrev($sub);  //Si los cogiamos de inicio hacia la izda hay que invertir la cadena
    }
   
    
   return $sub;
    
    
}


function PosEnCadena($cad2,$cad1)
{
    $PosContenida=-1;   // Posicion desde la que hemos encotrando que cad2 esta contenida
    
    $PuntAux1=0;
    
    if ( strlen($cad2)<strlen($cad1)  )
    {
        $Punt1=0; //Inicializamos indices de la cadena mayor
        
        $Punt2=0; //Y de la menor
        
        while( ($Punt1<strlen($cad1))  &&  ( $PosContenida==-1 )  )
        {
             $PuntAux1=$Punt1;   //Salvamos el inicio de la cadena1 desde donde empezamos a buscar coincidencias  
            
             while ( ( $Punt2<strlen($cad2) ) && ($cad1[$Punt1]==$cad2[$Punt2])  ) 
             {
                 $Punt1++;
                 $Punt2++;
             }
            
             if ($Punt2==strlen($cad2) )   //Si hemos avanzado dentro de la primera cadena tantos caractares como tiene la segunda
             {
                 $PosContenida=$PuntAux1;  
             }
             else //Hemos encontrado una discrepancia sin llegar al final de la cadena 2
             {
                 $Punt2=0;  //Volvemos al inicio de la cadena2
                 
                 $PuntAux1++;  //Avanzamos una posición el puntero auxiliar de la cadena 1
                 
                 $Punt1=$PuntAux1;
             }
                 
            
        }
        
     
     }
     
     if ($PuntAux1==strlen($cad1))
     {
         $PuntAux1=-1;
     }
     
     return $PuntAux1;   //Retornamos la posición desde la que hemos encontrado la coincidencia
}

$cad1="telescopio";

$ini=3;

$tam=-6;


echo "La subcadena de $cad1 desde la posicion $ini tamaño $tam  es:  ".SubCadena($cad1,$ini,$tam);




?>