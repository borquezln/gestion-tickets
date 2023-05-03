<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$tipoUsuario = $_POST['selectRol'];

if (isset($_POST['selectCantArea'])) {
    $cantAreas = $_POST['selectCantArea'];
} else {
    $cantAreas = '';
}

$selectAreas = $_POST['selectArea'];

$legajo = $_POST['legajo'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];
} else {
    $correo = '';
}

$username = $_POST['user'];
$pass = $_POST['pass'];


foreach ($selectArea as $area) {
    echo 'Area: ' . $area;
}

if ($co->agregarUsuario($tipoUsuario, $legajo, $nombre, $apellido, $correo, $username, $pass)) {
    if (isset($selectAreas)) {
        foreach ($selectAreas as $codArea) {
            $co->agregarUsuarioAreas($legajo, $codArea);
        }
        session_start();
        $_SESSION['usuarioAgregado'] = true;
        header('Location: ../vistaAgente/index.php?accion=listarUsuarios');
    } else {
        session_start();
        $_SESSION['usuarioAgregado'] = true;
        header('Location: ../vistaAgente/index.php?accion=listarUsuarios');
    }
} else {
    session_start();
    $_SESSION['usuarioError'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarUsuarios');
}
