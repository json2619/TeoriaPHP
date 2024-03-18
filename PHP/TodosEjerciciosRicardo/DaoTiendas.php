<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreriaPDO.php';
require_once 'Tienda.php';

class DaoTiendas extends DB
{
    public $tiendas = array();  //Array de objetos con el resultado de las consultas

    public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
    {
        $this->dbname = $base;
    }

    public function listar()       //Lista el contenido de la tabla
    {
        $consulta = "select * from tienda ";
        $param = array();

        $this->tiendas = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta);

        foreach ($this->filas as $fila) {
            $tienda = new Tienda();

            $tienda->__set("cod", $fila['cod']);
            $tienda->__set("nombre", $fila['nombre']);
            $tienda->__set("tlf", $fila['tlf']);

            $this->tiendas[] = $tienda;   //Insertamos el objeto con los valores de esa fila en el array de objetos

        }

    }

    /*
    
    public function obtener($Id)          //Obtenemos el elemento a partir de su Id
    {
        $consulta="select * from Situaciones where Id=:Id";
        $param=array(":Id"=>$Id);
        
        $this->situaciones=array();  //Vaciamos el array de las situaciones entre consulta y consulta
        
        $this->ConsultaDatos($consulta,$param);
        
        if (count($this->filas)==1 )
        {
            $fila=$this->filas[0];  //Recuperamos la fila devuelta
            
            $situ= new Situacion();
            
            $situ->__set("Id", $fila['Id']);
            $situ->__set("Nombre", $fila['Nombre']);
            
        }
        else 
        {
            echo "<b>El Id introducido no corresponde con ninguna situación administrativa</b>";
        }
    
        return $situ;
    }
    
    public function borrar($Id)      //Elimina una situación de la tabla
    {
        $consulta="delete from Situaciones where Id=:Id";
        $param=array(":Id"=>$Id);
        
        $this->situaciones=array();  //Vaciamos el array de las situaciones entre consulta y consulta
        
        $this->ConsultaSimple($consulta,$param);
           
    }
    
    public function insertar($situ)      //Recibe como parámetro un objeto con la situación administrativa
    {
       $consulta="insert into Situaciones values(:Id,:Nombre)";
        
       $param=array();
       
       $param[":Id"]=$situ->__get("Id");
       $param[":Nombre"]=$situ->__get("Nombre");
    
       $this->ConsultaSimple($consulta,$param);
    
    }

    public function actualizar($situ)     //Recibimos como parámetro un objeto con los datos a actualizar   
    { 
        $consulta="update Situaciones set Nombre=:Nombre where Id=:Id";
        
        $param=array();
        
        $param[":Id"]=$situ->__get("Id");
        $param[":Nombre"]=$situ->__get("Nombre");
        
        $this->ConsultaSimple($consulta,$param);
        
        
    }

    */


}







?>