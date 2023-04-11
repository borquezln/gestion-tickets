<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$codArea = $_POST['selectArea'];

if($co->agregarUsuarioAreas($dni, $codArea)){
    session_start();
    $_SESSION['agregadoOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAgentes');
}

?>