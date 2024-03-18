<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreria.php';
require_once 'Mascota.php';

class DaoMascotas extends DB
{
    public $mascotas = array();  //Array de objetos con el resultado de las consultas

    public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
    {
        $this->dbname = $base;
    }

    public function listar()       //Lista el contenido de la tabla
    {
        $consulta = "select * from mascotas ";

        $param = array();

        $this->mascotas = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta);

        foreach ($this->filas as $fila) {
            $mascota = new Mascota();

            $mascota->__set("Id", $fila['Id']);
            $mascota->__set("Nombre", $fila['Nombre']);
            $mascota->__set("Familia", $fila['Familia']);
            $mascota->__set("FechaNac", $fila['FechaNac']);
            $mascota->__set("Foto", $fila['Foto']);

            $this->mascotas[] = $mascota;

        }

    }


    public function insertar($mascota)      //Recibe como parámetro un objeto con la situación administrativa
    {
        $consulta = "insert into mascotas values(:Id,:Nombre,:Familia,:FechaNac,:Foto)";

        $param = array();

        $param[":Id"] = $mascota->__get("Id");
        $param[":Nombre"] = $mascota->__get("Nombre");
        $param[":Familia"] = $mascota->__get("Familia");
        $param[":FechaNac"] = $mascota->__get("FechaNac");
        $param[":Foto"] = $mascota->__get("Foto");

        $this->ConsultaSimple($consulta, $param);


    }

    public function listFamNom($familia = "", $nombre = "")       //Lista los productos de una familia y que coincida el nombre
    {
        $consulta = "SELECT *
                    from mascotas
                    where 1";

        $param = array();

        if ($familia != '')   // si hemos recibido un código de familia
        {
            $consulta .= " AND Familia=:familia ";
            $param[":familia"] = $familia;
        }

        if ($nombre != '')   // si hemos recibido un código de familia
        {
            $consulta .= " AND Nombre like :nombre ";
            $param[":nombre"] = "%" . $nombre . "%";
        }

        $consulta .= " GROUP by Id ";

        $this->mascotas = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $mascota = new Mascota();

            $mascota->__set("Id", $fila['Id']);
            $mascota->__set("Nombre", $fila['Nombre']);
            $mascota->__set("Familia", $fila['Familia']);
            $mascota->__set("FechaNAc", $fila['FechaNac']);
            $mascota->__set("Foto", $fila['Foto']);

            $this->mascotas[] = $mascota;

        }

    }

    public function borrar($Id)      //Elimina una situación de la tabla
    {
        $consulta = "delete from mascotas where Id=:Id";
        $param = array(":Id" => $Id);

        $this->ConsultaSimple($consulta, $param);

    }

    public function actualizar($masc)     //Recibimos como parámetro un objeto con los datos a actualizar   
    {
        $consulta = "update mascotas set Nombre=:Nombre,
                                        Familia=:Familia,
                                        FechaNac=:FechaNac,
                                        Foto=:Foto
                                        where Id=:Id";

        $param = array();

        $param[":Id"] = $masc->__get("Id");
        $param[":Nombre"] = $masc->__get("Nombre");
        $param[":Familia"] = $masc->__get("Familia");
        $param[":FechaNac"] = $masc->__get("FechaNac");
        $param[":Foto"] = $masc->__get("Foto");

        $this->ConsultaSimple($consulta, $param);

    }

    public function obtener($Id)          //Obtenemos el elemento a partir de su Id
    {
        $consulta = "select * from mascotas where Id=:Id";
        $param = array(":Id" => $Id);

        $this->ConsultaDatos($consulta, $param);

        if (count($this->filas) == 1) {
            $fila = $this->filas[0];  //Recuperamos la fila devuelta

            $mascota = new Mascota();

            $mascota->__set("Id", $fila['Id']);
            $mascota->__set("Nombre", $fila['Nombre']);
            $mascota->__set("Familia", $fila['Familia']);
            $mascota->__set("FechaNac", $fila['FechaNac']);
            $mascota->__set("Foto", $fila['Foto']);

        } else {
            echo "<b>El Id introducido no corresponde con ninguna mascota</b>";
        }

        return $mascota;
    }

}
