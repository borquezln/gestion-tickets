<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$nroArreglo = $_GET['id'];
$dni = $_GET['selectAgentes'];

if ($_SESSION['rol'] == 2) {
    if ($co->tomarTareaAgente($dni, $nroArreglo)) {
        if ($_SESSION['cantAreas'] == 1) {
            $_SESSION['tareaAsignada'] = true;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['tareaAsignada'] = true;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
} else {
    if ($co->tomarTareaAgente($dni, $nroArreglo)) {
        session_start();
        $_SESSION['tareaAsignada'] = true;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
