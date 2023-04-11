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

                #btnNuevo {
                    display: flex;
                    justify-content: flex-end;
                    margin: 10px;
                }

                table {
                    width: 80% !important;
                    margin: 0 auto;
                }

                th,
                td {
                    vertical-align: middle;
                }

                #accion {
                    text-align: center;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        order: [
                            [1, 'asc']
                        ],
                        aLengthMenu: [25, 50, 100, 200],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    });
                })
            </script>
        </head>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['motivoOk']) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'El motivo ha sido agregado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['motivoOk']);
            }
            if ($_SESSION['editadoOk']) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'El motivo ha sido modificado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['editadoOk']);
            }
            ?>
            <section id="container">
                <p class="fs-5">Motivos de requerimientos</p>
                <hr>
                <div id="btnNuevo">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#nuevoMotivo">Nuevo motivo</button>
                </div>
                <div class="table-responsive-xxl">
                    <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                        <thead>
                            <th>Nombre</th>
                            <th>Área donde se lleva a cabo</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listMotivosReq as $motivo) {
                            ?>
                                <tr>
                                    <td><?php echo $motivo[1]; ?></td>
                                    <td><?php echo $motivo[3]; ?></td>
                                    <td id="accion">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarMotivo<?php echo $motivo[0]; ?>"><i class="bi bi-pencil-square"></i>Editar</button>
                                    </td>
                                </tr>

                                <!-- Modal Nuevo Motivo-->
                                <div class="modal fade" id="nuevoMotivo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Nuevo motivo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="../controlador/c_agregarMotivo.php" method="post" style="display: none;">

                                                <div class="modal-body">

                                                    <p class="fs-6">Completar los siguientes campos</p>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Leave a comment here" name="motivo" id="floatingTextarea2" style="height: 100px" required></textarea>
                                                        <label for="floatingTextarea2">Escribir el nuevo motivo</label>
                                                    </div>

                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelect" name="selectArea" aria-label="Floating label select example" required>
                                                            <option value="" selected>Seleccione...</option>
                                                            <?php
                                                            foreach ($listAreas as $area) {
                                                            ?>
                                                                <option value="<?php echo $area[0]; ?>"><?php echo $area[1]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="floatingSelect">Seleccione el área donde se llevará a cabo</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Editar Motivo-->
                                <div class="modal fade" id="editarMotivo<?php echo $motivo[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar motivo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="../controlador/c_editarMotivo.php" method="post" style="display: none;">

                                                <input type="hidden" name="id" value="<?php echo $motivo[0]; ?>">

                                                <div class="modal-body">

                                                    <p class="fs-6">Completar los siguientes campos</p>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Leave a comment here" name="motivo" id="floatingTextarea2" style="height: 100px" required><?php echo $motivo[1]; ?></textarea>
                                                        <label for="floatingTextarea2">Nombre del motivo</label>
                                                    </div>

                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelect" name="selectArea" aria-label="Floating label select example" required>
                                                            <option value="<?php echo $motivo[2]; ?>" selected><?php echo $motivo[3]; ?> (Actual)</option>
                                                            <?php
                                                            foreach ($listAreas as $area) {
                                                            ?>
                                                                <option value="<?php echo $area[0]; ?>"><?php echo $area[1]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="floatingSelect">Seleccione el área donde se llevará a cabo</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
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