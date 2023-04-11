<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!(time() - $_SESSION['time'] >= 3600)) {
    $_SESSION['time'] = time();
    if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="3600">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Inicio - Gestión de tareas Sistemas</title>
            <?php require('libreriaEstilos.php'); ?>

            <style>
                body {
                    /* fallback for old browsers */
                    background-color: #e6ece8;

                }

                section {
                    margin-left: 180px;
                    padding: 15px;
                }

                section a {
                    text-decoration: none;
                }

                section a:hover {
                    text-decoration: underline;
                }
            </style>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        </head>

        <body>
            <?php
            require('headerNav.php');

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
            if ($_SESSION['datosActError'] == true) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'No se han podido modificar los datos',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['datosActError']);
            }
            ?>

            <?php
            require_once('../modelo/m_estadisticas.php');
            require_once('../modelo/m_consultas.php');
            $co = new Consultas();
            $est = new ConsultasEstadisticas();
            if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {

                $tareasTotalArea = $co->contarTotalTareasAreas($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
                //
                $tareasPendientesArea = $co->contarTareasPendientesArea($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
                $tareasCompletasArea = $co->contarTareasCompletasArea($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
                $tareasEnProgresoArea = $co->contarTareasEnProgresoArea($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
                $tareasCanceladasArea = $co->contarTareasCanceladasArea($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
                //
                $nroCompletasUser = $co->contarTareasCompletasUser($_SESSION['username']);
            }
            $totalTareasSistemas = $est->contarTareasTotal();
            $tareasPendientes = $co->contarTareasPendientes();
            $tareasEnProgreso = $co->contarTareasEnProgreso();
            $tareasCompletas = $co->contarTareasCompletas();
            $tareasCanceladas = $co->contarTareasCanceladas();
            $totalTareasEliminadas = $co->contarTareasEliminadas();
            //Usuarios
            $totalUsuarios = $co->contarTotalUsuarios();
            $totalAdmin = $co->contarAdmin();
            $totalSuperv = $co->contarSupervisores();
            $totalAgentes = $co->contarAgentes();
            $totalEncargados = $co->contarEncargados();
            //Areas
            $totalDirecciones = $co->contarDirecciones();
            ?>

            <section id="container">

                <p class="fs-5">Bienvenido <?php echo $_SESSION['nombreApellido']; ?></p>
                <p class="fs-5 text-center">Tareas</p>

                <div class="row justify-content-center">

                    <?php
                    if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {
                    ?>

                        <div class="card border-dark mb-3 col-auto">
                            <div class="card-body text-dark d-flex flex-column align-items-center">
                                <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $tareasTotalArea; ?></h1>
                                <p class="card-text">Total de tareas de <?php echo $_SESSION['areaUsuarioNombre']; ?></p>
                            </div>
                        </div>


                    <?php
                    } else {
                    ?>

                        <div class="card border-dark mb-3 col-auto">
                            <div class="card-body text-dark d-flex flex-column align-items-center">
                                <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?php echo $totalTareasSistemas; ?></h1>
                                <p class="card-text">Total de tareas</p>
                            </div>
                        </div>

                        <a href="index.php?accion=listarTareasEliminadas" class="col-auto text-dark">
                            <div class="card border-dark mb-3 ms-5">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $totalTareasEliminadas; ?></h1>
                                    <p class="card-text">Total de eliminadas</p>

                                </div>
                            </div>
                        </a>


                    <?php
                    }
                    ?>

                </div>

                <?php
                if ($_SESSION['rol'] == 2) {
                ?>

                    <div class="row justify-content-evenly" id="estados">

                        <a href="index.php?accion=listarTareas&listado=actual&area=<?php echo $_SESSION['areaUsuario']; ?>&area2=<?php echo $_SESSION['areaUsuario2']; ?>&area3=<?php echo $_SESSION['areaUsuario3'] ?>" class="text-secondary col-auto">
                            <div class="card border-secondary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-task" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasPendientesArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Pendientes'</p>

                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareas&listado=actual&area=<?php echo $_SESSION['areaUsuario']; ?>&area2=<?php echo $_SESSION['areaUsuario2']; ?>&area3=<?php echo $_SESSION['areaUsuario3'] ?>" class="text-primary col-auto">
                            <div class="card border-primary mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasEnProgresoArea; ?></h1>
                                    <p class="card-text">Total de tareas 'En progreso'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareas&listado=completas&area=<?php echo $_SESSION['areaUsuario']; ?>&area2=<?php echo $_SESSION['areaUsuario2']; ?>&area3=<?php echo $_SESSION['areaUsuario3'] ?>" class="text-success col-auto">
                            <div class="card border-success mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasCompletasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Completas'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareas&listado=canceladas&area=<?php echo $_SESSION['areaUsuario']; ?>&area2=<?php echo $_SESSION['areaUsuario2']; ?>&area3=<?php echo $_SESSION['areaUsuario3'] ?>" class="text-danger col-auto">
                            <div class="card border-danger mb-3 col-auto">
                                <div class="card-body text-danger d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasCanceladasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Canceladas'</p>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="card border-success mb-3 col-12">
                        <div class="card-body text-success d-flex flex-column justify-content-start">
                            <div class="d-flex justify-content-between">
                                <h1 class="card-title"><?php echo $nroCompletasUser; ?></h1>
                                <i class="bi bi-list-check" style="font-size: 40px;"></i>
                            </div>
                            <p class="card-text">Total de tareas 'Completas' por <?php echo $_SESSION['nombreApellido']; ?></p>
                        </div>
                    </div>

                <?php
                } else if ($_SESSION['rol'] == 4) {
                ?>

                    <div class="row justify-content-evenly" id="estados">

                        <a href="index.php?accion=listarTareasAdmin&area=<?php echo $_SESSION['areaUsuario']; ?>&lista=actual" class="text-secondary col-auto">
                            <div class="card border-secondary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-task" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasPendientesArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Pendientes'</p>

                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&area=<?php echo $_SESSION['areaUsuario']; ?>&lista=actual" class="text-primary col-auto">
                            <div class="card border-primary mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasEnProgresoArea; ?></h1>
                                    <p class="card-text">Total de tareas 'En progreso'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&area=<?php echo $_SESSION['areaUsuario']; ?>&lista=completas" class="text-success col-auto">
                            <div class="card border-success mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasCompletasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Completas'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&area=<?php echo $_SESSION['areaUsuario']; ?>&lista=canceladas" class="text-danger col-auto">
                            <div class="card border-danger mb-3">
                                <div class="card-body text-danger d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasCanceladasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Canceladas'</p>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="card border-success mb-3 col-12">
                        <div class="card-body text-success d-flex flex-column justify-content-start">
                            <div class="d-flex justify-content-between">
                                <h1 class="card-title"><?php echo $nroCompletasUser; ?></h1>
                                <i class="bi bi-list-check" style="font-size: 40px;"></i>
                            </div>
                            <p class="card-text">Total de tareas 'Completas' por <?php echo $_SESSION['nombreApellido']; ?></p>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div id="estados" class="row justify-content-evenly">

                        <a href="index.php?accion=listarTareasAdmin&lista=actual" class="col-auto text-secondary">
                            <div class="card border-secondary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-task" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasPendientes; ?></h1>
                                    <p class="card-text">Total de tareas 'Pendientes'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&lista=actual" class="col-auto text-primary">
                            <div class="card border-primary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasEnProgreso; ?></h1>
                                    <p class="card-text">Total de tareas 'En progreso'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&lista=completas" class="col-auto text-success">
                            <div class="card border-success mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasCompletas; ?></h1>
                                    <p class="card-text">Total de tareas 'Completas'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&lista=canceladas" class="col-auto text-danger">
                            <div class="card border-danger mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $tareasCanceladas; ?></h1>
                                    <p class="card-text">Total de tareas 'Canceladas'</p>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php
                }
                ?>

                <?php
                if ($_SESSION['rol'] == 3) {
                ?>
                    <p class="fs-5 text-center">Usuarios</p>

                    <div class="card border-dark mb-3">
                        <div class="card-body text-dark row justify-content-evenly">
                            <a href="index.php?accion=listarUsuarios" class="mb-3 text-dark">
                                <h1 class="card-title"><?php echo $totalUsuarios; ?></h1>
                                <p class="card-text">Total de Usuarios</p>
                            </a>

                            <div class="card border-info mb-3 col-auto">
                                <div class="card-body text-info d-flex flex-column align-items-center">
                                    <i class="bi bi-person-lines-fill" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $totalAdmin; ?></h1>
                                    <p class="card-text">Usuarios Administradores</p>
                                </div>
                            </div>

                            <a href="index.php?accion=listarAgentes" class="text-info col-auto">
                                <div class="card border-info mb-3 col-auto">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <i class="bi bi-people-fill" style="font-size: 40px;"></i>
                                        <h1 class="card-title"><?php echo $totalSuperv; ?></h1>
                                        <p class="card-text">Usuarios Supervisores</p>
                                    </div>
                                </div>
                            </a>

                            <a href="index.php?accion=listarAgentes" class="text-info col-auto">
                                <div class="card border-info mb-3">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <i class="bi bi-people-fill" style="font-size: 40px;"></i>
                                        <h1 class="card-title"><?php echo $totalAgentes; ?></h1>
                                        <p class="card-text">Usuarios Agentes</p>
                                    </div>
                                </div>
                            </a>

                            <div class="card border-info mb-3 col-auto">
                                <div class="card-body text-info d-flex flex-column align-items-center">
                                    <i class="bi bi-person-video3" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?php echo $totalEncargados; ?></h1>
                                    <p class="card-text">Usuarios encargados de los reclamos</p>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php
                }
                ?>

                <p class="fs-5 text-center">Direcciones/Entidades</p>

                <a href="index.php?accion=listarDirecciones" class="text-dark">
                    <div class="card border-dark mb-3 col-md-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h1 class="card-title"><?php echo $totalDirecciones; ?></h1>
                                <i class="bi bi-list" style="font-size: 40px;"></i>
                            </div>
                            <p class="card-text">Total</p>
                        </div>
                    </div>
                </a>

                <?php
                if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {
                ?>

                    <hr class="mt-5 mb-5">

                    <div id="totalMotivosArea">
                        <canvas id="diagramaMotivos" width="600px"></canvas>
                    </div>

                <?php
                }
                ?>

            </section>
        </body>

        <?php
        if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {
            require_once('../modelo/m_consultas.php');
            $co = new Consultas();
            $listMotivos = $co->listarCantidadMotivosAreas($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
        ?>

            <script>
                //Total Motivos Sistemas
                const labels = [
                    <?php
                    foreach ($listMotivos as $motivo) {
                        echo "'" . $motivo[1] . "',";
                    }
                    ?>
                ];

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Total de motivos de Sistemas',
                        backgroundColor: [
                            'Aquamarine',
                            'LightBlue',
                            'LightCyan',
                            'MediumPurple',
                            'MediumSlateBlue',
                            'RoyalBlue',
                            'DeepSkyBlue',
                            'Lavender',
                            'LightGreen',
                            'MediumOrchid',
                            'MediumSeaGreen',
                            '#EEFF41',
                            'Wheat',
                            'Crimson',
                            '#26A69A',
                            'DarkSlateGray',
                            'Khaki',
                            'LightSalmon',
                            'LightSeaGreen',
                        ],

                        data: [
                            <?php
                            foreach ($listMotivos as $motivo) {
                                echo $motivo[0] . ", ";
                            }
                            ?>
                        ],
                    }]
                };

                const config = {
                    type: 'pie',
                    data: data,
                    options: {
                        plugins: {
                            title: {
                                text: 'Total de motivos',
                                display: true,
                            },
                            legend: {
                                display: true,
                                position: 'left',
                                align: 'middle',
                            },

                        },

                        responsive: true,
                        maintainAspectRatio: false,

                    }
                };

                const motivosTareas = new Chart(
                    document.getElementById('diagramaMotivos'),
                    config
                );
            </script>

        <?php
        }
        ?>

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
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="../vista/login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>

<?php
}
?>