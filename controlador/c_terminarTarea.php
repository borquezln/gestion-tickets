<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$solucion = $_POST['solucion'];
$nroArreglo = $_POST['id'];

$cantAreas = $_SESSION['cantAreas'];

if ($_SESSION['rol'] == 2) {
    if ($co->terminarTareaAgente($solucion, $nroArreglo)) {
        $_SESSION['tareaTerminada'] = true;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    if ($co->terminarTareaAgente($solucion, $nroArreglo)) {
        session_start();
        $_SESSION['tareaTerminada'] = true;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
