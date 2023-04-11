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
                if ($_SESSION['agenteEditado'] == true) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Confirmado!',
                            text: 'Los datos del agente han sido modificados',
                            icon: 'success'
                        });
                    </script>
                <?php
                    unset($_SESSION['agenteEditado']);
                }
                ?>
                <?php
                if ($_SESSION['bajaOk'] == true) {
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
                ?>
                <p class="fs-5">Lista de Agentes que están de baja del Sistema</p>
                <hr>
                <table class="table table-bordered" id="tablaDinamicaLoad">
                    <thead>
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Motivo de la baja</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listBajas as $list) {
                        ?>
                            <tr>
                                <td><?php echo $list[0]; ?></td>
                                <td><?php echo $list[1]; ?></td>
                                <td><?php echo $list[2]; ?></td>
                                <td><?php echo $list[3]; ?></td>
                                <td><?php echo $list[4]; ?></td>
                                <td id="accion">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAlta<?php echo $list[0]; ?>">
                                        Dar de alta
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Alta -->
                            <div class="modal fade" id="modalAlta<?php echo $list[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Dar de alta: <?php echo $list[1] . ' ' . $list[2]; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../controlador/c_altaAgente.php" method="post" style="display: none;">
                                            <div class="modal-body">

                                                <p class="fs-6">Completar lo siguente.</p>

                                                <input type="hidden" name="dni" value="<?php echo $list[0]; ?>">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="selectRol" id="floatingSelect" aria-label="Floating label select example" required>
                                                        <option value="" selected>Seleccione...</option>
                                                        <?php
                                                        foreach ($listRoles as $rol) {
                                                        ?>
                                                            <option value="<?php echo $rol[0]; ?>"><?php echo $rol[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Elegir tipo de Usuario</label>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-success">Dar de alta</button>
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
        <?php
        require('libreriaEstilos.php');
        ?>
    </head>

    <body>
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="../vista/login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>
<?php
}
?>