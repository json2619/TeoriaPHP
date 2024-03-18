<?php

session_start();
require_once '../entidades/classAlumno.php';
require_once '../dao/classDaoAlumno.php';
$operacion = $_REQUEST['operacion'];
switch ($operacion) {
    case "listadoalumnos":
        $dao = new DaoAlumno();
        try {
            $listaalumnos = $dao->listadoAlumnos();
            $_SESSION['listaalumnos'] = serialize($listaalumnos);
            header('Location: ../Vistas/listadoalumnos.php');
        } catch (PDOException $e) {
            header('Location: ../Vistas/error.php');
        }
        break;
    case "nuevoalumno":
        $dni = $_REQUEST['dni'];
        $nombre = $_REQUEST['nombre'];
        $curso = $_REQUEST['curso'];
        $alumno = new Alumno();
        $dao = new DaoAlumno();
        $alumno->setDni($dni);
        $alumno->setNombre($nombre);
        $alumno->setCurso($curso);
        try {
            $dao->insertarAlumno($alumno);
            $listaalumnos = $dao->listadoAlumnos();
            $_SESSION['listaalumnos'] = serialize($listaalumnos);
            header('Location: ../Vistas/listadoalumnos.php');
        } catch (PDOException $e) {
            header('Location: ../Vistas/error.php');
        }
        break;
    case "borraralumno":
        $dao = new DaoAlumno();
        $dni = $_REQUEST['dni'];
        try {
            $dao->borrarAlumno($dni);
            $listaalumnos = $dao->listadoAlumnos();
            $_SESSION['listaalumnos'] = $listaalumnos;
            header('Location: ../Vistas/listadoalumnos.php');
        } catch (PDOException $e) {
            header('Location: ../Vistas/error.php');
        }
        break;   
    case "consultaralumno":
        $dao = new DaoAlumno();
        $dni = $_REQUEST['dni'];
        $_SESSION['dni']=$dni;
        try {
            $alumno=$dao->buscarAlumnoPorDni($dni);
            if($alumno==NULL)
                $_SESSION['noexistealumno']=TRUE;
            else
                $_SESSION['alumnoabuscar'] =$alumno;
            header('Location: ../Vistas/consultaalumno.php');
        } catch (PDOException $e) {
            header('Location: ../Vistas/error.php');
        }
        break;
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
            header('Location: ../Vistas/listadoalumnos.php');
        } catch (PDOException $e) {
            header('Location: ../Vistas/error.php');
        }
        break;
}
?>
