<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('DetPedido.php');

class DaoDetPedido extends DB
{
    public $detPedidos = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    /*
    public function listarFamilia($familia, $tienda)
    {
        $consulta = "select p.*
                    from detPedido p, stock s 
                    where p.familia=:familia and 
                    s.tienda=:tienda and p.cod=s.detPedido";
        $param = array(":familia" => $familia, ":tienda" => $tienda);

        $this->detPedidos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $detPedido = new detPedido();

            $detPedido->__set("cod", $fila['cod']);
            $detPedido->__set("nombre", $fila['nombre']);
            $detPedido->__set("descripcion", $fila['descripcion']);
            $detPedido->__set("PVP", $fila['PVP']);
            $detPedido->__set("familia", $fila['familia']);
            $detPedido->__set("Foto", $fila['Foto']);

            $this->detPedidos[] = $detPedido;
        }
    }

    public function listarFamNom($familia = "", $nombre = "")
    {
        $consulta = "select p.cod, p.nombre, p.PVP, sum(s.unidades) as disponible
                    from detPedido p, stock s where p.cod = s.detPedido";
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

        $this->detPedidos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $detPedido = new detPedidoStock();

            $detPedido->__set("cod", $fila['cod']);
            $detPedido->__set("nombre", $fila['nombre']);
            $detPedido->__set("PVP", $fila['PVP']);
            $detPedido->__set("disponible", $fila['disponible']);

            $this->detPedidos[] = $detPedido;
        }
    }

*/
    /*
        public function obtener($NIF)
        {
            $consulta = "select * from tienda where NIF=:NIF";
            $param = array(":Id" => $NIF);

            $this->detPedidos = array();

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

            $this->detPedidos = array();

            $this->consultaSimple($consulta, $param);
        }
*/
    public function insertar($detPedido)      //Recibe como parámetro un objeto con la situación administrativa
    {
        $consulta = "insert into detPedido values(:IdPed,:IdPro,:Cantidad)";

        $param = array();

        $param[":IdPed"] = $detPedido->__get("IdPed");
        $param[":IdPro"] = $detPedido->__get("IdPro");
        $param[":Cantidad"] = $detPedido->__get("Cantidad");

        $this->ConsultaSimple($consulta, $param);

    }

    /*
        public function recuperarId($cliente, $fecha)
        {
            $consulta = "select * from detPedido where Cliente=:Cliente and Fecha=:Fecha";

            $param = array();

            $param[":Cliente"] = $cliente;
            $param[":Fecha"] = $fecha;

            $this->consultaDatos($consulta, $param);

            $fila = $this->filas[0];

            $detPedido = new detPedido();

            $detPedido->__set("Id", $fila['Id']);
            $detPedido->__set("Cliente", $fila['Cliente']);
            $detPedido->__set("Fecha", $fila['Fecha']);

            return $detPedido;
        }
    */
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