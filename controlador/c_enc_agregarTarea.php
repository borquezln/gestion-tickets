<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$descripcion = $_POST['descripcion'];
$nombreApellido = $_POST['nombreApellidoAfectado'];
$cel = $_POST['cel'];
$direccion = $_POST['selectDireccion'];
$selectArea = $_POST['selectArea'];
$usuarioCreado = $_POST['nombreApellido'];

if (isset($_POST['nota_electronica'])) {
    $nota_electronica = $_POST['nota_electronica'];
} else {
    $nota_electronica = '';
}

if ($co->agregarTareaEncargado($descripcion, $nota_electronica, $nombreApellido, $cel, $direccion, $selectArea, $usuarioCreado)) {
    $_SESSION['tareaOK'] = true;
    header('location: ../vista/index.php?accion=listarTareas&listado=actual');
} else {
    $_SESSION['tareaAgregadaError'] = true;
    header('location: ../vista/index.php?accion=listarTareas');
}
