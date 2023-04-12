<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$nroArreglo = $_POST['nroArreglo'];
$selectArea = $_POST['selectArea'];
$selectMotivos = $_POST['selectMotivos'];
$descripcion = $_POST['descripcion'];
$nota_electronica = $_POST['nota_electronica'];
$selectDireccion = $_POST['selectDireccion'];

if (isset($_POST['nombreApellidoAfectado'])) {
    $nombre_apellido = $_POST['nombreApellidoAfectado'];
} else {
    $nombre_apellido = '';
}

if (isset($_POST['cel'])) {
    $cel = $_POST['cel'];
} else {
    $cel = '';
}

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


/*echo 'nroArreglo: ' . $nroArreglo . '<br>' . 
'selectMotivos: ' . $selectMotivos . '<br>' .
'descripcion: ' . $descripcion . '<br>' .
'nota_electronica: ' . $nota_electronica . '<br>' .
'selectDireccion: ' . $selectDireccion . '<br>' .
'nombreApellido: ' . $nombre_apellido . '<br>' .
'celular: ' . $cel . '<br>' .
'Motivo Cancelación: ' . $motivoCancelacion . '<br>' .
'Materiales utiliados: ' . $solucion . '<br>';*/

if ($_SESSION['rol'] == 2) {
    if ($co->editarTareaAgente($selectMotivos, $descripcion, $nota_electronica, $nombre_apellido, $cel, $selectDireccion, $motivoCancelacion, $solucion, $selectArea, $nroArreglo)) {
        $_SESSION['tareaEditada'] = true;
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
} else if ($_SESSION['rol'] == 3) {
    if ($co->editarTareaAgente($selectMotivos, $descripcion, $nota_electronica, $nombre_apellido, $cel, $selectDireccion, $motivoCancelacion, $solucion, $selectArea, $nroArreglo)) {
        $_SESSION['tareaEditada'] = true;
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    if ($co->editarTareaAgente($selectMotivos, $descripcion, $nota_electronica, $nombre_apellido, $cel, $selectDireccion, $motivoCancelacion, $solucion, $selectArea, $nroArreglo)) {
        $_SESSION['tareaEditada'] = true;
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
