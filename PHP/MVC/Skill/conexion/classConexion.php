<?php

/**
 * Description of Conexion
 *
 * Contiene un único método getPDO que nos devuelve un objeto PDO(PHP DATA OBJECT)
 * asociado a nuestra base de datos.
 * PDO::ATTR_PERSISTENT=>true  habilita conexiones persistentes (cerrado lógico)
 * $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) para poder capturar
 * las excepciones asociadas a sentencias SQL.
 * Este objeto es reutilizable solo habría que cambiar en la url el host,dbname  
 * Y el usuario y la password de la base de datos a la que conectar.
 * 
 * Un objeto PDO sería parecido a un objeto java.sql.Connection de Java. 
 * Nos permite lanzar sentencias sql sobre la base de datos asociada.
 * 
 */
class Conexion {
    public function getPDO(){
        $usuario='root';
        $password='';
        try{
          $pdo=new PDO('mysql:host=localhost;dbname=alumnos', $usuario, $password,array(PDO::ATTR_PERSISTENT=>true));
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $pdo;
        }catch(PDOException $e) {
            $_SESSION['errorconexion']=$e->getMessage();
            throw $e;
        }
    }
}
?>
