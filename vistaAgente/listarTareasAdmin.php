<?php
error_reporting(E_ALL ^ E_NOTICE);

if (!(time() - $_SESSION['time'] >= 3600)) {
    $_SESSION['time'] = time();
    if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 4) {
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


                section #btnTarea {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-top: 5px;
                    margin-bottom: 5px;
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
                //DATATABLE
                $(document).ready(function() {
                    function addZero(i) {
                        if (i < 10) {
                            i = "0" + i
                        }
                        return i;
                    }

                    const dNow = new Date();
                    let h = addZero(dNow.getHours());
                    let m = addZero(dNow.getMinutes());

                    let time = h + ":" + m;
                    var localdate = dNow.getDate() + '/' + (dNow.getMonth() + 1) + '/' + dNow.getFullYear() + ' ' + time;

                    $('#tablaDinamicaLoad').DataTable({
                        aLengthMenu: [25, 50, 100, 200],
                        dom: 'lBfrtip',
                        aaSorting: [
                            [0, "asc"]
                        ],
                        buttons: [{
                                extend: 'excelHtml5',
                                title: 'Listado de Tareas - Gestión de tareas',
                                messageTop: 'Reporte: ' + localdate,
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                download: 'open',
                                messageTop: 'Reporte: ' + localdate,
                                title: 'Listado de Tareas - Gestión de tareas',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                },
                            },
                        ],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    })

                    $('#tablaDinamicaLoad2').DataTable({
                        aLengthMenu: [10, 25, 50, 100, 200],
                        aaSorting: [
                            [0, "asc"]
                        ],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    })
                })

                function mostrarNE(valor) {
                    if (valor.checked) {
                        $('#neSeccion').show(200);
                        $('input[name=ne]').prop('required', true);
                    } else {
                        $('#neSeccion').hide(200);
                        $('input[name=ne]').prop('required', false);
                        $('input[name=ne]').val('');
                    }
                }

                function validarInputNumerico(valor) {
                    const num = /^[0-9.]+$/;
                    if (!num.test(valor.value)) {
                        valor.value = valor.value.substring(0, valor.value.length - 1);
                    }
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
        </head>

        <body>
            <?php
            // error_reporting(0); 
            ?>
            <section id="container">
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['username']; ?>">
                <?php
                if (isset($_SESSION['tareaOK'])) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido agregada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaOK']);
                }
                if (isset($_SESSION['tareaAsignada'])) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido asignada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaAsignada']);
                }
                if (isset($_SESSION['tareaAsignadaQuitada'])) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido desasignada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaAsignadaQuitada']);
                }
                if (isset($_SESSION['tareaTerminada'])) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido concluida',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaTerminada']);
                }
                if (isset($_SESSION['tareaCancelada'])) {
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
                if (isset($_SESSION['tareaEditada'])) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'La tarea ha sido editada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                <?php
                    unset($_SESSION['tareaEditada']);
                }
                ?>

                <p class="fs-5">Tareas <?php echo $estado; ?></p>
                <hr>
                <p class="fs-6">
                    Para ver las opciones de las tareas, presione <b>Acción</b>
                    <br>
                    Para obtener más información acerca de la tarea presione <b>Acción > Ver más Info</b>
                </p>

                <div class="table-responsive-xxl">

                    <div id="btnTarea">
                        <form action="../controlador/c_agregarTarea.php" method="post">
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
                                                <select class="form-select" name="selectArea" id="floatingSelect" aria-label="Floating label select example" required>
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
                                                <textarea class="form-control" name="descripcion" placeholder="Leave a comment" id="floatingTextarea" style="height: 200px;" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" required></textarea>
                                                <label for="floatingTextarea">Descripción</label>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" onclick="mostrarNE(this);">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Con Nota Electrónica
                                                </label>
                                            </div>

                                            <div class="form-floating mb-3" id="neSeccion" style="display: none;">
                                                <input type="text" name="ne" class="form-control" id="floatingInput" placeholder="Nombre del Afectado">
                                                <label for="floatingInput">Nota Electrónica</label>
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
                                                <select class="form-select" name="direccion" id="floatingSelect" aria-label="Floating label select example" required>
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

                    <?php
                    if ($_GET['lista'] == 'completas') {
                    ?>
                        <div id="tCompletadosActual">
                            <p class="fs-5 text-center">Tareas completadas hoy día</p>
                            <hr>
                            <table class="table table-responsive table-bordered table-hover" id="tablaDinamicaLoad2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nota Electrónica</th>
                                        <th scope="col">Descripción</th>

                                        <th scope="col">Afectado/a</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Fecha Problema</th>

                                        <th scope="col">Dirección/Entidad</th>
                                        <th scope="col">Área encargada</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listTareasCompletasActual as $completas) {
                                    ?>
                                        <tr>
                                            <td><?php echo $completas[0]; ?></td>
                                            <td><?php echo $completas[2]; ?></td>
                                            <td><?php echo $completas[1]; ?></td>
                                            <td><?php echo $completas[3]; ?></td>
                                            <td>
                                                <?php
                                                if ($completas[7] == 'Completo') {
                                                    echo '<span class="badge text-bg-success">' . $completas[7] . '</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $date = date_create($completas[9]);
                                                $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                                echo $fechaProblema;
                                                ?>
                                            </td>
                                            <td><?php echo $completas[12]; ?></td>
                                            <td><?php echo $completas[16]; ?></td>
                                            <td id="accion">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Acción
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                        <li>
                                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalVerInfo<?php echo $completas[0]; ?>">
                                                                Ver más info
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminarTarea<?php echo $completas[0]; ?>">
                                                                Eliminar tarea
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODALES TERMINADAS HOY -->
                                        <!-- Modal Ver Info Tarea -->
                                        <div class="modal fade modalEditar" id="modalVerInfo<?php echo $completas[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Información de la tarea</h5>
                                                        <button type="button" class="btn-close btnCerrarModalEditar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body bodyModalInfo">

                                                        <p class="fs-6">Tarea N° <?php echo $completas[0]; ?></p>

                                                        <input type="hidden" name="nroArreglo" value="<?php echo $completas[0]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 170px" disabled><?php echo $completas[1]; ?></textarea>
                                                            <label for="floatingTextarea">Descripción</label>
                                                        </div>

                                                        <?php
                                                        if ($completas[2] == '' || $completas[2] == null) {
                                                            $ne = 'No proporcionado';
                                                        } else {
                                                            $ne = $completas[2];
                                                        }
                                                        ?>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="ne" value="<?php echo $ne; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Nota Electrónica</label>
                                                        </div>

                                                        <?php
                                                        if ($completas[3] == '' || $completas[3] == null) {
                                                            $nombreApellidoAfectado = 'No proporcionado';
                                                        } else {
                                                            $nombreApellidoAfectado = $completas[3];
                                                        }
                                                        ?>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="nombreApellido" value="<?php echo $nombreApellidoAfectado; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Nombre y apellido del afectado/a</label>
                                                        </div>

                                                        <?php
                                                        if ($completas[4] == '' || $completas[4] == null) {
                                                            $cel = 'No proporcionado';
                                                        } else {
                                                            $cel = $completas[4];
                                                        }
                                                        ?>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="cel" value="<?php echo $cel; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Nro de celular de contacto</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $completas[5]; ?></textarea>
                                                            <label for="floatingTextarea">Materiales utilizados</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="comprobante" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $completas[18]; ?></textarea>
                                                            <label for="floatingTextarea">Comprobante</label>
                                                        </div>

                                                        <?php
                                                        $date = date_create($completas[9]);
                                                        $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                                        ?>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="fechaProblema" value="<?php echo $fechaProblema; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Fecha del problema</label>
                                                        </div>

                                                        <?php
                                                        $date = date_create($completas[10]);
                                                        $fechaSolucion = date_format($date, 'd/m/Y H:i:s');
                                                        ?>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="fechaSolucion" value="<?php echo $fechaSolucion; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Fecha de la solución</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="area" value="<?php echo $completas[12]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Dirección o Entidad donde se desempeña el/la afectado/a</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="area" value="<?php echo $completas[16]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Área que lo lleva a cabo</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="area" value="<?php echo $completas[17]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                            <label for="floatingInput">Creado por</label>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btnCerrarModalEditar" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Eliminar Tarea -->
                                        <div class="modal fade" id="modalEliminarTarea<?php echo $completas[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar tarea N°<?php echo $completas[0]; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form action="../controlador/c_eliminarTarea.php" id="formEliminarTarea" method="post" style="display: none;">

                                                        <div class="modal-body">

                                                            <p class="fs-6">Para eliminar la tarea debe completar lo siguiente</p>

                                                            <input type="hidden" name="id" value="<?php echo $completas[0]; ?>">

                                                            <div class="form-floating mb-3">
                                                                <textarea class="form-control" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" name="motivoEliminacion" placeholder="Leave a comment" id="floatingTextarea" style="height: 100px" required></textarea>
                                                                <label for="floatingTextarea">Motivo de la eliminación</label>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-danger">Eliminar tarea</button>
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

                    <?php
                    }
                    ?>

                    <br>

                    <div id="tPrincipal">
                        <?php
                        if ($_GET['lista'] == 'completas') {
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
                                    <th scope="col">Nota Electrónica</th>
                                    <th scope="col">Descripción</th>

                                    <th scope="col">Afectado/a</th>
                                    <th scope="col">Contacto</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha Problema</th>

                                    <th scope="col">Dirección/Entidad</th>
                                    <th scope="col">Área encargada</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listTareasAgentes as $listTarea) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $listTarea[0]; ?></td>
                                        <td><?php echo $listTarea[2]; ?></td>
                                        <td><?php echo $listTarea[1]; ?></td>
                                        <td><?php echo $listTarea[3]; ?></td>
                                        <td><?php echo $listTarea[4]; ?></td>

                                        <td>
                                            <?php
                                            if ($listTarea[7] == 'Pendiente') {
                                                echo '<span class="badge bg-secondary">' . $listTarea[7] . '</span>';
                                            } else if ($listTarea[7] == 'En Progreso') {
                                                echo '<span class="badge bg-primary">' . $listTarea[7] . '</span>';
                                            } else if ($listTarea[7] == 'Completo') {
                                                echo '<span class="badge bg-success">' . $listTarea[7] . '</span>';
                                            } else if ($listTarea[7] == 'Cancelado') {
                                                echo '<span class="badge bg-danger">' . $listTarea[7] . '</span>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            $date = date_create($listTarea[9]);
                                            $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                            echo $fechaProblema;
                                            ?>
                                        </td>

                                        <td><?php echo $listTarea[12]; ?></td>
                                        <td><?php echo $listTarea[16]; ?></td>
                                        <td id="accion">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Acción
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                    <li>
                                                        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalVerInfo<?php echo $listTarea[0]; ?>">
                                                            Ver más info
                                                        </a>
                                                    </li>

                                                    <?php
                                                    if ($listTarea[7] == 'Pendiente') {
                                                    ?>
                                                        <li>
                                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalAsignarTarea<?php echo $listTarea[0]; ?>">
                                                                Iniciar la tarea
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    if ($listTarea[7] == 'En Progreso') {
                                                    ?>
                                                        <li>
                                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalTareaCompletada<?php echo $listTarea[0]; ?>">
                                                                Terminar tarea
                                                            </a>
                                                        </li>

                                                    <?php
                                                    }
                                                    if ($listTarea[7] != 'Cancelado' && $listTarea[7] != 'Completo') {
                                                    ?>
                                                        <li>
                                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCancelarTarea<?php echo $listTarea[0]; ?>">
                                                                Cancelar tarea
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditarTarea<?php echo $listTarea[0]; ?>">
                                                                Editar tarea
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>

                                                    <li>
                                                        <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminarTarea<?php echo $listTarea[0]; ?>">
                                                            Eliminar tarea
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODALES TAREAS GENERALES -->
                                    <!-- Modal Ver Info Tarea -->
                                    <div class="modal fade modalEditar" id="modalVerInfo<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                        <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 170px" disabled><?php echo $listTarea[1]; ?>
                                                        </textarea>
                                                        <label for="floatingTextarea">Descripción</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[2] == '' || $listTarea[2] == null) {
                                                        $ne = 'No proporcionado';
                                                    } else {
                                                        $ne = $listTarea[2];
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="ne" value="<?php echo $ne; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Nota Electrónica</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[3] == '' || $listTarea[3] == null) {
                                                        $nombreApellidoAfectado = 'No proporcionado';
                                                    } else {
                                                        $nombreApellidoAfectado = $listTarea[3];
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nombreApellido" value="<?php echo $nombreApellidoAfectado; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Nombre y apellido del afectado/a</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[4] == '' || $listTarea[4] == null) {
                                                        $cel = 'No proporcionado';
                                                    } else {
                                                        $cel = $listTarea[4];
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="cel" value="<?php echo $cel; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Nro de celular de contacto</label>
                                                    </div>


                                                    <?php
                                                    if ($listTarea[5] != '') {
                                                    ?>
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled><?php echo $listTarea[5]; ?>
                                                            </textarea>
                                                            <label for="floatingTextarea">Materiales utilizados</label>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="estadoTarea" value="<?php echo $listTarea[7]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Estado de la tarea</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[8] != '') {
                                                    ?>
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="solucion" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" disabled>
                                                                <?php echo $listTarea[8]; ?>
                                                            </textarea>
                                                            <label for="floatingTextarea">Motivo de la cancelación</label>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    $date = date_create($listTarea[9]);
                                                    $fechaProblema = date_format($date, 'd/m/Y H:i:s');
                                                    ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="fechaProblema" value="<?php echo $fechaProblema; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Fecha del problema</label>
                                                    </div>

                                                    <?php
                                                    if ($listTarea[10] != '') {
                                                        $date = date_create($listTarea[10]);
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
                                                        <input type="text" name="area" value="<?php echo $listTarea[12]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Dirección o Entidad donde se desempeña el/la afectado/a</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="area" value="<?php echo $listTarea[16]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Área donde se lleva a cabo</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="area" value="<?php echo $listTarea[17]; ?>" class="form-control" id="floatingInput" placeholder="..." disabled>
                                                        <label for="floatingInput">Creado por</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btnCerrarModalEditar" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal Iniciar Tarea-->
                                    <div class="modal fade" id="modalAsignarTarea<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Iniciar tarea - <?php echo $listTarea[16]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../controlador/c_iniciarTarea.php" method="get">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?php echo $listTarea[0]; ?>">
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="descripcion" placeholder="Leave a comment" id="floatingTextarea" style="height: 170px" disabled><?php echo $listTarea[1]; ?></textarea>
                                                            <label for="floatingTextarea">Descripción</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
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
                                                    <h5 class="modal-title" id="staticBackdropLabel">Terminar tarea</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="../controlador/c_cancelarTarea.php" method="post" style="display: none;">

                                                    <div class="modal-body">

                                                        <p class="fs-6">Para cancelar la tarea debe completar lo siguiente</p>

                                                        <input type="hidden" name="id" value="<?php echo $listTarea[0]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" onchange="buscarComillaSimple(this)" oninput="validarComillas(this);" name="motivoCancelacion" placeholder="Leave a comment" id="floatingTextarea" style="height: 100px" required></textarea>
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

                                    <!-- Modal Editar Tarea -->
                                    <div class="modal fade" id="modalEditarTarea<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Editar tarea</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="../controlador/c_editarTarea.php" method="post" style="display: none;">

                                                    <div class="modal-body">

                                                        <p class="fs-6">Editar en caso de que haya habido un cambio o un error.</p>

                                                        <input type="hidden" name="nroArreglo" value="<?php echo $listTarea[0]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" name="selectArea" id="floatingSelect" aria-label="Floating label select example" required>
                                                                <option value="<?php echo $listTarea[15]; ?>" selected><?php echo $listTarea[16]; ?> (Actual)</option>
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
                                                            <textarea class="form-control" name="descripcion" placeholder="Leave a comment" id="floatingTextarea" style="height: 170px" required><?php echo $listTarea[1]; ?></textarea>
                                                            <label for="floatingTextarea">Descripción</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="ne" value="<?php echo $listTarea[2]; ?>" class="form-control" id="floatingInput" placeholder="Nombre del Afectado">
                                                            <label for="floatingInput">Nota Electrónica</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="nombreApellidoAfectado" value="<?php echo $listTarea[3]; ?>" class="form-control" id="floatingInput" placeholder="ejemplo">
                                                            <label for="floatingInput">Nombre y apellido del afectado/a (Opcional)</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="tel" name="cel" value="<?php echo $listTarea[4]; ?>" oninput="validarInputNumerico(this);" class="form-control" id="floatingInput" placeholder="ejemplo">
                                                            <label for="floatingInput">Nro de celular (Opcional)</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" name="selectDireccion" id="floatingSelect" aria-label="Floating label select example" required>
                                                                <option value="<?php echo $listTarea[11]; ?>" selected><?php echo $listTarea[12]; ?> (Actual)</option>
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
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Tarea Terminada -->
                                    <!--  -->

                                    <!-- Modal Eliminar Tarea -->
                                    <div class="modal fade" id="modalEliminarTarea<?php echo $listTarea[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar tarea N°<?php echo $listTarea[0]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="../controlador/c_eliminarTarea.php" id="formEliminarTarea" method="post" style="display: none;">

                                                    <div class="modal-body">

                                                        <p class="fs-6">Para eliminar la tarea debe completar lo siguiente</p>

                                                        <input type="hidden" name="id" value="<?php echo $listTarea[0]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="motivoEliminacion" placeholder="Leave a comment" id="floatingTextarea" style="height: 100px" required></textarea>
                                                            <label for="floatingTextarea">Motivo de la eliminación</label>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-danger">Eliminar tarea</button>
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
        <p class="fs-5">Sesión caducada. Para acceder a esta sección debe iniciar sesión <a href="../vista/login.php" class="link-primary">Click aquí</a></p>
    </body>

    </html>

<?php
}
?>