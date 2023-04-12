<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$legajo = $_GET['legajo'];
$codArea = $_GET['selectArea'];


echo $legajo . '<br>';
echo $codArea;
if ($co->eliminarAreaUsuario($legajo, $codArea)) {
    session_start();
    $_SESSION['eliminadoOk'] = true;
    header('Location: ../vistaAgente/index.php?accion=listarAgentes');
}
