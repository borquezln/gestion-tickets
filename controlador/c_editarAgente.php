<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$user = $_POST['user'];
$dniAnterior = $_POST['dniAnterior'];

if ($co->editarAgente($dni, $nombre, $apellido, $correo, $user, $dniAnterior) == true) {
    session_start();
    $_SESSION['agenteEditado'] = true;
    header('location: ../vista/index.php?accion=listarAgentes&dni=' . $dni);
} else {
    header('location: ../vista/index.php?accion=editarEmpleado&dni=' . $dni . '&editado=error');
}
