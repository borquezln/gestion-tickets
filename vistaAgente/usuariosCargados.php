<?php
error_reporting(E_ALL ^ E_NOTICE || E_WARNING);
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

            td,
            th {
                vertical-align: middle;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('#tablaDinamicaLoad').DataTable({
                    aLengthMenu: [50, 100, 200],
                    order: [
                        [5, 'asc']
                    ],
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    }
                })
            })
        </script>

        <body>
            <?php
            error_reporting(0);
            require "../scripts/alerta.php";

            if (isset($_SESSION['usuarioAgregado'])) {
                alerta("El usuario ha sido agregado al sistema");
                unset($_SESSION['usuarioAgregado']);
            } else if (isset($_SESSION['usuarioError'])) {
                alerta("No se ha podido añadir el usuario. Revise los datos e intente nuevamente", "error");
                unset($_SESSION['usuarioError']);
            }
            ?>

            <section id="container">
                <p class="fs-5">Lista de usuarios cargados</p>
                <hr>
                <p>Se muestra el listado de todos los usuarios registrados en el Sistema</p>

                <div class="table-responsive-xxl">
                    <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                        <thead>
                            <tr>
                                <th scope="col">legajo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Nombre de usuario</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Último acceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listUsuarios as $usuario) {
                            ?>
                                <tr>
                                    <td><?= $usuario[0]; ?></td>
                                    <td><?= $usuario[1]; ?></td>
                                    <td><?= $usuario[2]; ?></td>
                                    <td><?= $usuario[3]; ?></td>
                                    <td><?= $usuario[4]; ?></td>
                                    <td><?= $usuario[5]; ?></td>
                                    <td>
                                        <?php
                                        if ($usuario[6] != '' || $usuario[6] != null) {
                                            $date = date_create($usuario[6]);
                                            $ultimologin = date_format($date, 'd/m/Y H:i:s');
                                            echo $ultimologin;
                                        } else {
                                            echo $usuario[6];
                                        }

                                        ?>
                                    </td>
                                </tr>
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
    require "destroySession.php";
}
?>