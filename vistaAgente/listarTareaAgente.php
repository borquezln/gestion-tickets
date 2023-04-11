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

                td,
                th {
                    vertical-align: middle;
                    font-size: 15px;
                }

                table #nroArreglo,
                table #accion {
                    text-align: center;
                }

                .fechaFiltro {
                    display: flex;
                }

                .fechaFiltro .inputs {
                    width: 300px;
                    margin-right: 10px;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        aLengthMenu: [25, 50, 100, 200],
                        aaSorting: [[ 0, "desc" ]],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    })

                    $('input[name=fechaFin]').change(function() {
                        var opcion = $('#opcionBusqueda').val();
                        var fechaProblemaInicio = $('#fechaProblemaInicio').val();
                        var fechaProblemaFin = $('#fechaProblemaFin').val();
                        var fechaSolucionInicio = $('#fechaSolucionInicio').val();
                        var fechaSolucionFin = $('#fechaSolucionFin').val();
                        var dni = $('#dni').val();
                        //
                        var fechaProblemaEspecifico = $('#fechaProblemaEspecifico').val();
                        var fechaSolucionEspecifico = $('#fechaSolucionEspecifico').val();
                        $.ajax({
                            type: 'POST',
                            url: 'ajax/buscarPorFecha.php',
                            data: 'opcionBusqueda=' + opcion + '&fechaProblemaInicio=' + fechaProblemaInicio + '&fechaProblemaFin=' + fechaProblemaFin +
                                '&fechaSolucionInicio=' + fechaSolucionInicio + '&fechaSolucionFin=' + fechaSolucionFin + '&fechaProblemaEspecifico=' + fechaProblemaEspecifico +
                                '&fechaSolucionEspecifico=' + fechaSolucionEspecifico + '&dni=' + dni,
                            success: function(r) {
                                $('#tPrincipal').hide();
                                $('#tResultado').show();
                                $('#tResultado').html(r);
                                $('#tablaAjax').DataTable({
                                    language: {
                                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                                    }
                                });
                            }
                        })
                    })

                    $('select[name=selectEstados]').change(function() {
                        var opcionEstadoTarea = $('#selectEstados').val();
                        var dni = $('#dni').val();
                        $.ajax({
                            type: 'POST',
                            url: 'ajax/filtroEstado.php',
                            data: 'opcionEstado=' + opcionEstadoTarea + '&dniAgente=' + dni,
                            success: function(r) {
                                $('#tPrincipal').hide();
                                $('#tResultado').show();
                                $('#tResultado').html(r);
                                $('#tablaAjax').DataTable({
                                    language: {
                                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                                    }
                                });
                            }
                        })
                    });
                })

                function filtrosBusqueda(valorOpcion) {
                    var opcion = valorOpcion.value;

                    if (opcion == '') {
                        $('#fechaProblemaSection').hide();
                        $('#fechaSolucionSection').hide();
                        $('#fechaProblemaEspecificoSection').hide();
                        $('#fechaSolucionEspecificoSection').hide();
                        $('#estadoTareaSection').hide();
                        $('#tPrincipal').show();
                        $('#tResultado').hide();
                    } else if (opcion == 1) {
                        $('#fechaProblemaSection').show();
                        $('#fechaSolucionSection').hide();
                        $('#fechaProblemaEspecificoSection').hide();
                        $('#fechaSolucionEspecificoSection').hide();
                        $('#estadoTareaSection').hide();
                    } else if (opcion == 2) {
                        $('#fechaSolucionSection').show();
                        $('#fechaProblemaSection').hide();
                        $('#fechaProblemaEspecificoSection').hide();
                        $('#fechaSolucionEspecificoSection').hide();
                        $('#estadoTareaSection').hide();
                        /*$('#tPrincipal').hide();
                        $('#tResultado').show();*/
                    } else if (opcion == 3) {
                        $('#fechaProblemaEspecificoSection').show();
                        $('#fechaProblemaSection').hide();
                        $('#fechaSolucionSection').hide();
                        $('#fechaSolucionEspecificoSection').hide();
                        $('#estadoTareaSection').hide();
                    } else if (opcion == 4) {
                        $('#fechaSolucionEspecificoSection').show();
                        $('#fechaProblemaSection').hide();
                        $('#fechaSolucionSection').hide();
                        $('#fechaProblemaEspecificoSection').hide();
                        $('#estadoTareaSection').hide();
                    } else if (opcion == 5) {
                        $('#fechaSolucionEspecificoSection').hide();
                        $('#fechaProblemaSection').hide();
                        $('#fechaSolucionSection').hide();
                        $('#fechaProblemaEspecificoSection').hide();
                        $('#estadoTareaSection').show();
                    }
                }
            </script>

        </head>

        <body>

            <section id="container">

                <p class="fs-5">Lista de tareas de <?php echo $agente ?></p>
                <hr>

                <p class="fs-6">
                    Área donde se desempeña:
                    <b>
                        <?php
                        foreach ($areaUsuario as $area) {
                            echo '(' . $area[1] . ') ';
                        }
                        ?>
                    </b>
                </p>

                <div id="filtroBusqueda">

                    <p class="fs-5">Filtros de búsqueda</p>

                    <div class="form-floating mb-3" style="width: 400px;">

                        <input type="hidden" id="dni" value="<?php echo $_GET['agente']; ?>">

                        <select class="form-select" onchange="filtrosBusqueda(this);" id="opcionBusqueda" aria-label="Floating label select example">
                            <option value="" selected>Seleccione...</option>
                            <option value="1">Por rango de fechas de problemas</option>
                            <option value="2">Por rango de fechas de soluciones</option>
                            <option value="3">Por un día en específico (Fecha del problema)</option>
                            <option value="4">Por un día en específico (Fecha de la solución)</option>
                            <option value="5">Por estado de la tarea</option>
                        </select>
                        <label for="floatingSelect">Seleccione la forma de buscar</label>
                    </div>

                    <div id="fechaProblemaSection" class="fechaFiltro" style="display: none;">
                        <div class="form-floating mb-3 inputs">
                            <input type="date" name="fechaProblemaInicio" class="form-control" id="fechaProblemaInicio" placeholder="...">
                            <label for="floatingInput">Fecha del Problema. Desde</label>
                        </div>

                        <div class="form-floating mb-3 inputs">
                            <input type="date" name="fechaFin" class="form-control" id="fechaProblemaFin" placeholder="...">
                            <label for="floatingInput">Fecha del Problema. Hasta</label>
                        </div>

                        <hr style="grid-column: 1/3;">
                    </div>

                    <div id="fechaSolucionSection" class="fechaFiltro" style="display: none;">
                        <div class="form-floating mb-3 inputs">
                            <input type="date" name="fechaSolucionInicio" class="form-control" id="fechaSolucionInicio" placeholder="...">
                            <label for="floatingInput">Fecha de solución. Desde</label>
                        </div>

                        <div class="form-floating mb-3 inputs">
                            <input type="date" name="fechaFin" class="form-control" id="fechaSolucionFin" placeholder="...">
                            <label for="floatingInput">Fecha del solución. Hasta</label>
                        </div>
                    </div>

                    <div id="fechaProblemaEspecificoSection" class="fechaFiltro" style="display: none;">
                        <div class="form-floating mb-3 inputs">
                            <input type="date" name="fechaFin" class="form-control" id="fechaProblemaEspecifico" placeholder="...">
                            <label for="floatingInput">Fecha del problema</label>
                        </div>
                    </div>

                    <div id="fechaSolucionEspecificoSection" class="fechaFiltro" style="display: none;">
                        <div class="form-floating mb-3 inputs">
                            <input type="date" name="fechaFin" class="form-control" id="fechaSolucionEspecifico" placeholder="...">
                            <label for="floatingInput">Fecha de la solución</label>
                        </div>
                    </div>

                    <div id="estadoTareaSection" class="fechaFiltro" style="display: none;">
                        <div class="form-floating mb-3 inputs">
                            <select class="form-select" name="selectEstados" id="selectEstados" aria-label="Floating label select example" required>
                                <option value="" selected>Seleccione...</option>
                                <?php
                                foreach ($listEstados as $estado) {
                                    if ($estado[0] != 1 && $estado[0] != 5) {
                                ?>
                                        <option value="<?php echo $estado[0]; ?>">
                                            <?php
                                            echo $estado[1];
                                            ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Seleccione el motivo del incoveniente</label>
                        </div>
                    </div>
                </div>

                </div>

                <div class="table-responsive-xxl">
                    <div id="tPrincipal">
                        <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Motivo</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Afectado/a</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha Problema</th>
                                    <th scope="col">Fecha Solución</th>
                                    <th scope="col">Área</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listTareaAgente as $tarea) {
                                ?>
                                    <tr>
                                        <td id="nroArreglo"><?php echo $tarea[0]; ?></td>
                                        <td><?php echo $tarea[1]; ?></td>
                                        <td><?php echo $tarea[2]; ?></td>
                                        <td><?php echo $tarea[4]; ?></td>
                                        <td>
                                            <?php
                                            if ($tarea[7] == 'Pendiente') {
                                                echo '<span class="badge bg-secondary">' . $tarea[7] . '</span>';
                                            } else if ($tarea[7] == 'En Progreso') {
                                                echo '<span class="badge bg-primary">' . $tarea[7] . '</span>';
                                            } else if ($tarea[7] == 'Completo') {
                                                echo '<span class="badge bg-success">' . $tarea[7] . '</span>';
                                            } else if ($tarea[7] == 'Cancelado') {
                                                echo '<span class="badge bg-danger">' . $tarea[7] . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $date = date_create($tarea[9]);
                                            $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                            echo $fechaProblema;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($tarea[10] != '') {
                                                $date = date_create($tarea[10]);
                                                $fechaSolucion = date_format($date, 'd/m/Y H:i:s');
                                                echo $fechaSolucion;
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $tarea[11]; ?></td>

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

                                    <!--Modal Ver más info-->
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

                                                    <?php
                                                    if ($tarea[8] != '') {
                                                        $motivoCancelacion = $tarea[8];
                                                    ?>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="motivoEliminacion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px" disabled><?php echo $motivoCancelacion; ?>    
                                                            </textarea>
                                                            <label for="floatingTextarea">Motivo de la cancelación</label>
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($tarea[13] != '') {
                                                        $motivoEliminacion = $tarea[13];
                                                    ?>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="motivoEliminado" value="<?php echo $motivoEliminacion; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Motivo de la eliminación</label>
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>


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

                    <div id="tResultado">
                        <?php
                        foreach ($listTareaAgente as $tarea) {
                        ?>

                        <?php
                        }
                        ?>
                    </div>
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