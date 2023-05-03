<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$area = $_POST['area'];
$descripcion = $_POST['descripcion'];

if ($co->agregarNuevoArea($area, $descripcion)) {
    session_start();
    $_SESSION['areaOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAreas');
}
