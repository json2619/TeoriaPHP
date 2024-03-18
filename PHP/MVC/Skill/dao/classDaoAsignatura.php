<?php

require_once '../entidades/classAsignatura.php';
require_once '../conexion/classConexion.php';

 class DaoAsignatura{
 
  
     public  function  insertarAsignatura($asignatura){
        $conexion=new Conexion(); // para acceder a la base de datos a traves de nuestra clase Conexion
        $objPDO=$conexion->getPDO(); // obtenemos nuestro PHP DATA OBJECT
        //sentencia parametrizada para dar de alta a un alumno
        $ordenSql = "insert into asignaturas values(:Id,:Nombre,:Curso)"; 
        $statement=$objPDO->prepare($ordenSql);// creación de la sentencia .
        // a continuacion se asocian cada uno de los parametros, el segundo parámetro es para una validación de tipo (opcional)
        $statement->bindParam ( ':Id', $asignatura->__GET('Id'), PDO::PARAM_STR );
        $statement->bindParam ( ':Nombre', $asignatura->__GET('Nombre'), PDO::PARAM_STR );
        $statement->bindParam ( ':Curso', $asignatura->__GET('Curso'), PDO::PARAM_STR );  
        try {
               $objPDO->beginTransaction(); // Iniciar la transaccion
               $statement->execute (); //ejecutar la sentencia 
               $objPDO->commit();    // confirmar transaccion  
        } catch ( PDOException $e) {
            // para capturar el error mysql usamos $statement->errorInfo();
            // devuelve un array con 3 elementos. 
            // Me interesa la posicion 1: Codigo de error MYSQL asociado 
            // a la sentencia que ha fallado.
            // Me interesa la posicion 2: Mensaje de error MYSQL asociado 
            // a la sentencia que ha fallado.
            // Guardamos la información en una variable de sesión para después 
            // usarla. (Ver página error.php)
            $_SESSION['errormysql']=$statement->errorInfo();
            throw ($e); 
        }
        finally{
               $statement=NULL;  // para cerrar la conexión usamos estas dos órdenes.
               $objPDO=NULL; 
        }
     }

     public  function  actualizarAsignatura($asignatura){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $ordenSql = "update asignaturas set Nombre=:Nombre,
                     Curso=:Curso where Id=:Id";
        $statement=$objPDO->prepare($ordenSql);
        $statement->bindParam ( ':Id', $asignatura->__GET('Id'), PDO::PARAM_STR );
        $statement->bindParam ( ':Nombre', $asignatura->__GET('Nombre'), PDO::PARAM_STR );
        $statement->bindParam ( ':Curso', $asignatura->__GET('Curso'), PDO::PARAM_STR );
        try {
              $objPDO->beginTransaction();
              $statement->execute (); 
              $objPDO->commit();              
        } catch ( PDOException $e ) {
            $_SESSION['errormysql']=$statement->errorInfo();
            throw ($e); 
        } 
        finally{
               $statement=NULL;  // para cerrar la conexión usamos estas dos órdenes.
               $objPDO=NULL; 
        }        
     }
    
     public function borrarAsignatura($Id){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $ordenSql = "delete from asignaturas 
                     where Id=:Id";
        $statement=$objPDO->prepare($ordenSql);
        $statement->bindParam ( ':Id',$Id, PDO::PARAM_STR ); 
        try {
              $objPDO->beginTransaction();
              $statement->execute (); 
              $objPDO->commit();
        } catch ( PDOException $e ) {
            $_SESSION['errormysql']=$statement->errorInfo();
            throw ($e); 
        } 
        finally{
               $statement=NULL;  // para cerrar la conexión usamos estas dos órdenes.
               $objPDO=NULL; 
        } 
     }
/********************************************************************************/ 
/*
 * Función para localizar un alumno por su clave primaria (dni)
 * Parametro: $dni. Dni del alumno a localizar.
 * Devuelve: Un objeto $alumno si el alumno está en nuestra base de datos
 *           NULL en caso contrario.
 */
     public function buscarAsignatura($Id){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $asignatura=new Asignatura();
        //sentencia parametrizada para dar realizar la consulta
        $ordenSql = "select * from asignaturas where Id=:Id";
        $statement=$objPDO->prepare($ordenSql); // crear la consulta
        $statement->bindParam ( ":Id",$Id, PDO::PARAM_STR ); //asociar parametro
         try {
           $statement->execute(); // ejecutar sentencia.
           $fila = $statement->fetch( PDO::FETCH_ASSOC );
           if($fila!=null){  // el alumno existe
                $asignatura->__SET('Id',$fila['Id']);   
                $asignatura->__SET('Nombre',$fila['Nombre']);
                $asignatura->__SET('Curso',$fila['Curso']);
           }
           else{
               $alumno=NULL;
           }
        } catch ( PDOException $e ) {
            $_SESSION['errormysql']=$statement->errorInfo();
            throw ($e); 
        } 
        finally{
               $statement=NULL;  // para cerrar la conexión usamos estas dos órdenes.
               $objPDO=NULL; 
        } 
        return $asignatura;
     }
/********************************************************************************/   
     /*
      * Función para guardar en un array el listado actual de alumnos.
      * 
      */
     public function listadoAsignaturas(){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $ordenSql = "select * from asignaturas order by 1";
        $statement=$objPDO->prepare($ordenSql);
        $listaAsignaturas=array();  // para almacenar el listado completo de alumnos
        try{
           $statement->execute();
           // Creamos un objeto alumno por cada alumno almacenado en la base de 
           // datos y lo añadimos a nuestro array $listaalumnos.
           while ($fila = $statement->fetch ( PDO::FETCH_ASSOC ) ) {
            $asignatura=new Asignatura();
            $asignatura->__SET('Id',$fila['Id']);
            $asignatura->__SET('Nombre',$fila['Nombre']);
            $asignatura->__SET('Curso',$fila['Curso']);
            $listaAsignaturas[]=$asignatura;
           }
        } catch ( PDOException $e ) {
            throw new PDOException($e);
        }
        finally{
               $statement=NULL;  // para cerrar la conexión usamos estas dos órdenes.
               $objPDO=NULL; 
        }         
        return $listaAsignaturas;
     }

 }
