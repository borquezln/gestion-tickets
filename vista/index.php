<?php
session_start();
$accion = $_GET['accion'];

switch ($accion) {
    case 'listarTareas':
        $listado = $_GET['listado'];
        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->listarTareasEncargadoContr($listado);
        break;

    case 'listarAreas':
        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->listarDireccionesContr();
        break;

}
