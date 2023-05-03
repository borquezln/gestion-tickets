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

                table td {
                    vertical-align: middle;
                }

                table #accion {
                    text-align: center;
                }
            </style>

            <script>
                function bajaAgente() {
                    var nombre = $('.nombre').val();
                    var apellido = $('.apellido').val();
                    event.preventDefault();
                    Swal.fire({
                        title: 'Aviso',
                        text: "Dar de baja a " + nombre + ' ' + apellido + '?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Confirmar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            return true;
                        }
                        return false;
                    })
                }

                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        aLengthMenu: [25, 50, 100, 200],
                        order: [
                            [6, 'desc']
                        ],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    })
                })
            </script>
        </head>

        <body>
            <section id="container">
                <?php
                error_reporting(0);
                if (isset($_SESSION['bajaOk'])) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Confirmado!',
                            text: 'El agente ha sido dado de baja',
                            icon: 'success'
                        });
                    </script>
                <?php
                    unset($_SESSION['bajaOk']);
                }
                if (isset($_SESSION['altaOk'])) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Confirmado!',
                            text: 'El agente ha sido dado de alta al Sistema nuevamente',
                            icon: 'success'
                        });
                    </script>
                <?php
                    unset($_SESSION['altaOk']);
                }
                if (isset($_SESSION['agregadoOk'])) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Confirmado!',
                            text: 'Se ha agregado el agente al área correctamente',
                            icon: 'success'
                        });
                    </script>
                <?php
                    unset($_SESSION['agregadoOk']);
                }
                if (isset($_SESSION['eliminadoOk'])) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Confirmado!',
                            text: 'Se ha quitado el área al agente correctamente',
                            icon: 'success'
                        });
                    </script>
                <?php
                    unset($_SESSION['eliminadoOk']);
                }
                ?>

                <p class="fs-5">Lista de Agentes</p>
                <hr>
                <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                    <thead>
                        <tr>
                            <th scope="col">Legajo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Área</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listEncAgentes as $list) {
                        ?>
                            <tr>
                                <td><?php echo $list[0]; ?></td>
                                <td><?php echo $list[1]; ?></td>
                                <td><?php echo $list[2]; ?></td>
                                <td><?php echo $list[3]; ?></td>
                                <td><?php echo $list[4]; ?></td>
                                <td><?php echo $list[5]; ?></td>
                                <td><?php echo $list[6]; ?></td>
                                <td id="accion">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Acción
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li>
                                                <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalMotivoCancelacion<?php echo $list[0]; ?>">
                                                    Dar de Baja
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Dar de baja-->
                            <div class="modal fade" id="modalMotivoCancelacion<?php echo $list[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Dar de baja: <?php echo $list[1] . ' ' . $list[2]; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../controlador/c_bajaAgente.php" method="post" style="display: none;">
                                            <div class="modal-body">

                                                <p class="fs-6">Para continuar, debe escribir el motivo de la baja</p>

                                                <input type="hidden" name="legajo" value="<?php echo $list[0]; ?>">

                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="motivoBaja" placeholder="Leave a comment" id="floatingTextarea" style="height: 100px" required></textarea>
                                                    <label for="floatingTextarea">Motivo</label>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger">Dar de baja</button>
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