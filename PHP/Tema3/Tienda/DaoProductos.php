<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('Producto.php');
require_once('ProductoStock.php');

class DaoProducto extends DB
{
    public $productos = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    public function listarFamilia($familia, $tienda)
    {
        $consulta = "select p.*
                    from producto p, stock s 
                    where p.familia=:familia and 
                    s.tienda=:tienda and p.cod=s.producto";
        $param = array(":familia" => $familia, ":tienda" => $tienda);

        $this->productos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $producto = new Producto();

            $producto->__set("cod", $fila['cod']);
            $producto->__set("nombre", $fila['nombre']);
            $producto->__set("descripcion", $fila['descripcion']);
            $producto->__set("PVP", $fila['PVP']);
            $producto->__set("familia", $fila['familia']);
            $producto->__set("Foto", $fila['Foto']);

            $this->productos[] = $producto;
        }
    }

    public function listarFamNom($familia = "", $nombre = "")
    {
        $consulta = "select p.cod, p.nombre, p.PVP, sum(s.unidades) as disponible
                    from producto p, stock s where p.cod = s.producto";
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

        $this->productos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $producto = new ProductoStock();

            $producto->__set("cod", $fila['cod']);
            $producto->__set("nombre", $fila['nombre']);
            $producto->__set("PVP", $fila['PVP']);
            $producto->__set("disponible", $fila['disponible']);

            $this->productos[] = $producto;
        }
    }


    /*
        public function obtener($NIF)
        {
            $consulta = "select * from tienda where NIF=:NIF";
            $param = array(":Id" => $NIF);

            $this->productos = array();

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

            $this->productos = array();

            $this->consultaSimple($consulta, $param);
        }
*/
    public function insertar($producto)      //Recibe como parámetro un objeto con la situación administrativa
    {
        $consulta = "insert into producto values(:cod,:nombre,:descripcion,:PVP,:familia,:Foto)";

        $param = array();

        $param[":cod"] = $producto->__get("cod");
        $param[":nombre"] = $producto->__get("nombre");
        $param[":descripcion"] = $producto->__get("descripcion");
        $param[":PVP"] = $producto->__get("PVP");
        $param[":familia"] = $producto->__get("familia");
        $param[":Foto"] = $producto->__get("Foto");

        $this->ConsultaSimple($consulta, $param);


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

    public function obtener($cod)
    {
        $consulta = "select * from producto where cod=:cod";
        $param = array(":cod" => $cod);

        $this->productos = array();

        $this->consultaDatos($consulta, $param);

        $pro = null;

        if (count($this->filas) == 1) {

            $fila = $this->filas[0];

            $pro = new Producto();

            $pro->__set("cod", $fila['cod']);
            $pro->__set("nombre", $fila['nombre']);
            $pro->__set("descripcion", $fila['descripcion']);
            $pro->__set("PVP", $fila['PVP']);
            $pro->__set("familia", $fila['familia']);
            $pro->__set("Foto", $fila['Foto']);

        }

        return $pro;

    }

}