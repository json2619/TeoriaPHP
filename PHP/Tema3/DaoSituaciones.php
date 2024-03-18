<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('Situaciones.php');

class DaoSituaciones extends DB
{
    public $situaciones = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    public function listar()
    {
        $consulta = "select * from situaciones";
        $param = array();

        $this->situaciones = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $situacion = new Situacion();

            $situacion->__set("Id", $fila['Id']);
            $situacion->__set("Nombre", $fila['Nombre']);

            $this->situaciones[] = $situacion;
        }
    }

    public function obtener($Id)
    {
        $consulta = "select * from situaciones where Id=:Id";
        $param = array(":Id" => $Id);

        $this->situaciones = array();

        $this->consultaDatos($consulta, $param);

        $situacion = new Situacion();

        if (count($this->filas) == 1) {

            $fila = $this->filas[0];

            $situacion->__set("Id", $fila['Id']);
            $situacion->__set("Nombre", $fila['Nombre']);

        } else {
            echo "<b>El Id introducido no corresponde con la situación Administrativa</b>";
        }

        return $situacion;
    }

    public function borrar($Id)
    {
        $consulta = "delete from situaciones where Id=:Id";

        $param = array(":Id" => $Id);

        $this->situaciones = array();

        $this->consultaSimple($consulta, $param);
    }

    public function insertar($situ)
    {
        $consulta = "insert into situaciones values(:Id, :Nombre)";

        $param = array();

        $param[":Id"] = $situ->__get("Id");
        $param[":Nombre"] = $situ->__get("Nombre");

        $this->consultaSimple($consulta, $param);
    }

    public function actualizar($situ)
    {
        $consulta = "update situaciones set Nombre=:Nombre where Id=:Id";

        $param = array();

        $param[":Id"] = $situ->__get("Id");
        $param[":Nombre"] = $situ->__get("Nombre");

        $this->consultaSimple($consulta, $param);
    }

}

?>