<?php
/*
 * Controller.php. Representa el controlador de la aplicación
 * dentro del patron MVC.
 * Cualquier operación a realizar pasa por aqui. Siempre mandamos 
 * a través de un elemento de formulario o a través de la url
 * una variable llamada operación, que indica cual es la acción que queremos
 * llevar a cabo.
 * En función de ella el controlador haciendo uso de los métodos apropiados
 * de la capa correspondiente al modelo,(En este ejemplo básico esta todo en la
 * clase DaoAlumno), prepara lo necesario para que la capa de presentación
 * muestre la salida al usuario final. 
 * Cuando el acceso es a una página para recoger datos (altaalumno.php por ejemplo)
 * se ha hecho la redirección mediante vinculos, sin pasar por el controlador.
 */
session_start();
require_once '../entidades/classAsignatura.php';
require_once '../dao/classDaoAsignatura.php';
$operacion = $_REQUEST['operacion'];

switch ($operacion) {
    case "listadoAsignaturas":
        $dao = new DaoAsignatura();
        try {
            $listaAsignaturas = $dao->listadoAsignaturas();
            $_SESSION['listaAsignaturas'] = serialize($listaAsignaturas);
            header('Location: ../Vistas/listadoAsignaturas.php');
        } catch (PDOException $e) {
            header('Location: error.php');
        }
        break;
		
	
		
    case "nuevaAsig":
        $Id = $_POST['Id'];
        $nombre = $_REQUEST['Nombre'];
        $curso = $_REQUEST['Curso'];
        $asignatura = new Asignatura();
        $dao = new DaoAsignatura();
        $asignatura->__SET('Id',$Id);
        $asignatura->__SET('Nombre',$nombre);
        $asignatura->__SET('Curso',$curso);
        try {
            $dao->insertarAsignatura($asignatura);
            $listaAsignaturas = $dao->listadoAsignaturas();
            $_SESSION['listaAsignaturas'] = serialize($listaAsignaturas);
            header('Location: ../Vistas/listadoAsignaturas.php');
        } catch (PDOException $e) {
            header('Location: error.php');
        }
        break;
	/*	
		
    case "borraralumno":
        $dao = new DaoAlumno();
        $dni = $_REQUEST['dni'];
        try {
            $dao->borrarAlumno($dni);
            $listaalumnos = $dao->listadoAlumnos();
            $_SESSION['listaalumnos'] = $listaalumnos;
            header('Location: listadoalumnos.php');
        } catch (PDOException $e) {
            header('Location: error.php');
        }
        break;   
	
	*/	
		
		
    case "consultarAsig":

        $dao = new DaoAsignatura();
        $Id = $_POST['Id'];
	
		try {
            $asignatura=$dao->buscarAsignatura($Id);
			
            if($asignatura==NULL)
                $_SESSION['noexisteAsig']=TRUE;
            else
			{  $_SESSION['asignatura']=serialize($asignatura);
             
			  echo "Redirecciona";
			  header('Location: ../Vistas/consultaAsig.php');
		    }
		
        } catch (PDOException $e) {
            header('Location: error.php');
		
        }
	
        break;
		
	/*
		
    case "actualizaralumno":
        $dni = $_REQUEST['dni'];
        $nombre = $_REQUEST['nombre'];
        $curso = $_REQUEST['curso'];
        $alumno = new Alumno();
        $dao = new DaoAlumno();
        $alumno->setDni($dni);
        $alumno->setNombre($nombre);
        $alumno->setCurso($curso);
        try {
            $dao->actualizarAlumno($alumno);
            $listaalumnos = $dao->listadoAlumnos();
            $_SESSION['listaalumnos'] = $listaalumnos;
            header('Location: listadoalumnos.php');
        } catch (PDOException $e) {
            header('Location: error.php');
        }
        break;
		
	*/	
}
?>
