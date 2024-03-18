<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('Pedido.php');

class DaoPedido extends DB
{
    public $pedidos = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    /*
    public function listarFamilia($familia, $tienda)
    {
        $consulta = "select p.*
                    from pedido p, stock s 
                    where p.familia=:familia and 
                    s.tienda=:tienda and p.cod=s.pedido";
        $param = array(":familia" => $familia, ":tienda" => $tienda);

        $this->pedidos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $pedido = new pedido();

            $pedido->__set("cod", $fila['cod']);
            $pedido->__set("nombre", $fila['nombre']);
            $pedido->__set("descripcion", $fila['descripcion']);
            $pedido->__set("PVP", $fila['PVP']);
            $pedido->__set("familia", $fila['familia']);
            $pedido->__set("Foto", $fila['Foto']);

            $this->pedidos[] = $pedido;
        }
    }

    public function listarFamNom($familia = "", $nombre = "")
    {
        $consulta = "select p.cod, p.nombre, p.PVP, sum(s.unidades) as disponible
                    from pedido p, stock s where p.cod = s.pedido";
        $param = array();

        if ($familia != '') {
            $consulta .= " and familia=:familia";
            $param[":familia"] = $familia;
        }

        if ($nombre != '') {
            $consulta .= " and nombre like :nombre";
            $param[":nombre"] = "%" . $nombre . "%";
        }

        $consulta .= " group by p.cod";

        $this->pedidos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $pedido = new pedidoStock();

            $pedido->__set("cod", $fila['cod']);
            $pedido->__set("nombre", $fila['nombre']);
            $pedido->__set("PVP", $fila['PVP']);
            $pedido->__set("disponible", $fila['disponible']);

            $this->pedidos[] = $pedido;
        }
    }

*/
    /*
        public function obtener($NIF)
        {
            $consulta = "select * from tienda where NIF=:NIF";
            $param = array(":Id" => $NIF);

            $this->pedidos = array();

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

            $this->pedidos = array();

            $this->consultaSimple($consulta, $param);
        }
*/
    public function insertar($pedido)      //Recibe como parámetro un objeto con la situación administrativa
    {
        $consulta = "insert into pedido values(:Id,:Cliente,:Fecha)";

        $param = array();

        $param[":Id"] = $pedido->__get("Id");
        $param[":Cliente"] = $pedido->__get("Cliente");
        $param[":Fecha"] = $pedido->__get("Fecha");

        $this->ConsultaSimple($consulta, $param);

    }

    public function recuperarId($cliente, $fecha)
    {
        $consulta = "select * from pedido where Cliente=:Cliente and Fecha=:Fecha";

        $param = array();

        $param[":Cliente"] = $cliente;
        $param[":Fecha"] = $fecha;

        $this->consultaDatos($consulta, $param);

        $fila = $this->filas[0];

        $pedido = new Pedido();

        $pedido->__set("Id", $fila['Id']);
        $pedido->__set("Cliente", $fila['Cliente']);
        $pedido->__set("Fecha", $fila['Fecha']);

        return $pedido;
    }
    /*
            public function actualizar($prod)
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

                $param[":NIF"] = $prod->__get("NIF");
                $param[":Nombre"] = $prod->__get("Nombre");
                $param[":Apellido1"] = $prod->__get("Apellido1");
                $param[":Apellido2"] = $prod->__get("Apellido2");
                $param[":Telefono"] = $prod->__get("Telefono");
                $param[":Premio"] = $prod->__get("Premios");
                $param[":FechaNac"] = $prod->__get("FechaNac");
                $param[":Foto"] = $prod->__get("Foto");

                $this->consultaSimple($consulta, $param);
            }
            */

}