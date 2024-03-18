<?php

class Producto
{
    private $Id;
    private $Marca;
    private $Modelo;
    private $Precio;
    private $Cantidad;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }

}