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


    //ESTADISTICAS AGENTE-----------------------------------------------------------
    public function totalEstadoTareaAgente($legajo)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*) from tareas t, estadotarea e, usuario u  
                    where t.estadoTarea_id = e.id and t.usuario_legajo = u.legajo and u.legajo = '$legajo'";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $estadoTareasTotal = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $estadoTareasTotal;
    }

    public function listarEstadoTareaAgente($legajo)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*), e.nombre from tareas t, estadotarea e, usuario u  
                    where t.estadoTarea_id = e.id and t.usuario_legajo = u.legajo and u.legajo = '$legajo' group by e.nombre";
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

    public function totalTareasAgente($legajo)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*) from tareas t, estadotarea e, usuario u  
                    where t.estadoTarea_id = e.id and t.usuario_legajo = u.legajo and u.legajo = '$legajo'";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_row($result)) {
                $estadoTareasTotal = $row[0];
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $estadoTareasTotal;
    }
}