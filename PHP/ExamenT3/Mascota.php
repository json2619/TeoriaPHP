<?php

class Mascota
{
    private $Id;
    private $Nombre;
    private $Familia;
    private $FechaNac;
    private $Foto;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }

}