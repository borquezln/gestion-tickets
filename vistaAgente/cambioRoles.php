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

                section .fs-6 {
                    margin: 0;
                }

                section #textButton {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                section form .fs-5 {
                    margin-top: 10px;
                }

                section form {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    column-gap: 80px;
                }

                section form #btn {
                    grid-column: 2/3;
                    display: flex;

                }
            </style>

        </head>

        <body>

            <section id="container">
                <?php
                error_reporting(0);
                if ($_SESSION['asignadoOk'] == true) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'El usuario ha cambiado de Rol',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['asignadoOk']);
                }
                if ($_SESSION['asignadoError'] == true) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe seleccionar el Agente y el Rol a asignar',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    </script>
                <?php
                    unset($_SESSION['asignadoError']);
                }
                ?>

                <p class="fs-5">Cambio de roles a usuarios</p>
                <hr>

                <div id="textButton">
                    <div id="text">
                        <p class="fs-6 bg-white">Nota: Si se quiere elevar el Rol de un Agente a Admin. Se le eliminarán las tareas asignadas <b>Pendientes y En Progreso</b></p>
                        <p class="fs-6">Las <b>Completas</b> no se eliminarán ya que quedara como registro de que el Agente completó las tareas asignadas</p>
                    </div>

                </div>

                <form action="../controlador/c_asignarRolUsuario.php" method="post">
                    <div id="usuarios">
                        <p class="fs-5">Listado de Usuarios</p>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="selectUsuario" id="floatingSelect" aria-label="Floating label select example" required>
                                <option value="" selected>Seleccione...</option>

                                <?php
                                foreach ($listUsuarios as $usuarios) {
                                    if ($usuarios[5] != 'Admin' && $_SESSION['rol'] == 4 && $usuarios[0] != $_SESSION['dni']) {
                                ?>
                                        <option value="<?php echo $usuarios[0]; ?>">
                                            <?php echo $usuarios[1] . ' ' . $usuarios[2] . ' - ' . $usuarios[3] . ' - ' . $usuarios[4] . ' - ' . $usuarios[5]; ?>
                                        </option>
                                    <?php
                                    }
                                    if ($_SESSION['rol'] == 3 && $usuarios[0] != $_SESSION['dni']) {
                                    ?>
                                        <option value="<?php echo $usuarios[0]; ?>">
                                            <?php echo $usuarios[1] . ' ' . $usuarios[2] . ' - ' . $usuarios[3] . ' - ' . $usuarios[4] . ' - ' . $usuarios[5]; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Agentes</label>
                        </div>
                    </div>

                    <div id="asignacion">
                        <p class="fs-5">Asignar Rol</p>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="selectRol" id="floatingSelect" aria-label="Floating label select example" required>
                                <option value="" selected>Seleccione...</option>
                                <?php
                                foreach ($listRoles as $roles) {
                                    if ($_SESSION['rol'] == 4 && $roles[0] != 3) {
                                ?>
                                        <option value="<?php echo $roles[0] ?>"><?php echo $roles[1] ?></option>
                                    <?php
                                    }
                                    if ($_SESSION['rol'] == 3) {
                                    ?>
                                        <option value="<?php echo $roles[0] ?>"><?php echo $roles[1] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Roles</label>
                        </div>
                    </div>

                    <div id="btn">
                        <button type="submit" id="btnAplicar" class="btn btn-primary">Aplicar Cambios</button>
                    </div>

                </form>

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
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="../vista/login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>

<?php
}
?>