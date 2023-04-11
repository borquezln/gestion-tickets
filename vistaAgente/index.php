<?php
ini_set('session.gc_maxlifetime', 5); // each client should remember their session id for EXACTLY 1 hour session_set_cookie_params(3600);
session_start();
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
        $dni = $_GET['dni'];
        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->verEstadisticasAgenteContr($dni);
        break;

    case 'listarTareas':
        error_reporting(0);
        $listado = $_GET['listado'];
        $area = $_GET['area'];
        $area2 = $_GET['area2'];
        $area3 = $_GET['area3'];


        if ($area != $_SESSION['areaUsuario'] || $area2 != $_SESSION['areaUsuario2'] || $area3 != $_SESSION['areaUsuario3']) {
            header("location:javascript:history.go(-1)");
        }


        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->listarTareasAgenteContr($listado);
        break;

    case 'listarTareasAdmin':
        if (isset($_GET['lista'])) {
            $lista = $_GET['lista'];
        } else {
            $lista = '';
        }

        if (isset($_GET['area'])) {
            $areaSupervisor = $_GET['area'];
        } else {
            $areaSupervisor = '';
        }

        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->listarTareasAdminContr($lista, $areaSupervisor);
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
    case 'listarMotivosReq':
        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->listarMotivosReqContr();
        break;

    case 'listarTareaAgente':
        $dni = $_GET['agente'];
        require('../controlador/c_admin.php');
        $controller = new ControladorAdmin();
        $controller->listarTareaAgenteContr($dni);
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
