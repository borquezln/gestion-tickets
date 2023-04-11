<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$userAnterior = $_POST['userAnterior'];
$rol = $_POST['rol'];

if ($co->editarDatosUsuario($dni, $nombre, $apellido, $correo, $user, $pass, $userAnterior)) {
    session_start();
    if ($rol == 2 || $rol == 3 || $rol == 4) {
        $_SESSION['datosAct'] = true;
        header('Location: ../vistaAgente/inicio.php');
    } else if ($rol == 1) {
        $_SESSION['datosAct'] = true;
        header('Location: ../vista/inicio.php');
    }
} else {
    session_start();
    if ($rol == 2 || $rol == 3 || $rol == 4) {
        $_SESSION['datosActError'] = true;
        header('Location: ../vistaAgente/inicio.php');
    } else if ($rol == 1) {
        $_SESSION['datosActError'] = true;
        header('Location: ../vista/inicio.php');
    }
}
