<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$solucion = $_POST['solucion'];
$comprobante = $_POST['comprobante'];
$nroArreglo = $_POST['id'];

$cantAreas = $_SESSION['cantAreas'];

if ($co->terminarTarea($solucion, $comprobante, $nroArreglo)) {
    $_SESSION['tareaTerminada'] = true;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}