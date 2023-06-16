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
            <title>Estadísticas - Gestión</title>
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
                </div>

            </section>
        </body>

        <script>
            //Total Estados
            const labels = [
                <?php
                foreach ($totalPendientes as $pendiente) {
                    echo "'" . $pendiente[1] . "',";
                }
                
                foreach ($totalEnProgreso as $progreso) {
                    echo "'" . $progreso[1] . "', ";
                }
                
                foreach ($totalCompletas as $completas) {
                    echo "'" . $completas[1] . "', ";
                }
                
                foreach ($totalCanceladas as $canceladas) {
                    echo "'" . $canceladas[1] . "', ";
                }
                
                foreach ($totalEliminadas as $eliminadas) {
                    echo "'" . $eliminadas[1] . "', ";
                }
                ?>
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Total de requerimientos',
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
                        
                        foreach ($totalEnProgreso as $progreso) {
                            echo $progreso[0] . ", ";
                        }
                        
                        foreach ($totalCompletas as $completas) {
                            echo $completas[0] . ", ";
                        }
                        
                        foreach ($totalCanceladas as $canceladas) {
                            echo $canceladas[0] . ", ";
                        }
                        
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
                            text: 'Total de requerimientos: <?= $totalTareas; ?>'
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
                
                foreach ($totalInfraestrucutra as $infr) {
                    echo "'" . $infr[1] . "', ";
                }
                
                foreach ($totalSTecnico as $stecnico) {
                    echo "'" . $stecnico[1] . "', ";
                }
                
                foreach ($totalRequerimientos as $requerimientos) {
                    echo "'" . $requerimientos[1] . "', ";
                }
                
                foreach ($totalFDigital as $fdigital) {
                    echo "'" . $fdigital[1] . "', ";
                }
                
                foreach ($totalPDigital as $pdigital) {
                    echo "'" . $pdigital[1] . "', ";
                }
                
                foreach ($totalCctv as $cctv) {
                    echo "'" . $cctv[1] . "', ";
                }
                ?>
            ];

            const dataTotalxAreas = {
                labels: labelsTotalxAreas,
                datasets: [{
                    label: 'Total de requerimientos',
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
                        
                        foreach ($totalInfraestrucutra as $infr) {
                            echo $infr[0] . ", ";
                        }
                        
                        foreach ($totalSTecnico as $stecnico) {
                            echo $stecnico[0] . ", ";
                        }
                        
                        foreach ($totalRequerimientos as $requerimientos) {
                            echo $requerimientos[0] . ", ";
                        }
                        
                        foreach ($totalFDigital as $fdigital) {
                            echo $fdigital[0] . ", ";
                        }
                        
                        foreach ($totalPDigital as $pdigital) {
                            echo $pdigital[0] . ", ";
                        }
                        
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
                            text: 'Total de requerimientos por Áreas'
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'center',
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
        </script>

        </html>
<?php
    }
} else {
    require "destroySession.php";
}
?>