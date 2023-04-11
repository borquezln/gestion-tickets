<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$motivo = $_POST['motivo'];
$codArea = $_POST['selectArea'];

if($co->agregarNuevoMotivo($motivo, $codArea)){
    session_start();
    $_SESSION['motivoOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarMotivosReq');
}
