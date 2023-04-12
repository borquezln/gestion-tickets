<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$legajo = $_POST['legajo'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$user = $_POST['user'];
$legajoAnterior = $_POST['legajoAnterior'];

if ($co->editarAgente($legajo, $nombre, $apellido, $correo, $user, $legajoAnterior) == true) {
    session_start();
    $_SESSION['agenteEditado'] = true;
    header('location: ../vista/index.php?accion=listarAgentes&legajo=' . $legajo);
} else {
    header('location: ../vista/index.php?accion=editarEmpleado&legajo=' . $legajo . '&editado=error');
}
