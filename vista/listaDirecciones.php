<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!(time() - $_SESSION['time'] >= 3600)) {
    if ($_SESSION['rol'] == 1) {
        $_SESSION['time'] = time();
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

                table {
                    width: 75% !important;
                    margin: 0 auto;
                }

                table td {
                    vertical-align: middle;
                }

                table #accion {
                    text-align: center;
                }
            </style>

            <script>
                function comprobarCodigo(codigo) {
                    $.ajax({
                        type: 'POST',
                        url: 'validacionRepetidos/validarAreaExistente.php',
                        data: 'codigo=' + codigo.value,
                        success: function(r) {
                            $('#codigoExistente').html(r);
                        }
                    });
                }

                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        aLengthMenu: [50, 100, 200],
                        aaSorting: [[ 0, "asc" ]],
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

            if ($_SESSION['areaOk'] == true) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'El área ha sido añadida exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['areaOk']);
            }

            if ($_SESSION['editadoOk'] == true) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'El área ha sido modificada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['editadoOk']);
            }

            if ($_SESSION['eliminadoOk'] == true) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'El área ha sido eliminada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['eliminadoOk']);
            }

            ?>

            <section id="container">
                <p class="fs-5">Lista de Direcciones/Entidades</p>
                <hr>

                <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listDirecciones as $direccion) {
                        ?>
                            <tr>
                                <td><?php echo $direccion[0]; ?></td>
                                <td><?php echo $direccion[1]; ?></td>
                                <td><?php echo $direccion[2]; ?></td>
                            </tr>
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
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>
<?php
}
?>