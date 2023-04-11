<?php
require_once('../modelo/m_conexion.php');

class ConsultasEstadisticas extends Conexion
{
    public function contarTareasActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT COUNT(*) FROM tareas t where t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $cantTareas = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $cantTareas;
    }

    public function contarTotalPendientesActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Pendiente' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalTareasPendientes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasPendientes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasPendientes;
    }

    public function contarTotalEnProgresoActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'En progreso' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalTareasEnProgreso = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEnProgreso[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEnProgreso;
    }

    public function contarTotalCompletasActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Completo' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalTareasCompletas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCompletas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCompletas;
    }

    public function contarTotalCanceladasActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Cancelado' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalTareasCanceladas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCanceladas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCanceladas;
    }

    public function contarTotalEliminadasActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Eliminado' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalTareasEliminadas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEliminadas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEliminadas;
    }

    //TOTAL POR AREAS------------------------------------------
    public function contarTotalRedesActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '1' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRedes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRedes;
    }

    public function contarTotalInfraestructuraActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '2' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalInfraestructura = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalInfraestructura[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalInfraestructura;
    }

    public function contarTotalSTecnicoActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '3' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalSTecnico[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalSTecnico;
    }

    public function contarTotalRequerimientosActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '4' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRequerimientos[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRequerimientos;
    }

    public function contarTotalFDigitalActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '5' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalFDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalFDigital;
    }

    public function contarTotalPDigitalActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '6' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalPDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalPDigital;
    }

    public function contarTotalCCTVActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '7' and t.fechaCreada = curdate()";
            $result = mysqli_query($link, $sql);
            $totalCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalCCTV[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalCCTV;
    }


    //Motivos---------------------------------------------------------------------------------------

    public function totalMotivosRedesActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 1 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRedes[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRedes;
    }

    public function totalMotivosInfraestructuraActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 2 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosInfr = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosInfr[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosInfr;
    }

    public function totalMotivosSTecnicoActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 3 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosSTecnico[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosSTecnico;
    }

    public function totalMotivosRequerimientosActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 4 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRequerimientos[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRequerimientos;
    }

    public function totalMotivosFDigitalActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 5 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosFDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosFDigital;
    }

    public function totalMotivosPDigitalActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 6 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosPDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosPDigital;
    }

    public function totalMotivosCCTVActual()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 7 and t.fechaCreada = curdate() group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosCCTV[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosCCTV;
    }

    //--------------------POR MES-----------------------------
    public function contarTareasxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT COUNT(*) FROM tareas t where t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $cantTareas = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $cantTareas;
    }

    public function contarTotalPendientesxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e 
                    where t.estadoTarea_id = e.id and e.nombre = 'Pendiente' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalTareasPendientes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasPendientes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasPendientes;
    }

    public function contarTotalEnProgresoxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e 
                    where t.estadoTarea_id = e.id and e.nombre = 'En Progreso' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalTareasEnProgreso = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEnProgreso[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEnProgreso;
    }

    public function contarTotalCompletasxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e 
                    where t.estadoTarea_id = e.id and e.nombre = 'Completo' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalTareasCompletas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCompletas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCompletas;
    }

    public function contarTotalCanceladasxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e 
                    where t.estadoTarea_id = e.id and e.nombre = 'Cancelado' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalTareasCanceladas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCanceladas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCanceladas;
    }

    public function contarTotalEliminadasxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e 
                    where t.estadoTarea_id = e.id and e.nombre = 'Eliminado' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalTareasEliminadas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEliminadas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEliminadas;
    }

    //TOTAL POR AREAS------------------------------------------
    public function contarTotalRedesxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '1' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRedes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRedes;
    }

    public function contarTotalInfraestructuraxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '2' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalInfraestructura = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalInfraestructura[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalInfraestructura;
    }

    public function contarTotalSTecnicoxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '3' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalSTecnico[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalSTecnico;
    }

    public function contarTotalRequerimientosxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '4' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRequerimientos[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRequerimientos;
    }

    public function contarTotalFDigitalxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '5' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalFDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalFDigital;
    }

    public function contarTotalPDigitalxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '6' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalPDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalPDigital;
    }

    public function contarTotalCCTVxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '7' and t.fechaCreada between '$inicio' and '$fin'";
            $result = mysqli_query($link, $sql);
            $totalCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalCCTV[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalCCTV;
    }


    //Motivos---------------------------------------------------------------------------------------

    public function totalMotivosRedesxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 1 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRedes[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRedes;
    }

    public function totalMotivosInfraestructuraxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 2 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosInfr = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosInfr[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosInfr;
    }

    public function totalMotivosSTecnicoxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 3 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosSTecnico[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosSTecnico;
    }

    public function totalMotivosRequerimientosxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 4 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRequerimientos[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRequerimientos;
    }

    public function totalMotivosFDigitalxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 5 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosFDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosFDigital;
    }

    public function totalMotivosPDigitalxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 6 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosPDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosPDigital;
    }

    public function totalMotivosCCTVxFechas($inicio, $fin)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 7 
                    and t.fechaCreada between '$inicio' and '$fin' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosCCTV[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosCCTV;
    }

    //Por Año-----------------------------------------------------------------

    public function contarTareasxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT COUNT(*), t.fechaCreada FROM tareas t 
                    where year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $cantTareas = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $cantTareas;
    }

    public function contarTotalPendientesxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e 
                    where t.estadoTarea_id = e.id and e.nombre = 'Pendiente' and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalTareasPendientes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasPendientes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasPendientes;
    }

    public function contarTotalEnProgresoxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'En Progreso' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalTareasEnProgreso = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEnProgreso[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEnProgreso;
    }

    public function contarTotalCompletasxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Completo' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalTareasCompletas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCompletas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCompletas;
    }

    public function contarTotalCanceladasxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Cancelado' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalTareasCanceladas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCanceladas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCanceladas;
    }

    public function contarTotalEliminadasxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Eliminado' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalTareasEliminadas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEliminadas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEliminadas;
    }

    //TOTAL POR AREAS------------------------------------------
    public function contarTotalRedesxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '1' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRedes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRedes;
    }

    public function contarTotalInfraestructuraxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '2' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalInfraestructura = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalInfraestructura[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalInfraestructura;
    }

    public function contarTotalSTecnicoxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '3' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalSTecnico[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalSTecnico;
    }

    public function contarTotalRequerimientosxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '4' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRequerimientos[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRequerimientos;
    }

    public function contarTotalFDigitalxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '5' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalFDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalFDigital;
    }

    public function contarTotalPDigitalxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '6' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalPDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalPDigital;
    }

    public function contarTotalCCTVxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a 
                    where t.codigoArea3 = a.codigo and a.codigo = '7' 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2)";
            $result = mysqli_query($link, $sql);
            $totalCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalCCTV[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalCCTV;
    }


    //Motivos---------------------------------------------------------------------------------------

    public function totalMotivosRedesxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 1 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRedes[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRedes;
    }

    public function totalMotivosInfraestructuraxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 2 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosInfr = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosInfr[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosInfr;
    }

    public function totalMotivosSTecnicoxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 3 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosSTecnico[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosSTecnico;
    }

    public function totalMotivosRequerimientosxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 4 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRequerimientos[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRequerimientos;
    }

    public function totalMotivosFDigitalxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 5 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosFDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosFDigital;
    }

    public function totalMotivosPDigitalxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 6 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosPDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosPDigital;
    }

    public function totalMotivosCCTVxAnio()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 7 
                    and year(t.fechaCreada) = (select max(year(t2.fechaCreada)) from tareas t2) group by m.motivos ";
            $result = mysqli_query($link, $sql);
            $motivosCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosCCTV[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosCCTV;
    }


    //TOTAL-------------------------------------------------------------------------------------

    public function contarTareasTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT COUNT(*) FROM tareas t";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $cantTareas = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $cantTareas;
    }

    public function contarTotalPendientesTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Pendiente'";
            $result = mysqli_query($link, $sql);
            $totalTareasPendientes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasPendientes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasPendientes;
    }

    public function contarTotalEnProgresoTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'En progreso'";
            $result = mysqli_query($link, $sql);
            $totalTareasEnProgreso = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEnProgreso[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEnProgreso;
    }

    public function contarTotalCompletasTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Completo'";
            $result = mysqli_query($link, $sql);
            $totalTareasCompletas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCompletas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCompletas;
    }

    public function contarTotalCanceladasTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Cancelado'";
            $result = mysqli_query($link, $sql);
            $totalTareasCanceladas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasCanceladas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasCanceladas;
    }

    public function contarTotalEliminadasTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e where t.estadoTarea_id = e.id and e.nombre = 'Eliminado'";
            $result = mysqli_query($link, $sql);
            $totalTareasEliminadas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalTareasEliminadas[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalTareasEliminadas;
    }

    //TOTAL POR AREAS------------------------------------------
    public function contarTotalRedesTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '1'";
            $result = mysqli_query($link, $sql);
            $totalRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRedes[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRedes;
    }

    public function contarTotalInfraestructuraTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '2'";
            $result = mysqli_query($link, $sql);
            $totalInfraestructura = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalInfraestructura[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalInfraestructura;
    }

    public function contarTotalSTecnicoTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '3'";
            $result = mysqli_query($link, $sql);
            $totalSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalSTecnico[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalSTecnico;
    }

    public function contarTotalRequerimientosTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '4'";
            $result = mysqli_query($link, $sql);
            $totalRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalRequerimientos[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalRequerimientos;
    }

    public function contarTotalFDigitalTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '5'";
            $result = mysqli_query($link, $sql);
            $totalFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalFDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalFDigital;
    }

    public function contarTotalPDigitalTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '6'";
            $result = mysqli_query($link, $sql);
            $totalPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalPDigital[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalPDigital;
    }

    public function contarTotalCCTVTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), a.nombre from tareas t, areas a where t.codigoArea3 = a.codigo and a.codigo = '7'";
            $result = mysqli_query($link, $sql);
            $totalCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $totalCCTV[$i] = $row;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $totalCCTV;
    }


    //Motivos---------------------------------------------------------------------------------------

    public function totalMotivosRedesTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 1 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosRedes = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRedes[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRedes;
    }

    public function totalMotivosInfraestructuraTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 2 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosInfr = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosInfr[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosInfr;
    }

    public function totalMotivosSTecnicoTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 3 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosSTecnico = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosSTecnico[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosSTecnico;
    }

    public function totalMotivosRequerimientosTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 4 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosRequerimientos = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosRequerimientos[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosRequerimientos;
    }

    public function totalMotivosFDigitalTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 5 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosFDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosFDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosFDigital;
    }

    public function totalMotivosPDigitalTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 6 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosPDigital = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosPDigital[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosPDigital;
    }

    public function totalMotivosCCTVTotal()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(t.nroArreglo), m.motivos from tareas t, motivos m, areas a 
                    where t.id_motivos = m.id and t.codigoArea3 = a.codigo and a.codigo = 7 group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosCCTV = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosCCTV[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosCCTV;
    }


    //ESTADISTICAS AGENTE-----------------------------------------------------------
    public function totalEstadoTareaAgente($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*) from tareas t, estadotarea e, usuario u  
                    where t.estadoTarea_id = e.id and t.usuario_dni = u.dni and u.dni = '$dni'";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $estadoTareasTotal = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $estadoTareasTotal;
    }

    public function listarEstadoTareaAgente($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e, usuario u  
                    where t.estadoTarea_id = e.id and t.usuario_dni = u.dni and u.dni = '$dni' group by e.nombre";
            $result = mysqli_query($link, $sql);
            $estadoTareas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $estadoTareas[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $estadoTareas;
    }

    public function totalMotivosAgente($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*) from tareas t, estadotarea e, usuario u  
                    where t.estadoTarea_id = e.id and t.usuario_dni = u.dni and u.dni = '$dni'";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $estadoTareasTotal = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $estadoTareasTotal;
    }

    public function listarMotivosAgente($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), m.motivos from tareas t, motivos m, usuario u
                    where t.id_motivos = m.id and t.usuario_dni = u.dni and u.dni = '$dni' group by m.motivos";
            $result = mysqli_query($link, $sql);
            $motivosTareas = [];
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $motivosTareas[$i] = $row;
                $i++;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $motivosTareas;
    }
}

/* select count(*), e.nombre from tareas t, estadotarea e, usuario u  
where t.estadoTarea_id = e.id and t.usuario_dni = u.dni and u.dni = 2000000 group by e.nombre 

select count(*), m.motivos from tareas t, motivos m, usuario u
where t.id_motivos = m.id and t.usuario_dni = u.dni and u.dni = 2000000 group by m.motivos  */
