<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$legajo = $_POST['selectUsuario'];
$idRol = $_POST['selectRol'];

if ($co->asignarRolUsuario($idRol, $legajo)) {
    session_start();
    $_SESSION['asignadoOk'] = true;
    if ($idRol < 5) {
        if ($co->quitarTareaAdmin($legajo)) {
            header('location: ../vistaAgente/index.php?accion=cambioRoles');
        }
    }
} else {
    session_start();
    $_SESSION['asignadoError'] = true;
    header('location: ../vistaAgente/index.php?accion=cambioRoles');
}
