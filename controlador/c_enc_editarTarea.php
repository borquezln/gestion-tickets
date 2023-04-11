<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$selectMotivos = $_POST['selectMotivos'];
$descripcion = $_POST['descripcion'];
$ip = $_POST['ip'];
$nombreApellido = $_POST['nombreApellidoAfectado'];
$cel = $_POST['cel'];
$codDireccion = $_POST['selectDireccion'];
$codArea = $_POST['selectArea'];

if (isset($_POST['motivoCancelacion'])) {
    $motivoCancelacion = $_POST['motivoCancelacion'];
} else {
    $motivoCancelacion = '';
}

if (isset($_POST['solucion'])) {
    $solucion = $_POST['solucion'];
} else {
    $solucion = '';
}

$nroArreglo = $_POST['nroArreglo'];

if (isset($motivoCancelacion)) {
    $motivoCancelacion = $motivoCancelacion;
} else {
    $motivoCancelacion = '';
}


/*echo 'selectMotivos: ' . $selectMotivos . '<br>' .
    'descripcion: ' . $descripcion . '<br>' .
    'ip: ' . $ip . '<br>' .
    'selectArea: ' . $selectArea . '<br>' .
    'motivoCancelacion: ' . $motivoCancelacion . '<br>' .
    'solucion: ' . $solucion . '<br>' .
    'nroArreglo: ' . $nroArreglo . '<br>';
*/
if($co->editarTareaEncargado($selectMotivos, $descripcion, $ip, $nombreApellido, $cel, $codDireccion, $motivoCancelacion, $solucion, $codArea, $nroArreglo)){
    session_start();
    $_SESSION['tareaEditada'] = true;
    header('location: ../vista/index.php?accion=listarTareas&listado=actual');
}
