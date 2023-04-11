<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$pass = $_POST['pass'];

if ($co->blanquearPass($dni, $pass)) {
    session_start();
    $_SESSION['passBlanqueada'] = true;
    header('location: ../vistaAgente/index.php?accion=blanqueoPass');
}
