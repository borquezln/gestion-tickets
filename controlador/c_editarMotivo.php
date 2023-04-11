<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$motivo = $_POST['motivo'];
$codArea = $_POST['selectArea'];
$id = $_POST['id'];

if($co->editarMotivo($motivo, $codArea, $id)){
    session_start();
    $_SESSION['editadoOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarMotivosReq');
}
