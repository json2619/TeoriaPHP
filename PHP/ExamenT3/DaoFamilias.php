<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreria.php';
require_once 'Familia.php';

class DaoFamilias extends DB
{
    public $familias = array();  //Array de objetos con el resultado de las consultas

    public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
    {
        $this->dbname = $base;
    }

    public function listar()       //Lista el contenido de la tabla
    {
        $consulta = "select * from familias ";

        $param = array();

        $this->familias = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta);

        foreach ($this->filas as $fila) {
            $fam = new Familia();

            $fam->__set("Id", $fila['Id']);
            $fam->__set("Nombre", $fila['Nombre']);

            $this->familias[] = $fam;

        }

    }

    public function obtenerNomFam($idMasc)       //Lista el contenido de la tabla
    {
        $consulta = "select * from familias
                        where Id=:IdMasc";

        $param = array();

        $param[':IdMasc'] = $idMasc;

        $this->familias = array();  //Vaciamos el array de las situaciones entre consulta y consulta

        $this->ConsultaDatos($consulta, $param);

        if (count($this->filas) == 1) {
            $fila = $this->filas[0];  //Recuperamos la fila devuelta

            $fam = new Familia();

            $fam->__set("Id", $fila['Id']);
            $fam->__set("Nombre", $fila['Nombre']);

        } else {
            echo "<b>El Id introducido no corresponde con ninguna Familia</b>";
        }

        return $fam;

    }

}
