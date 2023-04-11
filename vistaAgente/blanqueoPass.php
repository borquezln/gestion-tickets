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
        </head>

        <style>
            section {
                padding: 15px;
            }

            #seccionCampos {
                width: 750px;
            }

            #btn {
                display: flex;
                justify-content: flex-end;
            }
        </style>

        <script>
            function verificarPassIguales(confirmarPass) {
                var pass = $('input[name=nuevaPass]').val();
                if (pass != confirmarPass.value) {
                    $('#msjError').show();
                    $('#btnEnviar').prop('disabled', true);
                } else if (pass === confirmarPass.value) {
                    $('#msjError').hide();
                    $('#btnEnviar').prop('disabled', false);
                }
            }
        </script>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['passBlanqueada']) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'La contraseña ha sido modificada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['passBlanqueada']);
            }
            ?>
            <section id="container">

                <p class="fs-5">Blanqueo de contraseña</p>
                <hr>
                <p>
                    Completar lo siguiente
                </p>

                <div id="seccionCampos">

                    <form action="../controlador/c_cambiarPass.php" method="post">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="dni" id="floatingSelect" aria-label="example" required>
                                <option value="" selected>Seleccione...</option>

                                <?php
                                foreach ($listUsuarios as $usuario) {
                                ?>
                                    <option value="<?php echo $usuario[0]; ?>"><?php echo $usuario[1] . ' - ' . $usuario[2] . ' - ' . $usuario[4] . ' - ' . $usuario[5]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                            <label for="floatingSelect">Seleccionar el usuario a blanquear la contraseña</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="nuevaPass" placeholder="Password">
                            <label for="floatingPassword">Escribir la nueva contraseña</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="pass" id="passRepetido" onkeyup="verificarPassIguales(this);" placeholder="Password" required>
                            <label for="floatingPassword">Repetir la nueva contraseña</label>
                            <p id="msjError" style="color: red; display: none;">Las contraseñas deben ser iguales</p>
                        </div>

                        <div id="btn">
                            <button type="submit" id="btnEnviar" class="btn btn-success">Aplicar cambios</button>
                        </div>

                    </form>

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