<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!(time() - $_SESSION['time'] >= 3600)) {
    $_SESSION['time'] = time();
    if ($_SESSION['rol'] == 1) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="3600">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Inicio - Gestión de tareas Sistemas</title>
            <?php require('libreriaEstilos.php'); ?>
        </head>

        <style>
            body {
                /* fallback for old browsers */
                background-color: #e6ece8;

            }

            section {
                padding: 15px;
            }

            section a {
                text-decoration: none;
            }

            section a:hover {
                text-decoration: underline;
            }
        </style>


        <body>
            <?php require('headerNav.php'); ?>
            <section id="container">
                <p class="fs-5">Bienvenido <?php echo $_SESSION['nombreApellido']; ?></p>

                <?php
                error_reporting(0);
                $datosAct = $_SESSION['datosAct'];
                if ($datosAct == true) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Los datos han sido modificados',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['datosAct']);
                }
                ?>

                <?php
                require_once('../modelo/m_consultas.php');
                require_once('../modelo/m_estadisticas.php');
                $co = new Consultas();
                $est = new ConsultasEstadisticas();

                $totalTareas = $est->contarTareasTotal();
                $totalPendientes = $co->contarTareasPendientes();
                $totalEnProgreso = $co->contarTareasEnProgreso();
                $totalCompletas = $co->contarTareasCompletas();
                $totalCanceladas = $co->contarTareasCanceladas();
                $totalEliminadas = $co->contarTareasEliminadas();
                $totalDirecciones = $co->contarDirecciones();
                $cantAgentes = $co->contarAgentes();
                ?>


                <div class="row justify-content-center">
                    <div class="card border-dark mb-3 col-auto">
                        <div class="card-body text-dark d-flex flex-column align-items-center">
                            <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                            <h1 class="card-title"><?php echo $totalTareas; ?></h1>
                            <p class="card-text">Total de tareas</p>
                        </div>
                    </div>

                    <div class="card border-dark mb-3 col-auto ms-5">
                        <div class="card-body text-dark d-flex flex-column align-items-center">
                            <i class="bi bi-bookmark-x" style="font-size: 40px;"></i>
                            <h1 class="card-title"><?php echo $totalEliminadas; ?></h1>
                            <p class="card-text">Total de eliminadas</p>
                        </div>
                    </div>
                </div>

                <div id="estados" class="row justify-content-evenly">

                    <a href="index.php?accion=listarTareas&listado=actual" class="text-secondary col-auto">
                        <div class="card border-secondary mb-3">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="bi bi-list-task" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $totalPendientes; ?></h1>
                                <p class="card-text">Total de tareas 'Pendientes'</p>
                            </div>
                        </div>
                    </a>

                    <a href="index.php?accion=listarTareas&listado=actual" class="text-primary col-auto">
                        <div class="card border-primary mb-3">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $totalEnProgreso; ?></h1>
                                <p class="card-text">Total de tareas 'En progreso'</p>
                            </div>
                        </div>
                    </a>

                    <a href="index.php?accion=listarTareas&listado=completadas" class="text-success col-auto">
                        <div class="card border-success mb-3">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $totalCompletas; ?></h1>
                                <p class="card-text">Total de tareas 'Completas'</p>
                            </div>
                        </div>
                    </a>


                    <a href="index.php?accion=listarTareas&listado=canceladas" class="text-danger col-auto">
                        <div class="card border-danger mb-3">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $totalCanceladas; ?></h1>
                                <p class="card-text">Total de tareas 'Canceladas'</p>
                            </div>
                        </div>
                    </a>

                </div>

                <div id="direccion" class="row justify-content-center">
                    <a href="index.php?accion=listarAreas" class="text-dark col-auto">
                        <div class="card border-dark mb-3">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="bi bi-card-list" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $totalDirecciones; ?></h1>
                                <p class="card-text">Total de Direcciones/Entidades</p>
                            </div>
                        </div>
                    </a>
                </div>

            </section>
        </body>

        </html>

    <?php
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
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>

<?php
}
?>