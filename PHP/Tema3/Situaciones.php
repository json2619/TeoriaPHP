<?php

// Para cada tabla se crea un objeto entidad, sobre ese objeto se crea el DAO correspondiente
// DAO(Data, Access, Object)
// CRUD(Create, Read, Update, Delete, Listar)

class Situacion
{
    private $Id;
    private $Nombre;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}


?>