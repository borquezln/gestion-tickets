<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$selectMotivos = $_POST['selectMotivos'];
$descripcion = $_POST['descripcion'];
if (isset($_POST['nota_electronica'])) {
    $nota_electronica = $_POST['nota_electronica'];
} else {
    $nota_electronica = '';
}

$nombreApellido = $_POST['nombreApellidoAfectado'];
$cel = $_POST['cel'];
$direccion = $_POST['selectDireccion'];
$selectArea = $_POST['selectArea'];

$usuarioCreado = $_POST['nombreApellido'];

/*echo 'SelectMotivos: ' . $selectMotivos . '<br>' .
'descripcion: ' . $descripcion . '<br>' .
'nota_electronica: ' . $nota_electronica . '<br>' .
'nombreApellido: ' . $nombreApellido . '<br>' .
'cel: ' . $cel . '<br>' .
'direccion: ' . $direccion . '<br>' .
'selectArea: ' . $selectArea . '<br>';*/

if ($co->agregarTareaEncargado($selectMotivos, $descripcion, $nota_electronica, $nombreApellido, $cel, $direccion, $selectArea, $usuarioCreado)) {
    $_SESSION['tareaOK'] = true;
    header('location: ../vista/index.php?accion=listarTareas&listado=actual');
} else {
    $_SESSION['tareaAgregadaError'] = true;
    header('location: ../vista/index.php?accion=listarTareas');
}
