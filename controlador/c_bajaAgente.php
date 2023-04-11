<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$motivoBaja = $_POST['motivoBaja'];

if ($co->bajaAgente($dni, $motivoBaja)) {
    session_start();
    $_SESSION['bajaOk'] = true;
    header('location: ../vistaAgente/index.php?accion=listarAgentes');
}
