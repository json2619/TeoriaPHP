<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreriaPDO.php';
require_once 'Stock.php';
require_once 'ProMaxUni.php';

class DaoStocks extends DB 
{
   public $stocks=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname=$base;
   }
    
   public function insertar($stock)      //Recibe como parámetro un objeto con la situación administrativa
   {
       $consulta="insert into stock values(:producto,:tienda,:unidades)";
        
       $param=array();
       
       $param[":producto"]=$stock->__get("producto");
       $param[":tienda"]=$stock->__get("tienda");
       $param[":unidades"]=$stock->__get("unidades");
       
       $this->ConsultaSimple($consulta,$param);
       
      
   }
   
   public function actualizar($stock)      //Recibe como parámetro un objeto Stock y lo actualizamos
   {
       $consulta="update stock set unidades=:unidades where producto=:producto and tienda=:tienda ";
       
       $param=array();
       
       $param[":producto"]=$stock->__get("producto");
       $param[":tienda"]=$stock->__get("tienda");
       $param[":unidades"]=$stock->__get("unidades");
       
       $this->ConsultaSimple($consulta,$param);
       
       
   }
   
   public function obtener($stock)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from stock where producto=:producto and tienda=:tienda";
    
       $this->productos=array();  //Vaciamos el array de las situaciones entre consulta y consulta
       
       $param=array();
       
       $param[":producto"]=$stock->__get("producto");
       $param[":tienda"]=$stock->__get("tienda");
      
       $this->ConsultaDatos($consulta,$param);
       
       $sto=null; //Inicializamos a nulo la variable que almacenarça el objeto de retorno
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $sto= new Stock();   //Creamos un objeto de la clase Stock
           
           $sto->__set("producto", $fila['producto']);
           $sto->__set("tienda", $fila['tienda']);
           $sto->__set("unidades", $fila['unidades']);
           
           
       }
       
       return $sto;  //Retornamos el objeto con los datos del producto
   }
   
   
   public function BenePorUni($ord)     //Metodo que retorna los productos según las unidades en orden ASC o DESC
   {
       $consulta="select p.cod,p.nombre,p.descripcion,p.PVP,sum(s.unidades) as TotUni
                  from stock s,producto p
                  where s.producto=p.cod
                  GROUP by producto
                  having TotUni = (  select sum(s.unidades) as MaxUni
                  from stock s
                  GROUP by producto
                  order by MaxUni ";
       
       if ($ord==0)   //si me está pidiento el mayor hay qur ordenar de manera descendente 
       {
           $consulta.=" Desc ";
       }
       
       $consulta.=" limit 1  )";
       
       $param=array();
       
       $this->ConsultaDatos($consulta,$param);
       
       foreach($this->filas as $fila)
       {
           $pro= new ProMaxUni();
           
           $pro->__set("cod", $fila['cod']);
           $pro->__set("nombre", $fila['nombre']);
           $pro->__set("descripcion", $fila['descripcion']);
           $pro->__set("PVP", $fila['PVP']);
           $pro->__set("TotUni", $fila['TotUni']);
          
           $this->stocks[]=$pro;   //Insertamos el objeto con los valores de esa fila en el array de objetos
           
       }
      
   }
   
   public function BenePorImp($ord)     //Metodo que retorna los productos según las unidades en orden ASC o DESC
   {
       $consulta="select p.cod,p.nombre,p.descripcion,p.PVP,( sum(s.unidades)*p.PVP) as Importe 
                  from stock s,producto p
                  where s.producto=p.cod
                  GROUP by producto
                   having Importe = (   select (sum(s.unidades)*p.PVP) ImporteTot 
                    from stock s,producto p
                    where s.producto=p.cod
                    GROUP by producto 
                    order by ImporteTot ";
       
       if ($ord==0)   //si me está pidiento el mayor hay qur ordenar de manera descendente
       {
           $consulta.=" Desc ";
       }
       
       $consulta.=" limit 1  )";
       
       $param=array();
       
       $this->ConsultaDatos($consulta,$param);
       
       foreach($this->filas as $fila)
       {
           $pro= new ProMaxUni();
           
           $pro->__set("cod", $fila['cod']);
           $pro->__set("nombre", $fila['nombre']);
           $pro->__set("descripcion", $fila['descripcion']);
           $pro->__set("PVP", $fila['PVP']);
           $pro->__set("TotUni", $fila['Importe']);
           
           $this->stocks[]=$pro;   //Insertamos el objeto con los valores de esa fila en el array de objetos
           
       }
       
   }
   
   /*
   
   public function obtener($cod)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from producto where cod=:cod";
       $param=array(":cod"=>$cod);
       
       $this->productos=array();  //Vaciamos el array de las situaciones entre consulta y consulta
       
       $this->ConsultaDatos($consulta,$param);
       
       $pro=null; //Inicializamos a nulo la variable que almacenarça el objeto de retorno 
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
         
           $pro= new Producto();
           
           $pro->__set("cod", $fila['cod']);
           $pro->__set("nombre", $fila['nombre']);
           $pro->__set("descripcion", $fila['descripcion']);
           $pro->__set("PVP", $fila['PVP']);
           $pro->__set("familia", $fila['familia']);
           $pro->__set("Foto", $fila['Foto']);
           
       }
       
       return $pro;  //Retornamos el objeto con los datos del producto
   }
   
   public function listFamTien($familia,$tienda)       //Lista los productos de una familia
   {
     $consulta="SELECT p.*
                FROM  producto p, stock s
                where p.cod=s.producto and p.familia=:familia and s.tienda=:tienda; ";
     
     $param=array(":familia"=>$familia,":tienda"=>$tienda);
     
     $this->productos=array();  //Vaciamos el array de las situaciones entre consulta y consulta
     
     $this->ConsultaDatos($consulta,$param);
       
     foreach($this->filas as $fila)
     {
        $pro= new Producto();
        
        $pro->__set("cod", $fila['cod']);
        $pro->__set("nombre", $fila['nombre']);
        $pro->__set("descripcion", $fila['descripcion']);
        $pro->__set("PVP", $fila['PVP']);
        $pro->__set("familia", $fila['familia']);
        $pro->__set("Foto", $fila['Foto']);
        
        $this->productos[]=$pro;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }
 
   */ 
 
}

?>