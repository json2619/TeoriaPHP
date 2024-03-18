<?php
// Necesitamos incluir la libreria y la clase identidad asociada al DAO

require_once('libreria.php');
require_once('Alumno.php');

class DaoAlumnos extends DB
{
    public $alumnos = array(); // Array de objetos con el resultado de las consultas

    public function __construct($base) // Al instanciar el dao especificamos la bd
    {
        $this->dbname = $base;
    }

    public function listar()
    {
        $consulta = "select * from alumnos";
        $param = array();

        $this->alumnos = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) {
            $alumno = new Alumno();

            $alumno->__set("NIF", $fila['NIF']);
            $alumno->__set("Nombre", $fila['Nombre']);
            $alumno->__set("Apellido1", $fila['Apellido1']);
            $alumno->__set("Apellido2", $fila['Apellido2']);
            $alumno->__set("Telefono", $fila['Telefono']);
            $alumno->__set("Premio", $fila['Premios']);
            $alumno->__set("FechaNac", $fila['Fecha']);
            $alumno->__set("Foto", $fila['Foto']);

            $this->alumnos[] = $alumno;
        }
    }

    public function obtener($NIF)
    {
        $consulta = "select * from alumnos where NIF=:NIF";
        $param = array(":Id" => $NIF);

        $this->alumnos = array();

        $this->consultaDatos($consulta, $param);

        $alumno = new Alumno();

        if (count($this->filas) == 1) {

            $fila = $this->filas[0];

            $alumno->__set("NIF", $fila['NIF']);
            $alumno->__set("Nombre", $fila['Nombre']);
            $alumno->__set("Apellido1", $fila['Apellido1']);
            $alumno->__set("Apellido2", $fila['Apellido2']);
            $alumno->__set("Telefono", $fila['Telefono']);
            $alumno->__set("Premio", $fila['Premios']);
            $alumno->__set("FechaNac", $fila['Fecha']);
            $alumno->__set("Foto", $fila['Foto']);

        } else {
            echo "<b>El NIF introducido no corresponde con ningún alumno</b>";
        }

        return $alumno;
    }

    public function borrar($NIF)
    {
        $consulta = "delete from alumnos where NIF=:NIF";

        $param = array(":NIF" => $NIF);

        $this->alumnos = array();

        $this->consultaSimple($consulta, $param);
    }

    public function insertar($alu)
    {
        $consulta = "insert into alumnos values(:NIF, 
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
        $consulta = "update alumnos set Nombre=:Nombre
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

}
