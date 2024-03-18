<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreriaPDO.php';
require_once 'FotosPro.php';

class DaoFotosPro extends DB
{
    public $fotoPro = array();  //Array de objetos con el resultado de las consultas

    public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
    {
        $this->dbname = $base;
    }

    public function insertar($fotoP)      //Recibe como parámetro un objeto con la situación administrativa
    {
        $consulta = "insert into FotosProB values(:IdPro,:IdFoto,:Foto)";

        $param = array();

        $param[":IdPro"] = $fotoP->__get("IdPro");
        $param[":IdFoto"] = $fotoP->__get("IdFoto");
        $param[":Foto"] = $fotoP->__get("Foto");

        $this->ConsultaSimple($consulta, $param);

    }

    public function borrar($IdPro, $IdFoto)      //Recibe como parámetro un objeto con la situación administrativa
    {
        $consulta = "Delete from FotosProB where IdPro=:IdPro and IdFoto=:IdFoto";

        $param = array();

        $param[":IdPro"] = $IdPro;
        $param[":IdFoto"] = $IdFoto;

        $this->ConsultaSimple($consulta, $param);

    }


    public function ObtenerIdFoto($cod)          //Obtenemos el IdFoto correspondiente a ese producto
    {
        $consulta = "select Max(IdFoto) as IdMax from FotosProB where IdPro=:IdPro";

        $param = array(":IdPro" => $cod);

        $this->fotoPro = array();  //Vaciamos el array de las situaciones entre consulta y consulta


        $this->ConsultaDatos($consulta, $param);

        $IdFoto = 1;  //POr defecto suponemos que el IdFoto sera 1

        if (count($this->filas) == 1)   //Salvo que ya hubiera otras fotos antes
        {
            $fila = $this->filas[0];

            $IdFoto = $fila['IdMax'];

        }

        return $IdFoto;
    }

    public function listarPro($IdPro)       //Lista las fotos de un producto seleccionado
    {
        $consulta = "SELECT *
                  FROM  FotosProB
                  where IdPro=:IdPro";

        $param = array(":IdPro" => $IdPro);

        $this->fotoPro = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $fotoPro = new FotosPro();

            $fotoPro->__set("IdPro", $fila["IdPro"]);
            $fotoPro->__set("IdFoto", $fila["IdFoto"]);
            $fotoPro->__set("Foto", $fila["Foto"]);

            $this->fotoPro[] = $fotoPro;   //Insertamos el objeto con los valores de esa fila en el array de objetos
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
      $consulta="SELECT p.*,s.unidades
                 FROM  producto p, stock s
                 where p.cod=s.producto and p.familia=:familia and s.tienda=:tienda; ";
      
      $param=array(":familia"=>$familia,":tienda"=>$tienda);
      
      $this->productos=array();  //Vaciamos el array de las situaciones entre consulta y consulta
      
      $this->ConsultaDatos($consulta,$param);
        
      foreach($this->filas as $fila)
      {
         $pro= new ProductoUni();
         
         $pro->__set("cod", $fila['cod']);
         $pro->__set("nombre", $fila['nombre']);
         $pro->__set("descripcion", $fila['descripcion']);
         $pro->__set("PVP", $fila['PVP']);
         $pro->__set("familia", $fila['familia']);
         $pro->__set("Foto", $fila['Foto']);
         $pro->__set("Unidades", $fila['unidades']);
         
         $this->productos[]=$pro;   //Insertamos el objeto con los valores de esa fila en el array de objetos
         
      }
      
    }
    public function listFamNom($familia="",$nombre="")       //Lista los productos de una familia y que coincida el nombre
    {
          $consulta="SELECT p.cod,p.nombre,p.PVP,sum(s.unidades) as disponible
                     from producto p, stock s 
                     where p.cod=s.producto ";
          
          $param=array();
          
          if ($familia!='')   // si hemos recibido un código de familia
          {
             $consulta.=" AND familia=:familia "; 
             $param[":familia"]=$familia;
          }
          
          if ($nombre!='')   // si hemos recibido un código de familia
          {
              $consulta.=" AND nombre like :nombre ";
              $param[":nombre"]="%".$nombre."%";
          }
          
          $consulta.=" GROUP by cod ";
           
          $this->productos=array();  //Vaciamos el array de las situaciones entre consulta y consulta
          
          $this->ConsultaDatos($consulta,$param);
          
          foreach($this->filas as $fila)
          {
              $pro= new ProductoStock();
              
              $pro->__set("cod", $fila['cod']);
              $pro->__set("nombre", $fila['nombre']);
              $pro->__set("PVP", $fila['PVP']);
              $pro->__set("disponible", $fila['disponible']);
            
              $this->productos[]=$pro;   //Insertamos el objeto con los valores de esa fila en el array de objetos
              
          }
      
    }
    
    */

}

?>