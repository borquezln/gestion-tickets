<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$motivoCancelacion = $_POST['motivoCancelacion'];
$nroArreglo = $_POST['id'];

if($co->cancelarTareaAgente($motivoCancelacion, $nroArreglo)){
    session_start();
    $_SESSION['tareaCancelada'] = true;
    header('location: ../vista/index.php?accion=listarTareas&listado=canceladas');
}
?>