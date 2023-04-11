<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_GET['dni'];
$codArea = $_GET['selectArea'];


echo $dni . '<br>';
echo $codArea;
if($co->eliminarAreaUsuario($dni, $codArea)){
    session_start();
    $_SESSION['eliminadoOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAgentes');
}

?>