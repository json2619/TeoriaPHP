<?php

class FotosProd
{
    private $IdPro;
    private $IdFoto;
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