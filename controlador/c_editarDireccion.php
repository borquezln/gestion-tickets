<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$codigoAnterior = $_POST['codigoAnterior'];
$codigo = $_POST['codigo'];
$direccion = $_POST['direccion'];
$descripcion = $_POST['descripcion'];

if ($co->editarDireccion($codigo, $direccion, $descripcion, $codigoAnterior)) {
    session_start();
    $_SESSION['direccionEditada'] = true;
    header('location: ../vistaAgente/index.php?accion=listarDirecciones');
}else{
    session_start();
    $_SESSION['direccionEditadaError'] = true;
    header('location: ../vistaAgente/index.php?accion=listarDirecciones');
}
