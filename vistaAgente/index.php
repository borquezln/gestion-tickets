<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!(time() - $_SESSION['time'] >= 3600)) {
    $_SESSION['time'] = time();
    $accion = $_GET['accion'];

    switch ($accion) {
        case 'verEstadisticas':
            error_reporting(0);
            $time = $_GET['time'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->verEstadisticasContr($time, $fechaInicio, $fechaFin);
            break;

        case 'verEstadisticasAgente':
            $legajo = $_GET['legajo'];
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->verEstadisticasAgenteContr($legajo);
            break;

        case 'listarTareas':
            error_reporting(0);
            $listado = $_GET['listado'];
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarTareasAdminContr($listado);
            break;

        case 'listarTareasAdmin':
            if (isset($_GET['lista'])) {
                $lista = $_GET['lista'];
            } else {
                $lista = '';
            }

            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarTareasAdminContr($lista);
            break;

        case 'listarTareasEliminadas':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarTareasEliminadasContr();
            break;

        case 'listarAgentes':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarAgentesContr();
            break;
        case 'listarAreas':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarAreasContr();
            break;

        case 'listarTareaAgente':
            $legajo = $_GET['agente'];
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarTareaAgenteContr($legajo);
            break;
        case 'listarDirecciones':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarDireccionesContr();
            break;
        case 'cambioRoles':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarUsuariosContr();
            break;
        case 'listarBajas':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarUsuariosBajaContr();
            break;
        case 'listarUsuarios':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->listarUsuariosCargadosContr();
            break;
        case 'blanqueoPass':
            require('../controlador/c_admin.php');
            $controller = new ControladorAdmin();
            $controller->pageBlanquearPassContr();
            break;

        default:
            header("location:javascript:history.go(-1)");
            break;
    }
} else {
    require "destroySession.php";
}
