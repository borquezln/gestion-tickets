<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$idRol = $_POST['selectRol'];
$legajo = $_POST['legajo'];

if ($co->altaUsuario($idRol, $legajo)) {
    session_start();
    $_SESSION['altaOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAgentes');
}
