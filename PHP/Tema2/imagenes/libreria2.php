<?php

// Parametros de conexión al servidor
$servidor = "localhost";
$usuario = "root";
$pass = "";
$base = "Tema2Blogs";

// Conectar con la BBDD

function Conectar()
{
    global $servidor;
    global $usuario;
    global $pass;
    global $base;
    mysqli_report(MYSQLI_REPORT_OFF); // Desactivar el display de excepciones

    $db = mysqli_connect($servidor, $usuario, $pass, $base);

    if (mysqli_connect_errno()) {

        echo "" . mysqli_connect_error();
        exit();
    }

    return $db;
}

// Ejecutar consultas simples (no devuelven filas)

function consultaSimple($consulta)
{

    $db = Conectar(); // Nos conectamos

    $resultado = mysqli_query($db, $consulta);

    if (!$resultado) { // Si no hay un resultado correcto

        echo "Error en la consulta:" . mysqli_error($db);
    }



}

// Ejecutar consultas devuelven datos (filas)

function consultaDatos($consulta)
{

    $db = Conectar(); // Nos conectamos

    $resultado = mysqli_query($db, $consulta);

    $filas = array();

    if (!$resultado) { // Si no hay un resultado correcto

        echo "Error en la consulta:" . mysqli_error($db);

    } else { // Si hay resultado

        while (($fila = mysqli_fetch_assoc($resultado)) != null) {

            $filas[] = $fila;

        }

    }

    Cerrar($db);
    return $filas;

}
// Cerrar la conexión 
function Cerrar($db)
{
    mysqli_close($db);
}





?>