<?php
error_reporting(E_ALL ^ E_NOTICE);
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
        </head>

        <style>
            section {
                padding: 15px;
            }

            section #btnTarea {
                display: flex;
                justify-content: space-between;
                margin: 5px 0;
            }

            .dataTables_length {
                margin-bottom: 10px;
            }

            section th,
            td {
                vertical-align: middle;
                font-size: 15px;
            }

            section table #accion {
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

                $('#tablaDinamicaLoad2').DataTable({
                    aLengthMenu: [10, 25, 50, 100, 200],
                    aaSorting: [
                        [0, "desc"]
                    ],
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    }


                })
            })

            function mostrarIP(valor) {
                if (valor.checked) {
                    $('#ipSeccion').show(200);
                    $('input[name=ip]').prop('required', true);
                } else {
                    $('#ipSeccion').hide(200);
                    $('input[name=ip]').prop('required', false);
                    $('input[name=ip]').val('');
                }
            }

            function validarInputNumerico(valor) {
                const ip = /^[0-9.]+$/;
                if (!ip.test(valor.value)) {
                    valor.value = valor.value.substring(0, valor.value.length - 1);
                }
            }

            function mostrarMotivosProblemas(valor) {
                var codigoArea = valor.value;

                $.ajax({
                    type: 'POST',
                    url: 'ajax/selectMotivos.php',
                    data: 'codigoArea=' + codigoArea,
                    success: function(r) {
                        $('select[name=selectMotivos]').html(r);
                    }
                })
            }

            function validarComillas(valor) {
                valor.value = valor.value.replace('\'', '"');
            }

            function buscarComillaSimple(valor) {
                if (valor.value.includes('\'')) {
                    alert('Debe tener comillas dobles');
                    valor.focus();
                }
            }
        </script>

        <script>
            $(document).ready(function() {
                $('.btnCerrarModalEditar').click(function() {
                    $(".modalEditar .modal-body .selectEstado").val("");
                })
            })
        </script>

        <body>
            <section id="container">

                <?php

                if ($_SESSION['tareaOK'] == true) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido añadida con éxito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaOK']);
                }
                ?>

                <?php
                if ($_SESSION['tareaEditada'] == true) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido modificada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaEditada']);
                }
                if ($_SESSION['tareaCancelada']) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido cancelada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaCancelada']);
                }
                ?>

                <p class="fs-5">Tareas <?php echo $estado; ?></p>
                <hr>
                <p class="fs-6">
                    Para editar o cancelar una tarea. Aprete el botón <b>Acción</b><br>
                    Para agregar una nueva tarea, el botón <b>Nueva Tarea</b>
                </p>

                <div class="table-responsive-xxl">
                    <div id="btnTarea">


                        <form action="../controlador/c_enc_agregarTarea.php" method="post">
                            <!--Modal Nueva TAREA-->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Nueva Tarea</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="fs-6">Ingrese la tarea con sus respectivos datos</p>

                                            <input type="hidden" name="rol" value="<?php echo $_SESSION['rol']; ?>">

                                            <input type="hidden" name="nombreApellido" value="<?php echo $_SESSION['nombreApellido']; ?>">

                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="selectArea" onchange="mostrarMotivosProblemas(this);" id="floatingSelect" aria-label="Floating label select example" required>
                                                    <option value="" selected>Seleccione...</option>
                                                    <?php
                                                    foreach ($listAreas as $area) {
                                                    ?>
                                                        <option value="<?php echo $area[0]; ?>">
                                                            <?php
                                                            echo $area[1];
                                                            ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Seleccione el Área involucrada</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="selectMotivos" id="floatingSelect" aria-label="Floating label select example" required>
                                                    <option value="" selected>Seleccione primero el Área</option>
                                                </select>
                                                <label for="floatingSelect">Seleccione el motivo del incoveniente</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="descripcion" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" placeholder="Leave a comment here" id="floatingTextarea" style="height: 170px" required></textarea>
                                                <label for="floatingTextarea">Descripción</label>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" onclick="mostrarIP(this);">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Con IP
                                                </label>
                                            </div>

                                            <div class="form-floating mb-3" id="ipSeccion" style="display: none;">
                                                <input type="text" name="ip" oninput="validarInputNumerico(this);" class="form-control" id="floatingInput" placeholder="Nombre del Afectado">
                                                <label for="floatingInput">IP</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" name="nombreApellidoAfectado" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" class="form-control" id="floatingInput" placeholder="ejemplo">
                                                <label for="floatingInput">Nombre y apellido del afectado/a (Opcional)</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="tel" name="cel" oninput="validarInputNumerico(this);" class="form-control" id="floatingInput" placeholder="ejemplo">
                                                <label for="floatingInput">Nro de celular (Opcional)</label>
                                            </div>


                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="selectDireccion" id="floatingSelect" aria-label="Floating label select example" required>
                                                    <option value="" selected>Seleccione...</option>
                                                    <?php
                                                    foreach ($listDirecciones as $direccion) {
                                                    ?>
                                                        <option value="<?php echo $direccion[0]; ?>">
                                                            <?php echo $direccion[1]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Seleccione la Dirección o Entidad donde se desempeña</label>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Nueva Tarea
                        </button>
                    </div>

                    <div id="tCompletadasActual">
                        <?php
                        if ($_GET['listado'] == 'completadas') {
                        ?>

                            <p class="fs-5 text-center">Tareas completadas en el día de hoy</p>
                            <hr>

                            <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Motivo</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Afectado/a</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Fecha Problema</th>
                                        <th scope="col">Dirección/Entidad</th>
                                        <th scope="col">Asignado</th>
                                        <th scope="col">Área</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($tareasEncargadosCompletasActual as $completas) {
                                    ?>

                                        <tr>
                                            <td><?php echo $completas[0]; ?></td>
                                            <td><?php echo $completas[2]; ?></td>
                                            <td><?php echo $completas[3]; ?></td>
                                            <td><?php echo $completas[5]; ?></td>
                                            <td>
                                                <?php
                                                if ($completas[9] == 'Completo') {
                                                    echo '<span class="badge text-bg-success">' . $completas[9] . '</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($completas[11] != '' || $completas[11] != null) {

                                                    $date = date_create($completas[11]);
                                                    $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                                    echo $fechaProblema;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $completas[14]; ?></td>
                                            <td><?php echo $completas[17]; ?></td>
                                            <td><?php echo $completas[16]; ?></td>

                                            <td id="accion">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Acción
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">


                                                        <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalInfoTarea<?php echo $completas[0]; ?>">Ver más info</a></li>

                                                        <?php
                                                        if ($completas[9] != 'Completo') {
                                                        ?>

                                                            <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditarTarea<?php echo $completas[0]; ?>">Editar tarea</a></li>
                                                            <?php
                                                            if ($completas[9] != 'Cancelado' && $completas[9] != 'Completo') {
                                                            ?>
                                                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCancelarTarea<?php echo $completas[0]; ?>">Cancelar tarea</a></li>
                                                            <?php
                                                            }
                                                            ?>

                                                        <?php
                                                        }
                                                        ?>

                                                    </ul>
                                                </div>
                                            </td>

                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        <?php
                        }
                        ?>

                    </div>

                    <br>
                    <br>

                    <div id="tPrincipal">
                        <?php
                        if ($_GET['listado'] == 'completadas') {
                        ?>
                            <p class="fs-5 text-center">Tareas completadas en total</p>
                            <hr>
                        <?php
                        }
                        ?>


                        <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Motivo</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Afectado/a</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha Problema</th>
                                    <th scope="col">Dirección/Entidad</th>
                                    <th scope="col">Asignado</th>
                                    <th scope="col">Área</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listTareasEncargados as $listTarea) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $listTarea[0]; ?></td>
                                        <td><?php echo $listTarea[2]; ?></td>
                                        <td><?php echo $listTarea[3]; ?></td>
                                        <td><?php echo $listTarea[5]; ?></td>
                                        <td>
                                            <?php
                                            if ($listTarea[9] == 'Pendiente') {
                                                echo '<span class="badge bg-secondary">' . $listTarea[9] . '</span>';
                                            } else if ($listTarea[9] == 'En Progreso') {
                                                echo '<span class="badge bg-primary">' . $listTarea[9] . '</span>';
                                            } else if ($listTarea[9] == 'Completo') {
                                                echo '<span class="badge bg-success">' . $listTarea[9] . '</span>';
                                            } else if ($listTarea[9] == 'Cancelado') {
                                                echo '<span class="badge bg-danger">' . $listTarea[9] . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $date = date_create($listTarea[11]);
                                            $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                            echo $fechaProblema;
                                            ?>
                                        </td>
                                        <td><?php echo $listTarea[14]; ?></td>

                                        <td><?php echo $listTarea[17]; ?></td>

                                        <td><?php echo $listTarea[16]; ?></td>

                                        <td id="accion">

                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Acción
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">


                                                    <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalInfoTarea<?php echo $listTarea[0]; ?>">Ver más info</a></li>

                                                    <?php
                                                    if ($listTarea[9] != 'Completo') {
                                                    ?>

                                                        <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditarTarea<?php echo $listTarea[0]; ?>">Editar tarea</a></li>
                                                        <?php
                                                        if ($listTarea[9] != 'Cancelado' && $listTarea[9] != 'Completo') {
                                                        ?>
                                                            <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCancelarTarea<?php echo $listTarea[0]; ?>">Cancelar tarea</a></li>
                                                        <?php
                                                        }
                                                        ?>

                                                    <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                    <!-- Modal Ver Info Tarea -->
                                    <div class="modal fade modalEditar" id="modalInfoTarea<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Información de la tarea</h5>
                                                    <button type="button" class="btn-close btnCerrarModalEditar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body bodyModalInfo">

                                                    <p class="fs-6">Tarea N° <?php echo $listTarea[0]; ?></p>

                                                    <input type="hidden" name="nroArreglo" value="<?php echo $listTarea[0]; ?>">

                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" name="selectMotivos" id="floatingSelect" aria-label="Floating label select example" disabled>
                                                            <option value="<?php echo $listTarea[1]; ?>" selected><?php echo $listTarea[2]; ?></option>
                                                            <?php
                                                            foreach ($listMotivos as $motivo) {
                                                            ?>
                                                                <option value="<?php echo $motivo[0]; ?>">
                                                                    <?php
                                                                    echo $motivo[1];
                                                                    ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="floatingSelect">Motivo del incoveniente</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 170px" disabled><?php echo $listTarea[3]; ?></textarea>
                                                        <label for="floatingTextarea2">Descripción</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[4] == '' || $listTarea[4] == null) {
                                                        $ip = 'No proporcionado';
                                                    } else {
                                                        $ip = $listTarea[4];
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="ip" value="<?php echo $ip; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">IP</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[5] == '' || $listTarea[5] == null) {
                                                        $nombreApellidoAfectado = 'No proporcionado';
                                                    } else {
                                                        $nombreApellidoAfectado = $listTarea[5];
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nombreApellido" value="<?php echo $nombreApellidoAfectado; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Nombre y apellido del afectado/a</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[6] == '' || $listTarea[6] == null) {
                                                        $cel = 'No proporcionado';
                                                    } else {
                                                        $cel = $listTarea[6];
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="cel" value="<?php echo $cel; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Nro de celular de contacto</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[7] != '') {
                                                    ?>
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $listTarea[7]; ?>    
                                                            </textarea>
                                                            <label for="floatingTextarea">Solución del incoveniente</label>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="estadoTarea" value="<?php echo $listTarea[9]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Estado de la tarea</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[10] != '') {
                                                    ?>
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $listTarea[10]; ?>    
                                                            </textarea>
                                                            <label for="floatingTextarea">Motivo de la cancelación</label>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    $date = date_create($listTarea[11]);
                                                    $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                                    ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="fechaProblema" value="<?php echo $fechaProblema; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Fecha del problema</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[12] != '') {
                                                        $date = date_create($listTarea[12]);
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
                                                        <input type="text" name="area" value="<?php echo $listTarea[14]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Dirección o Entidad donde se desempeña</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="area" value="<?php echo $listTarea[16]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Área que lleva a cabo la tarea/reclamo</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="area" value="<?php echo $listTarea[17]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Asignado</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="area" value="<?php echo $listTarea[18]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Creado por</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btnCerrarModalEditar" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Editar Tarea -->
                                    <div class="modal fade modalEditar" id="modalEditarTarea<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Editar Tarea N°<?php echo $listTarea[0]; ?></h5>
                                                    <button type="button" class="btn-close btnCerrarModalEditar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="../controlador/c_enc_editarTarea.php" method="post" style="display: none;">
                                                    <div class="modal-body">

                                                        <p class="fs-6">Editar en caso de que haya habido un cambio o un error.</p>

                                                        <input type="hidden" name="nroArreglo" value="<?php echo $listTarea[0]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" name="selectArea" onchange="mostrarMotivosProblemas(this);" id="floatingSelect" aria-label="Floating label select example" required>
                                                                <option value="<?php echo $listTarea[15]; ?>" selected><?php echo $listTarea[16]; ?></option>
                                                                <?php
                                                                foreach ($listAreas as $area) {
                                                                ?>
                                                                    <option value="<?php echo $area[0]; ?>">
                                                                        <?php
                                                                        echo $area[1];
                                                                        ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <label for="floatingSelect">Seleccione el Área involucrada</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" name="selectMotivos" id="floatingSelect" aria-label="Floating label select example" required>
                                                                <option value="<?php echo $listTarea[1]; ?>" selected><?php echo $listTarea[2]; ?> (Actual)</option>
                                                            </select>
                                                            <label for="floatingSelect">Motivo del incoveniente</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="descripcion" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" placeholder="Leave a comment here" id="floatingTextarea" style="height: 170px"><?php echo $listTarea[3]; ?></textarea>
                                                            <label for="floatingTextarea">Descripción</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="ip" value="<?php echo $listTarea[4]; ?>" class="form-control" id="floatingInput" placeholder="...">
                                                            <label for="floatingInput">IP</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="nombreApellidoAfectado" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" value="<?php echo $listTarea[5]; ?>" class="form-control" id="floatingInput" placeholder="ejemplo">
                                                            <label for="floatingInput">Nombre y apellido del afectado/a</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="tel" name="cel" value="<?php echo $listTarea[6]; ?>" oninput="validarInputNumerico(this);" class="form-control" id="floatingInput" placeholder="ejemplo">
                                                            <label for="floatingInput">Nro de celular</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" name="selectDireccion" id="floatingSelect" aria-label="Floating label select example" required>
                                                                <option value="<?php echo $listTarea[13]; ?>" selected><?php echo $listTarea[14]; ?> (Actual)</option>
                                                                <?php
                                                                foreach ($listDirecciones as $direccion) {
                                                                ?>
                                                                    <option value="<?php echo $direccion[0]; ?>">
                                                                        <?php echo $direccion[1]; ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <label for="floatingSelect">Dirección o Entidad donde se desempeña el/la afectado/a</label>
                                                        </div>

                                                        <hr>

                                                        <?php
                                                        if ($listTarea[10] != '' || $listTarea[10] != null) {
                                                        ?>
                                                            <div class="form-floating mb-3">
                                                                <textarea class="form-control" name="motivoCancelacion" placeholder="Leave a comment" id="floatingTextarea" style="height: 100px" required><?php echo $listTarea[12]; ?></textarea>
                                                                <label for="floatingTextarea">Motivo de la cancelación</label>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btnCerrarModalEditar" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Cancelar Tarea -->
                                    <div class="modal fade" id="modalCancelarTarea<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Cancelar tarea</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="../controlador/c_enc_cancelarTarea.php" method="post" style="display: none;">

                                                    <div class="modal-body">

                                                        <p class="fs-6">Para cancelar la tarea debe completar lo siguiente</p>

                                                        <input type="hidden" name="id" value="<?php echo $listTarea[0]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="motivoCancelacion" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" placeholder="Leave a comment" id="floatingTextarea" style="height: 100px" required></textarea>
                                                            <label for="floatingTextarea">Motivo de la cancelación</label>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-danger">Cancelar tarea</button>
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

                    <div id="tResultado">

                    </div>

                </div>

                <div class="table-responsive-xxl">
                    <div id="tResultado">

                    </div>
                </div>

            </section>
        </body>

        </html>

    <?php
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
}
?>