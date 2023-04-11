<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$codigo = $_POST['codigo'];
$direccion = $_POST['direccion'];
$descripcion = $_POST['descripcion'];

if ($co->agregarDireccion($codigo, $direccion, $descripcion)) {
    session_start();
    $_SESSION['direccionOk'] = true;
    header('location: ../vistaAgente/index.php?accion=listarDirecciones');
}else{
    header('location: ../vistaAgente/index.php?accion=listarDirecciones');
}
