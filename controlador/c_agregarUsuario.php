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

$dni = $_POST['dni'];
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

/*echo 'tipoUsuario: ' . $tipoUsuario . '<br>' .
    'dni: ' . $dni . '<br>' .
    'cantAreas: ' . $selectAreas . '<br>' .
    'nombre: ' . $nombre . '<br>' .
    'apellido: ' . $apellido . '<br>' .
    'correo: ' . $correo . '<br>' .
    'username: ' . $username . '<br>' .
    'pass: ' . $pass . '<br>';*/

if ($co->agregarUsuario($tipoUsuario, $dni, $nombre, $apellido, $correo, $username, $pass)) {
    if (isset($selectAreas)) {
        foreach ($selectAreas as $codArea) {
            $co->agregarUsuarioAreas($dni, $codArea);
        }
        session_start();
        $_SESSION['usuarioAgregado'] = true;
        header('Location: ../vistaAgente/index.php?accion=listarUsuarios');
    }else{
        session_start();
        $_SESSION['usuarioAgregado'] = true;
        header('Location: ../vistaAgente/index.php?accion=listarUsuarios');
    }
} else {
    session_start();
    $_SESSION['usuarioError'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarUsuarios');
}
