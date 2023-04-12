<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$legajo = $_POST['legajo'];
$codArea = $_POST['selectArea'];

if ($co->agregarUsuarioAreas($legajo, $codArea)) {
    session_start();
    $_SESSION['agregadoOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAgentes');
}
