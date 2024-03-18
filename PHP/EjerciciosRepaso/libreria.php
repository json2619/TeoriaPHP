<?php

class DB
{

    private $host = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $pdo;

    protected $dbname;

    public $filas = array();

    public function __construct($base)
    {
        $this->dbname = $base;
    }

    private function conectar()
    {
        $dns = "mysql:host=$this->host;dbname=$this->dbname";

        try {

            $this->pdo = new PDO($dns, $this->usuario, $this->clave);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function consultaSimple($consulta, $param = array())
    {
        $this->conectar();

        $sta = $this->pdo->prepare($consulta);

        if (!$sta->execute($param)) {
            echo "Error en la consulta";
        }

        $this->cerrar();
    }

    public function consultaDatos($consulta, $param = array())
    {
        $this->conectar();

        $sta = $this->pdo->prepare($consulta);
        $resul = $sta->execute($param);

        if ($resul) {
            $this->filas = $sta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error en la consulta";
        }

        $this->conectar();

        return $this->filas;

    }

    private function cerrar()
    {
        $this->pdo = null;
    }

}


?>