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
            <title>Inicio - Gestión de tareas</title>
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
            require "../scripts/alerta.php";

            if (isset($_SESSION['datosAct'])) {
                alerta("Los datos han sido modificados");
                unset($_SESSION['datosAct']);
            } else if (isset($_SESSION['datosActError'])) {
                alerta("No se han podido modificar los datos", "error");
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

                <p class="fs-5">Bienvenido <?= $_SESSION['nombreApellido']; ?></p>
                <p class="fs-5 text-center">Tareas</p>

                <div class="row justify-content-center">

                    <?php
                    if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {
                    ?>

                        <div class="card border-dark mb-3 col-auto">
                            <div class="card-body text-dark d-flex flex-column align-items-center">
                                <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?= $tareasTotalArea; ?></h1>
                                <p class="card-text">Total de tareas de <?= $_SESSION['areaUsuarioNombre']; ?></p>
                            </div>
                        </div>


                    <?php
                    } else {
                    ?>

                        <div class="card border-dark mb-3 col-auto">
                            <div class="card-body text-dark d-flex flex-column align-items-center">
                                <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                                <h1 class="card-title"><?= $totalTareasSistemas; ?></h1>
                                <p class="card-text">Total de tareas</p>
                            </div>
                        </div>

                        <a href="index.php?accion=listarTareasEliminadas" class="col-auto text-dark">
                            <div class="card border-dark mb-3 ms-5">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-data" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $totalTareasEliminadas; ?></h1>
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

                        <a href="index.php?accion=listarTareas&listado=actual&area=<?= $_SESSION['areaUsuario']; ?>&area2=<?= $_SESSION['areaUsuario2']; ?>&area3=<?= $_SESSION['areaUsuario3'] ?>" class="text-secondary col-auto">
                            <div class="card border-secondary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-task" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasPendientesArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Pendientes'</p>

                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareas&listado=actual&area=<?= $_SESSION['areaUsuario']; ?>&area2=<?= $_SESSION['areaUsuario2']; ?>&area3=<?= $_SESSION['areaUsuario3'] ?>" class="text-primary col-auto">
                            <div class="card border-primary mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasEnProgresoArea; ?></h1>
                                    <p class="card-text">Total de tareas 'En progreso'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareas&listado=completas&area=<?= $_SESSION['areaUsuario']; ?>&area2=<?= $_SESSION['areaUsuario2']; ?>&area3=<?= $_SESSION['areaUsuario3'] ?>" class="text-success col-auto">
                            <div class="card border-success mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasCompletasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Completas'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareas&listado=canceladas&area=<?= $_SESSION['areaUsuario']; ?>&area2=<?= $_SESSION['areaUsuario2']; ?>&area3=<?= $_SESSION['areaUsuario3'] ?>" class="text-danger col-auto">
                            <div class="card border-danger mb-3 col-auto">
                                <div class="card-body text-danger d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasCanceladasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Canceladas'</p>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="card border-success mb-3 col-12">
                        <div class="card-body text-success d-flex flex-column justify-content-start">
                            <div class="d-flex justify-content-between">
                                <h1 class="card-title"><?= $nroCompletasUser; ?></h1>
                                <i class="bi bi-list-check" style="font-size: 40px;"></i>
                            </div>
                            <p class="card-text">Total de tareas 'Completas' por <?= $_SESSION['nombreApellido']; ?></p>
                        </div>
                    </div>

                <?php
                } else if ($_SESSION['rol'] == 4) {
                ?>

                    <div class="row justify-content-evenly" id="estados">

                        <a href="index.php?accion=listarTareasAdmin&area=<?= $_SESSION['areaUsuario']; ?>&lista=actual" class="text-secondary col-auto">
                            <div class="card border-secondary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-task" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasPendientesArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Pendientes'</p>

                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&area=<?= $_SESSION['areaUsuario']; ?>&lista=actual" class="text-primary col-auto">
                            <div class="card border-primary mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasEnProgresoArea; ?></h1>
                                    <p class="card-text">Total de tareas 'En progreso'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&area=<?= $_SESSION['areaUsuario']; ?>&lista=completas" class="text-success col-auto">
                            <div class="card border-success mb-3 col-auto">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasCompletasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Completas'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&area=<?= $_SESSION['areaUsuario']; ?>&lista=canceladas" class="text-danger col-auto">
                            <div class="card border-danger mb-3">
                                <div class="card-body text-danger d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasCanceladasArea; ?></h1>
                                    <p class="card-text">Total de tareas 'Canceladas'</p>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="card border-success mb-3 col-12">
                        <div class="card-body text-success d-flex flex-column justify-content-start">
                            <div class="d-flex justify-content-between">
                                <h1 class="card-title"><?= $nroCompletasUser; ?></h1>
                                <i class="bi bi-list-check" style="font-size: 40px;"></i>
                            </div>
                            <p class="card-text">Total de tareas 'Completas' por <?= $_SESSION['nombreApellido']; ?></p>
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
                                    <h1 class="card-title"><?= $tareasPendientes; ?></h1>
                                    <p class="card-text">Total de tareas 'Pendientes'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&lista=actual" class="col-auto text-primary">
                            <div class="card border-primary mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-ul" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasEnProgreso; ?></h1>
                                    <p class="card-text">Total de tareas 'En progreso'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&lista=completas" class="col-auto text-success">
                            <div class="card border-success mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-list-check" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasCompletas; ?></h1>
                                    <p class="card-text">Total de tareas 'Completas'</p>
                                </div>
                            </div>
                        </a>

                        <a href="index.php?accion=listarTareasAdmin&lista=canceladas" class="col-auto text-danger">
                            <div class="card border-danger mb-3">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="bi bi-clipboard-x" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $tareasCanceladas; ?></h1>
                                    <p class="card-text">Total de tareas 'Canceladas'</p>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php
                }

                if ($_SESSION['rol'] == 3) {
                ?>
                    <p class="fs-5 text-center">Usuarios</p>

                    <div class="card border-dark mb-3">
                        <div class="card-body text-dark row justify-content-evenly">
                            <a href="index.php?accion=listarUsuarios" class="mb-3 text-dark">
                                <h1 class="card-title"><?= $totalUsuarios; ?></h1>
                                <p class="card-text">Total de Usuarios</p>
                            </a>

                            <div class="card border-info mb-3 col-auto">
                                <div class="card-body text-info d-flex flex-column align-items-center">
                                    <i class="bi bi-person-lines-fill" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $totalAdmin; ?></h1>
                                    <p class="card-text">Usuarios Administradores</p>
                                </div>
                            </div>

                            <a href="index.php?accion=listarAgentes" class="text-info col-auto">
                                <div class="card border-info mb-3 col-auto">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <i class="bi bi-people-fill" style="font-size: 40px;"></i>
                                        <h1 class="card-title"><?= $totalSuperv; ?></h1>
                                        <p class="card-text">Usuarios Supervisores</p>
                                    </div>
                                </div>
                            </a>

                            <a href="index.php?accion=listarAgentes" class="text-info col-auto">
                                <div class="card border-info mb-3">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <i class="bi bi-people-fill" style="font-size: 40px;"></i>
                                        <h1 class="card-title"><?= $totalAgentes; ?></h1>
                                        <p class="card-text">Usuarios Agentes</p>
                                    </div>
                                </div>
                            </a>

                            <div class="card border-info mb-3 col-auto">
                                <div class="card-body text-info d-flex flex-column align-items-center">
                                    <i class="bi bi-person-video3" style="font-size: 40px;"></i>
                                    <h1 class="card-title"><?= $totalEncargados; ?></h1>
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
                                <h1 class="card-title"><?= $totalDirecciones; ?></h1>
                                <i class="bi bi-list" style="font-size: 40px;"></i>
                            </div>
                            <p class="card-text">Total</p>
                        </div>
                    </div>
                </a>

            </section>
        </body>

        </html>
<?php
    }
} else {
    require "destroySession.php";
}
?>