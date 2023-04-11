<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$nroArreglo = $_GET['id'];

$cantAreas = $_SESSION['cantAreas'];

if ($_SESSION['rol'] == 2) {
    if ($co->quitarAgenteAsignado($nroArreglo)) {
        if ($cantAreas == 1) {
            $_SESSION['tareaAsignadaQuitada'] = true;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['tareaAsignadaQuitada'] = true;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
} else {
    if ($co->quitarAgenteAsignado($nroArreglo)) {
        session_start();
        $_SESSION['tareaAsignadaQuitada'] = true;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
