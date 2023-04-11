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
            <title>Estadísticas - Gestión Sistemas</title>
            <style>
                section {
                    padding: 15px;
                }

                #graficos {
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr;
                }

                #total {
                    grid-column: 1/4;
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                    margin-bottom: 20px;
                }
            </style>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        </head>

        <body>
            <section id="container">
                <p class="fs-5">Estadísticas</p>
                <hr>
                <p class="fs-6"><b>Nota: </b>Si hay diagramas que no se visualizan, es por el motivo de que no se han creado requerimientos en esa sección</p>

                <div id="graficos">

                    <div id="total">
                        <div id="totalTareas">
                            <canvas style="width: 400px;" id="myChart"></canvas>
                        </div>

                        <div id="totalxAreas">
                            <canvas style="width: 400px;" id="diagramaTotalAreas"></canvas>
                        </div>
                    </div>


                    <div id="totalMotivosRedes">
                        <canvas id="diagramaMotivosRedes"></canvas>
                    </div>

                    <div id="totalMotivosInfr">
                        <canvas id="diagramaMotivosInfr"></canvas>
                    </div>

                    <div id="totalMotivosSTecnico">
                        <canvas id="diagramaMotivosST"></canvas>
                    </div>

                    <hr style="grid-column: 1/4;">

                    <div id="totalMotivosReq" style="grid-column: 1/4;">
                        <canvas id="diagramaMotivosReq" width="400" height="400"></canvas>
                    </div>

                    <hr style="grid-column: 1/4;">

                    <div id="totalMotivosFD">
                        <canvas id="diagramaMotivosFD"></canvas>
                    </div>

                    <div id="totalMotivosPD">
                        <canvas id="diagramaMotivosPD"></canvas>
                    </div>

                    <div id="totalMotivosCCTV">
                        <canvas id="diagramaMotivosCCTV"></canvas>
                    </div>
                </div>

            </section>
        </body>

        <script>
            //Total Motivos Sistemas
            const labels = [
                <?php
                foreach ($totalPendientes as $pendiente) {
                    echo "'" . $pendiente[1] . "',";
                }
                ?>
                <?php
                foreach ($totalEnProgreso as $progreso) {
                    echo "'" . $progreso[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalCompletas as $completas) {
                    echo "'" . $completas[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalCanceladas as $canceladas) {
                    echo "'" . $canceladas[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalEliminadas as $eliminadas) {
                    echo "'" . $eliminadas[1] . "', ";
                }
                ?>
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Total de requerimientos de Sistemas',
                    backgroundColor: [
                        'lightgray',
                        'LightSkyBlue',
                        'MediumSeaGreen',
                        'LightCoral',
                        'LightGoldenRodYellow',
                    ],

                    data: [
                        <?php
                        foreach ($totalPendientes as $pendiente) {
                            echo $pendiente[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalEnProgreso as $progreso) {
                            echo $progreso[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalCompletas as $completas) {
                            echo $completas[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalCanceladas as $canceladas) {
                            echo $canceladas[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalEliminadas as $eliminadas) {
                            echo $eliminadas[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Sistemas: <?php echo $totalTareas; ?>'
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'center',
                        },
                    }

                }
            };

            //-----------------------------------------
            const labelsTotalxAreas = [
                <?php
                foreach ($totalRedes as $redes) {
                    echo "'" . $redes[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalInfraestrucutra as $infr) {
                    echo "'" . $infr[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalSTecnico as $stecnico) {
                    echo "'" . $stecnico[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalRequerimientos as $requerimientos) {
                    echo "'" . $requerimientos[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalFDigital as $fdigital) {
                    echo "'" . $fdigital[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalPDigital as $pdigital) {
                    echo "'" . $pdigital[1] . "', ";
                }
                ?>
                <?php
                foreach ($totalCctv as $cctv) {
                    echo "'" . $cctv[1] . "', ";
                }
                ?>
            ];

            const dataTotalxAreas = {
                labels: labelsTotalxAreas,
                datasets: [{
                    label: 'Total de requerimientos de Sistemas',
                    backgroundColor: [
                        'lightgray',
                        'aquamarine',
                        'MediumSeaGreen',
                        'LightSalmon',
                        'LightYellow',
                        'Tomato',
                        'MediumPurple'
                    ],

                    data: [
                        <?php
                        foreach ($totalRedes as $redes) {
                            echo $redes[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalInfraestrucutra as $infr) {
                            echo $infr[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalSTecnico as $stecnico) {
                            echo $stecnico[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalRequerimientos as $requerimientos) {
                            echo $requerimientos[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalFDigital as $fdigital) {
                            echo $fdigital[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalPDigital as $pdigital) {
                            echo $pdigital[0] . ", ";
                        }
                        ?>
                        <?php
                        foreach ($totalCctv as $cctv) {
                            echo $cctv[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configTotalAreas = {
                type: 'pie',
                data: dataTotalxAreas,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Sistemas por Áreas'
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'center',
                        },
                    }
                }
            };

            //-----------------------------------------
            const labelsMotivosRedes = [
                <?php
                foreach ($totalMotivosRedes as $redes) {
                    echo "'" . $redes[1] . "', ";
                }
                ?>
            ];

            const dataMotivosRedes = {
                labels: labelsMotivosRedes,
                datasets: [{
                    label: 'Total de requerimientos de Sistemas',
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        '#A1887F',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        'Crimson',
                        'DarkSlateGray',
                        '#A1887F',
                        'LightSalmon',
                        'LightSeaGreen',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosRedes as $redes) {
                            echo $redes[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configTotalMotivosRedes = {
                type: 'pie',
                data: dataMotivosRedes,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Administración de Redes y Seguridad'
                        },
                    },
                }
            };

            //-----------------------------------------
            const labelsMotivosInfraestructura = [
                <?php
                foreach ($totalMotivosInfr as $infr) {
                    echo "'" . $infr[1] . "', ";
                }
                ?>
            ];

            const dataMotivosInfraestructura = {
                labels: labelsMotivosInfraestructura,
                datasets: [{
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        'MediumPurple',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        '#2ECC71',
                        '#F7DC6F',
                        '#F48FB1',
                        '#CE93D8',
                        'Crimson',
                        'DarkSlateGray',
                        '#A1887F',
                        'LightSalmon',
                        'LightSeaGreen',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosInfr as $infr) {
                            echo $infr[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configMotivosInfraestructura = {
                type: 'pie',
                data: dataMotivosInfraestructura,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Infraestructura'
                        },
                    }
                }
            };

            //------------------------------------------
            const labelsMotivosSTecnico = [
                <?php
                foreach ($totalMotivosSTecnico as $stecnico) {
                    echo "'" . $stecnico[1] . "', ";
                }
                ?>
            ];

            const dataMotivosSTecnico = {
                labels: labelsMotivosSTecnico,
                datasets: [{
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        'MediumPurple',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        '#2ECC71',
                        '#F7DC6F',
                        '#F48FB1',
                        '#CE93D8',
                        'Crimson',
                        'DarkSlateGray',
                        '#A1887F',
                        'LightSalmon',
                        'LightSeaGreen',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosSTecnico as $stecnico) {
                            echo $stecnico[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configMotivosSTecnico = {
                type: 'pie',
                data: dataMotivosSTecnico,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Servicio Técnico'
                        },
                    }
                }
            };

            //------------------------------------------
            const labelsMotivosReq = [
                <?php
                foreach ($totalMotivosRequerimientos as $req) {
                    echo "'" . $req[1] . "', ";
                }
                ?>
            ];

            const dataMotivosReq = {
                labels: labelsMotivosReq,
                datasets: [{
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        'MediumPurple',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        '#2ECC71',
                        '#F7DC6F',
                        '#F48FB1',
                        '#CE93D8',
                        'Crimson',
                        'DarkSlateGray',
                        'LightSeaGreen',
                        '#A1887F',
                        'LightSalmon',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosRequerimientos as $req) {
                            echo $req[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configMotivosReq = {
                type: 'pie',
                data: dataMotivosReq,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Requerimientos'
                        },
                        legend: {
                            display: true,
                            position: 'left',
                            align: 'middle',
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                },

            };

            //------------------------------------------

            const labelsMotivosFD = [
                <?php
                foreach ($totalMotivosFDigital as $fd) {
                    echo "'" . $fd[1] . "', ";
                }
                ?>
            ];

            const dataMotivosFD = {
                labels: labelsMotivosFD,
                datasets: [{
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        'MediumPurple',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        '#2ECC71',
                        '#F7DC6F',
                        '#F48FB1',
                        '#CE93D8',
                        'Crimson',
                        'DarkSlateGray',
                        '#A1887F',
                        'LightSalmon',
                        'LightSeaGreen',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosFDigital as $fd) {
                            echo $fd[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configMotivosFD = {
                type: 'pie',
                data: dataMotivosFD,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Firma Digital'
                        },
                    }
                }
            };

            //------------------------------------------

            const labelsMotivosPD = [
                <?php
                foreach ($totalMotivosPDigital as $pd) {
                    echo "'" . $pd[1] . "', ";
                }
                ?>
            ];

            const dataMotivosPD = {
                labels: labelsMotivosPD,
                datasets: [{
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        'MediumPurple',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        '#2ECC71',
                        '#F7DC6F',
                        '#F48FB1',
                        '#CE93D8',
                        'Crimson',
                        'DarkSlateGray',
                        '#A1887F',
                        'LightSalmon',
                        'LightSeaGreen',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosPDigital as $pd) {
                            echo $pd[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configMotivosPD = {
                type: 'pie',
                data: dataMotivosPD,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de Punto Digital'
                        },
                    }
                }
            };

            //------------------------------------------
        </script>

        <script>
            const labelsMotivosCCTV = [
                <?php
                foreach ($totalMotivosCCTV as $cctv) {
                    echo "'" . $cctv[1] . "', ";
                }
                ?>
            ];

            const dataMotivosCCTV = {
                labels: labelsMotivosCCTV,
                datasets: [{
                    backgroundColor: [
                        'Aquamarine',
                        'LightBlue',
                        'LightCyan',
                        'MediumPurple',
                        'MediumSlateBlue',
                        'RoyalBlue',
                        'DeepSkyBlue',
                        'Lavender',
                        'LightGreen',
                        'MediumOrchid',
                        'MediumSeaGreen',
                        '#EEFF41',
                        'Wheat',
                        '#2ECC71',
                        '#F7DC6F',
                        '#F48FB1',
                        '#CE93D8',
                        'Crimson',
                        'DarkSlateGray',
                        '#A1887F',
                        'LightSalmon',
                        'LightSeaGreen',
                    ],

                    data: [
                        <?php
                        foreach ($totalMotivosCCTV as $cctv) {
                            echo $cctv[0] . ", ";
                        }
                        ?>
                    ],
                }]
            };

            const configMotivosCCTV = {
                type: 'pie',
                data: dataMotivosCCTV,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de requerimientos de CCTV'
                        },
                    }
                }
            };
        </script>

        <script>
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            const myChart2 = new Chart(
                document.getElementById('diagramaTotalAreas'),
                configTotalAreas
            );
            const myChart3 = new Chart(
                document.getElementById('diagramaMotivosRedes'),
                configTotalMotivosRedes
            );
            const myChart4 = new Chart(
                document.getElementById('diagramaMotivosInfr'),
                configMotivosInfraestructura
            );
            const myChart5 = new Chart(
                document.getElementById('diagramaMotivosST'),
                configMotivosSTecnico
            );
            const myChart6 = new Chart(
                document.getElementById('diagramaMotivosReq'),
                configMotivosReq
            );
            const myChart7 = new Chart(
                document.getElementById('diagramaMotivosFD'),
                configMotivosFD
            );

            const myChart8 = new Chart(
                document.getElementById('diagramaMotivosPD'),
                configMotivosPD
            );

            const myChart9 = new Chart(
                document.getElementById('diagramaMotivosCCTV'),
                configMotivosCCTV
            );
        </script>



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