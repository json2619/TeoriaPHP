<?php

// Script para ir probando el primer DAO

require_once('DaoSituaciones.php');

$daoSit = new DaoSituaciones("examen");

$daoSit->listar();

foreach ($daoSit->situaciones as $situ) {
    echo $situ->__get("Id") . " " . $situ->__get("Nombre") . "<br>";
}

echo "<p></p>";

$Id = 4;
$situ = $daoSit->obtener($Id);
echo "El nombre de la situación con Id: $Id es: " . $situ->__get("Nombre");

echo "<p></p>";

$daoSit->borrar($Id);

echo "<p></p>";

$situ = new Situacion();

$situ->__set("Id", 5);
$situ->__set("Nombre", "Despedido");
$daoSit->insertar($situ);

echo "<p></p>";

$situ = new Situacion();

$situ->__set("Id", 5);
$situ->__set("Nombre", "Echado");
$daoSit->actualizar($situ);