<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('Clientes.php');

class DaoCliente extends DB
{
    public $clientes = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    public function listar()
    {
        $consulta = "select * from clientes";
        $param = array();

        $this->clientes = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $cli = new Cliente();

            $cli->__set("NIF", $fila['NIF']);
            $cli->__set("Nombre", $fila['Nombre']);
            $cli->__set("Apellido1", $fila['Apellido1']);
            $cli->__set("Apellido2", $fila['Apellido2']);
            $cli->__set("FechaNac", $fila['FechaNac']);
            $cli->__set("Sexo", $fila['Sexo']);
            $cli->__set("Direccion", $fila['Direccion']);
            $cli->__set("Estado", $fila['Estado']);
            $cli->__set("Telefono", $fila['Telefono']);
            $cli->__set("CP", $fila['CP']);
            $cli->__set("Foto", $fila['Foto']);

            $this->clientes[] = $cli;
        }
    }

    /*
    public function obtener($NIF)
    {
        $consulta = "select * from clis where NIF=:NIF";
        $param = array(":Id" => $NIF);

        $this->clis = array();

        $this->consultaDatos($consulta, $param);

        $cli = new cli();

        if (count($this->filas) == 1) {

            $fila = $this->filas[0];

            $cli->__set("NIF", $fila['NIF']);
            $cli->__set("Nombre", $fila['Nombre']);
            $cli->__set("Apellido1", $fila['Apellido1']);
            $cli->__set("Apellido2", $fila['Apellido2']);
            $cli->__set("Telefono", $fila['Telefono']);
            $cli->__set("Premio", $fila['Premios']);
            $cli->__set("FechaNac", $fila['Fecha']);
            $cli->__set("Foto", $fila['Foto']);

        } else {
            echo "<b>El NIF introducido no corresponde con ningún cli</b>";
        }

        return $cli;
    }

    public function borrar($NIF)
    {
        $consulta = "delete from clis where NIF=:NIF";

        $param = array(":NIF" => $NIF);

        $this->clis = array();

        $this->consultaSimple($consulta, $param);
    }

    public function insertar($alu)
    {
        $consulta = "insert into clis values(:NIF, 
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
        $consulta = "update clis set Nombre=:Nombre
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
