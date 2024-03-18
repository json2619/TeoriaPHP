<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('Tienda.php');

class DaoTienda extends DB
{
    public $tiendas = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    public function listar()       //Lista el contenido de la tabla
    {
        $consulta = "select * from tienda";
        $param = array();

        $this->tiendas = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $tienda = new Tienda();

            $tienda->__set("cod", $fila['cod']);
            $tienda->__set("nombre", $fila['nombre']);
            $tienda->__set("tlf", $fila['tlf']);

            $this->tiendas[] = $tienda;   //Insertamos el objeto con los valores de esa fila en el array de objetos

        }

    }
    /*
        public function obtener($NIF)
        {
            $consulta = "select * from tienda where NIF=:NIF";
            $param = array(":Id" => $NIF);

            $this->tiendas = array();

            $this->consultaDatos($consulta, $param);

            $tienda = new tienda();

            if (count($this->filas) == 1) {

                $fila = $this->filas[0];

                $tienda->__set("NIF", $fila['NIF']);
                $tienda->__set("Nombre", $fila['Nombre']);
                $tienda->__set("Apellido1", $fila['Apellido1']);
                $tienda->__set("Apellido2", $fila['Apellido2']);
                $tienda->__set("Telefono", $fila['Telefono']);
                $tienda->__set("Premio", $fila['Premios']);
                $tienda->__set("FechaNac", $fila['Fecha']);
                $tienda->__set("Foto", $fila['Foto']);

            } else {
                echo "<b>El NIF introducido no corresponde con ningún tienda</b>";
            }

            return $tienda;
        }

        public function borrar($NIF)
        {
            $consulta = "delete from tienda where NIF=:NIF";

            $param = array(":NIF" => $NIF);

            $this->tiendas = array();

            $this->consultaSimple($consulta, $param);
        }

        public function insertar($alu)
        {
            $consulta = "insert into tienda values(:NIF, 
                                                    :Nombre,
                                                    :Apellido1,
                                                    :Apellido2,
                                                    :Telefono,
                                                    :Premio,
                                                    :FechaNac,
                                                    :Foto)";

            $param = array();

            $param[":NIF"] = $alu->__get("NIF");
            $param[":Nombre"] = $alu->__get("Nombre");
            $param[":Apellido1"] = $alu->__get("Apellido1");
            $param[":Apellido2"] = $alu->__get("Apellido2");
            $param[":Telefono"] = $alu->__get("Telefono");
            $param[":Premio"] = $alu->__get("Premios");
            $param[":FechaNac"] = $alu->__get("FechaNac");
            $param[":Foto"] = $alu->__get("Foto");

            $this->consultaSimple($consulta, $param);
        }

        public function actualizar($alu)
        {
            $consulta = "update tienda set Nombre=:Nombre
                                            Apellido1=:Apellido1,
                                            Apellido2=:Apellido2,
                                            Telefono=:Telefono,
                                            Premios=:Premio,
                                            Fecha=:FechaNac,
                                            Foto=:Foto
                                            where NIF=:NIF";

            $param = array();

            $param[":NIF"] = $alu->__get("NIF");
            $param[":Nombre"] = $alu->__get("Nombre");
            $param[":Apellido1"] = $alu->__get("Apellido1");
            $param[":Apellido2"] = $alu->__get("Apellido2");
            $param[":Telefono"] = $alu->__get("Telefono");
            $param[":Premio"] = $alu->__get("Premios");
            $param[":FechaNac"] = $alu->__get("FechaNac");
            $param[":Foto"] = $alu->__get("Foto");

            $this->consultaSimple($consulta, $param);
        }
        */

}