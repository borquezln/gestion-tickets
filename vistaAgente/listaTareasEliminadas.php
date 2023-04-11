<?php
error_reporting(E_ALL ^ E_NOTICE);
if (!(time() - $_SESSION['time'] >= 3600)) {
    $_SESSION['time'] = time();
    if ($_SESSION['rol'] == 3) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="3600">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>

            <style>
                section {
                    padding: 15px;
                }

                th,
                td {
                    vertical-align: middle;
                    font-size: 15px;
                }

                table #nroArreglo {
                    text-align: center;
                }

                table #accion {
                    text-align: center;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        aLengthMenu: [25, 50, 100, 200],
                        aaSorting: [
                            [0, "desc"]
                        ],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    })
                })
            </script>

        </head>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['tareaEliminada']) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'La tarea ha sido eliminada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['tareaEliminada']);
            }
            ?>
            <section id="container">
                <p class="fs-5">Lista de tareas eliminadas</p>
                <hr>

                <div class="table-responsive-xxl">
                    <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Motivo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Afectado/a</th>
                                <th scope="col">Fecha Eliminada</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Motivo Eliminación</th>

                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listTareasEliminadas as $tarea) {
                            ?>
                                <tr>
                                    <td id="nroArreglo"><?php echo $tarea[0]; ?></td>
                                    <td><?php echo $tarea[1]; ?></td>
                                    <td><?php echo $tarea[2]; ?></td>
                                    <td><?php echo $tarea[4]; ?></td>
                                    <td>
                                        <?php
                                        $date = date_create($tarea[14]);
                                        $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                        echo $fechaProblema;
                                        ?>
                                    </td>
                                    <td><?php echo $tarea[11]; ?></td>
                                    <td><?php echo $tarea[13]; ?></td>

                                    <td id="accion">
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li>
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalInfoTarea<?php echo $tarea[0]; ?>">
                                                        Ver más info
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>


                                <!-- Modal Ver Info Tarea -->
                                <div class="modal fade modalEditar" id="modalInfoTarea<?php echo $tarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Información de la tarea</h5>
                                                <button type="button" class="btn-close btnCerrarModalEditar" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body bodyModalInfo">

                                                <p class="fs-6">Tarea N° <?php echo $tarea[0]; ?></p>

                                                <input type="hidden" name="nroArreglo" value="<?php echo $tarea[0]; ?>">

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="motivo" value="<?php echo $tarea[1]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Motivo del incoveniente</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $tarea[2]; ?></textarea>
                                                    <label for="floatingTextarea">Descripción</label>
                                                </div>

                                                <?php
                                                if ($tarea[3] == '' || $tarea[3] == null) {
                                                    $ip = 'No proporcionado';
                                                } else {
                                                    $ip = $tarea[3];
                                                }
                                                ?>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="ip" value="<?php echo $ip; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">IP</label>
                                                </div>

                                                <?php
                                                if ($tarea[4] == '' || $tarea[4] == null) {
                                                    $nombreApellidoAfectado = 'No proporcionado';
                                                } else {
                                                    $nombreApellidoAfectado = $tarea[4];
                                                }
                                                ?>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="nombreApellido" value="<?php echo $nombreApellidoAfectado; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Nombre y apellido del afectado/a</label>
                                                </div>

                                                <?php
                                                if ($tarea[5] == '' || $tarea[5] == null) {
                                                    $cel = 'No proporcionado';
                                                } else {
                                                    $cel = $tarea[5];
                                                }
                                                ?>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="cel" value="<?php echo $cel; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Nro de celular de contacto</label>
                                                </div>

                                                <?php
                                                if ($tarea[6] != '') {
                                                ?>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px" disabled><?php echo $tarea[6]; ?>    
                                                            </textarea>
                                                        <label for="floatingTextarea">Solución del incoveniente</label>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if ($tarea[8] != '') {
                                                ?>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $tarea[8]; ?>    
                                                            </textarea>
                                                        <label for="floatingTextarea">Motivo de la cancelación</label>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                $date = date_create($tarea[9]);
                                                $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                                ?>
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="fechaProblema" value="<?php echo $fechaProblema; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Fecha del problema</label>
                                                </div>

                                                <?php
                                                if ($tarea[10] != '') {
                                                    $date = date_create($tarea[10]);
                                                    $fechaSolucion = date_format($date, 'd/m/Y H:i:s');
                                                ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="fechaSolucion" value="<?php echo $fechaSolucion; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Fecha de la solución</label>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="area" value="<?php echo $tarea[11]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Área donde se desempeña</label>
                                                </div>

                                                <?php
                                                if ($tarea[12] == '' || $tarea[12] == null) {
                                                    $asignado = 'No proporcionado';
                                                } else {
                                                    $asignado = $tarea[12];
                                                }
                                                ?>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="area" value="<?php echo $asignado; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Asignado</label>
                                                </div>

                                                <hr>
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="motivoEliminacion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px" disabled><?php echo $tarea[13]; ?>    
                                                            </textarea>
                                                    <label for="floatingTextarea">Motivo de la eliminación</label>
                                                </div>

                                                <?php
                                                $date = date_create($tarea[14]);
                                                $fechaEliminado = date_format($date, 'd/m/Y H:i:s');
                                                ?>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="fechaEliminado" value="<?php echo $fechaEliminado; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                    <label for="floatingInput">Fecha de eliminación</label>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btnCerrarModalEditar" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
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