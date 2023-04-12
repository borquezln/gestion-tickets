<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$legajo = $_POST['legajo'];
$motivoBaja = $_POST['motivoBaja'];

if ($co->bajaAgente($legajo, $motivoBaja)) {
    session_start();
    $_SESSION['bajaOk'] = true;
    header('location: ../vistaAgente/index.php?accion=listarAgentes');
}
