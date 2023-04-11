<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$idRol = $_POST['selectRol'];
$dni = $_POST['dni'];

if($co->altaUsuario($idRol, $dni)){
    session_start();
    $_SESSION['altaOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAgentes');
}
?>