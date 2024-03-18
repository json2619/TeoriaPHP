<?php
/**
 * Description of DaoAlumno
 * Representa nuestro objeto de acceso a datos para la tabla alumnos.
 * Contiene los métodos necesarios para:
 * Dar de alta un alumno
 * Actualizar un alumno
 * Eliminar un alumno
 * Buscar un alumno por dni
 * Listado completo de la tabla alumnos
 * 
 */
require_once '../entidades/classAlumno.php';
require_once '../conexion/classConexion.php';

 class DaoAlumno{
 
/***************************************************************************/
/*
 * Función para dar de alta un alumno
 * Parámetros: $alumno (Objeto con los datos del alumno a dar de alta)
 */     
     public  function  insertarAlumno($alumno){
        $conexion=new Conexion(); // para acceder a la base de datos a traves de nuestra clase Conexion
        $objPDO=$conexion->getPDO(); // obtenemos nuestro PHP DATA OBJECT
        //sentencia parametrizada para dar de alta a un alumno
        $ordenSql = "insert into alumnos values(:dni,:nombre,:curso)"; 
        $statement=$objPDO->prepare($ordenSql);// creación de la sentencia .
        // a continuacion se asocian cada uno de los parametros, el segundo parámetro es para una validación de tipo (opcional)
        $statement->bindParam ( ':dni', $alumno->getDni(), PDO::PARAM_STR );
        $statement->bindParam ( ':nombre', $alumno->getNombre(), PDO::PARAM_STR );
        $statement->bindParam ( ':curso', $alumno->getCurso(), PDO::PARAM_STR );  
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
/********************************************************************************/  
/*
 * Función para actualizar un alumno
 * Parámetros: $alumno (Objeto con los datos del alumno actualizaos)
 * El funcionamiento es idéntico al método insertarAlumno.
 * Solo cambiamos la sentencia SQL.
 */ 
     public  function  actualizarAlumno($alumno){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $ordenSql = "update alumnos set nombre=:nombre,
                     curso=:curso where dni=:dni";
        $statement=$objPDO->prepare($ordenSql);
        $statement->bindParam ( ':dni', $alumno->getDni(), PDO::PARAM_STR );
        $statement->bindParam ( ':nombre', $alumno->getNombre(), PDO::PARAM_STR );
        $statement->bindParam ( ':curso', $alumno->getCurso(), PDO::PARAM_STR );
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
 * Función para eliminar un alumno
 * Parámetros: $dni (Dni del alumno a eliminar)
 * El funcionamiento es idéntico al método insertarAlumno.
 * Solo cambiamos la sentencia SQL.
 */     
     public function borrarAlumno($dni){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $ordenSql = "delete from alumnos 
                     where dni=:dni";
        $statement=$objPDO->prepare($ordenSql);
        $statement->bindParam ( ':dni',$dni, PDO::PARAM_STR ); 
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
     public function buscarAlumnoPorDni($dni){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $alumno=new Alumno();
        //sentencia parametrizada para dar realizar la consulta
        $ordenSql = "select * from alumnos where dni=:dni";
        $statement=$objPDO->prepare($ordenSql); // crear la consulta
        $statement->bindParam ( ':dni',$dni, PDO::PARAM_STR ); //asociar parametro
         try {
           $statement->execute(); // ejecutar sentencia.
           $fila = $statement->fetch( PDO::FETCH_ASSOC );
           if($fila!=null){  // el alumno existe
                $alumno->setDni($fila['DNI']);
                $alumno->setNombre($fila['NOMBRE']);
                $alumno->setCurso($fila['CURSO']);
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
        return $alumno;
     }
/********************************************************************************/   
     /*
      * Función para guardar en un array el listado actual de alumnos.
      * 
      */
     public function listadoAlumnos(){
        $conexion=new Conexion();
        $objPDO=$conexion->getPDO();
        $ordenSql = "select * from alumnos order by dni";
        $statement=$objPDO->prepare($ordenSql);
        $listaalumnos=array();  // para almacenar el listado completo de alumnos
        try{
           $statement->execute();
           // Creamos un objeto alumno por cada alumno almacenado en la base de 
           // datos y lo añadimos a nuestro array $listaalumnos.
           while ($fila = $statement->fetch ( PDO::FETCH_ASSOC ) ) {
            $alumno=new Alumno();
            $alumno->setDni($fila['DNI']);
            $alumno->setNombre($fila['NOMBRE']);
            $alumno->setCurso($fila['CURSO']);
            $listaalumnos[]=$alumno;
           }
        } catch ( PDOException $e ) {
            throw new PDOException($e);
        }
        finally{
               $statement=NULL;  // para cerrar la conexión usamos estas dos órdenes.
               $objPDO=NULL; 
        }         
        return $listaalumnos;
     }

 }
