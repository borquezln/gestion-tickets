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
    session_destroy();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            body {
                background-color: #5a3377 !important;
                color: white !important;
                padding: 10px;
            }
        </style>
        <?php require('libreriaEstilos.php'); ?>
    </head>

    <body>
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="../vista/login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>

<?php
}
?>