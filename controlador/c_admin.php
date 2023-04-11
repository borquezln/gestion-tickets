<?php
class ControladorAdmin
{

    public function verEstadisticasContr($time, $fechaInicio, $fechaFin)
    {
        echo ('<title>Estadísticas</title>');
        require('../modelo/m_estadisticas.php');
        $co = new ConsultasEstadisticas();

        if ($time == 'now') {
            $totalTareas = $co->contarTareasActual();
            $totalPendientes = $co->contarTotalPendientesActual();
            $totalEnProgreso = $co->contarTotalEnProgresoActual();
            $totalCompletas = $co->contarTotalCompletasActual();
            $totalCanceladas = $co->contarTotalCanceladasActual();
            $totalEliminadas = $co->contarTotalEliminadasActual();

            $totalRedes = $co->contarTotalRedesActual();
            $totalInfraestrucutra = $co->contarTotalInfraestructuraActual();
            $totalSTecnico = $co->contarTotalSTecnicoActual();
            $totalRequerimientos = $co->contarTotalRequerimientosActual();
            $totalFDigital = $co->contarTotalFDigitalActual();
            $totalPDigital = $co->contarTotalPDigitalActual();
            $totalCctv = $co->contarTotalCCTVActual();

            $totalMotivosRedes = $co->totalMotivosRedesActual();
            $totalMotivosInfr = $co->totalMotivosInfraestructuraActual();
            $totalMotivosSTecnico = $co->totalMotivosSTecnicoActual();
            $totalMotivosRequerimientos = $co->totalMotivosRequerimientosActual();
            $totalMotivosFDigital = $co->totalMotivosFDigitalActual();
            $totalMotivosPDigital = $co->totalMotivosPDigitalActual();
            $totalMotivosCCTV = $co->totalMotivosCCTVActual();
        } else if ($time == 'month') {
            $totalTareas = $co->contarTareasxFechas($fechaInicio, $fechaFin);
            $totalPendientes = $co->contarTotalPendientesxFechas($fechaInicio, $fechaFin);
            $totalEnProgreso = $co->contarTotalEnProgresoxFechas($fechaInicio, $fechaFin);
            $totalCompletas = $co->contarTotalCompletasxFechas($fechaInicio, $fechaFin);
            $totalCanceladas = $co->contarTotalCanceladasxFechas($fechaInicio, $fechaFin);
            $totalEliminadas = $co->contarTotalEliminadasxFechas($fechaInicio, $fechaFin);

            $totalRedes = $co->contarTotalRedesxFechas($fechaInicio, $fechaFin);
            $totalInfraestrucutra = $co->contarTotalInfraestructuraxFechas($fechaInicio, $fechaFin);
            $totalSTecnico = $co->contarTotalSTecnicoxFechas($fechaInicio, $fechaFin);
            $totalRequerimientos = $co->contarTotalRequerimientosxFechas($fechaInicio, $fechaFin);
            $totalFDigital = $co->contarTotalFDigitalxFechas($fechaInicio, $fechaFin);
            $totalPDigital = $co->contarTotalPDigitalxFechas($fechaInicio, $fechaFin);
            $totalCctv = $co->contarTotalCCTVxFechas($fechaInicio, $fechaFin);

            $totalMotivosRedes = $co->totalMotivosRedesxFechas($fechaInicio, $fechaFin);
            $totalMotivosInfr = $co->totalMotivosInfraestructuraxFechas($fechaInicio, $fechaFin);
            $totalMotivosSTecnico = $co->totalMotivosSTecnicoxFechas($fechaInicio, $fechaFin);
            $totalMotivosRequerimientos = $co->totalMotivosRequerimientosxFechas($fechaInicio, $fechaFin);
            $totalMotivosFDigital = $co->totalMotivosFDigitalxFechas($fechaInicio, $fechaFin);
            $totalMotivosPDigital = $co->totalMotivosPDigitalxFechas($fechaInicio, $fechaFin);
            $totalMotivosCCTV = $co->totalMotivosCCTVxFechas($fechaInicio, $fechaFin);
        } else if ($time == 'year') {
            $totalTareas = $co->contarTareasxAnio();
            $totalPendientes = $co->contarTotalPendientesxAnio();
            $totalEnProgreso = $co->contarTotalEnProgresoxAnio();
            $totalCompletas = $co->contarTotalCompletasxAnio();
            $totalCanceladas = $co->contarTotalCanceladasxAnio();
            $totalEliminadas = $co->contarTotalEliminadasxAnio();

            $totalRedes = $co->contarTotalRedesxAnio();
            $totalInfraestrucutra = $co->contarTotalInfraestructuraxAnio();
            $totalSTecnico = $co->contarTotalSTecnicoxAnio();
            $totalRequerimientos = $co->contarTotalRequerimientosxAnio();
            $totalFDigital = $co->contarTotalFDigitalxAnio();
            $totalPDigital = $co->contarTotalPDigitalxAnio();
            $totalCctv = $co->contarTotalCCTVxAnio();

            $totalMotivosRedes = $co->totalMotivosRedesxAnio();
            $totalMotivosInfr = $co->totalMotivosInfraestructuraxAnio();
            $totalMotivosSTecnico = $co->totalMotivosSTecnicoxAnio();
            $totalMotivosRequerimientos = $co->totalMotivosRequerimientosxAnio();
            $totalMotivosFDigital = $co->totalMotivosFDigitalxAnio();
            $totalMotivosPDigital = $co->totalMotivosPDigitalxAnio();
            $totalMotivosCCTV = $co->totalMotivosCCTVxAnio();
        } else if ($time == 'all') {
            $totalTareas = $co->contarTareasTotal();
            $totalPendientes = $co->contarTotalPendientesTotal();
            $totalEnProgreso = $co->contarTotalEnProgresoTotal();
            $totalCompletas = $co->contarTotalCompletasTotal();
            $totalCanceladas = $co->contarTotalCanceladasTotal();
            $totalEliminadas = $co->contarTotalEliminadasTotal();

            $totalRedes = $co->contarTotalRedesTotal();
            $totalInfraestrucutra = $co->contarTotalInfraestructuraTotal();
            $totalSTecnico = $co->contarTotalSTecnicoTotal();
            $totalRequerimientos = $co->contarTotalRequerimientosTotal();
            $totalFDigital = $co->contarTotalFDigitalTotal();
            $totalPDigital = $co->contarTotalPDigitalTotal();
            $totalCctv = $co->contarTotalCCTVTotal();

            $totalMotivosRedes = $co->totalMotivosRedesTotal();
            $totalMotivosInfr = $co->totalMotivosInfraestructuraTotal();
            $totalMotivosSTecnico = $co->totalMotivosSTecnicoTotal();
            $totalMotivosRequerimientos = $co->totalMotivosRequerimientosTotal();
            $totalMotivosFDigital = $co->totalMotivosFDigitalTotal();
            $totalMotivosPDigital = $co->totalMotivosPDigitalTotal();
            $totalMotivosCCTV = $co->totalMotivosCCTVTotal();
        }

        require('libreriaEstilos.php');
        require('headerNav.php');
        require('estadisticas.php');
    }

    public function verEstadisticasAgenteContr($dni)
    {
        echo ('<title>Estadísticas - Gestión de tareas Sistemas</title>');
        require('../modelo/m_estadisticas.php');
        require('../modelo/m_consultas.php');
        $estadistica = new ConsultasEstadisticas();
        $co = new Consultas();
        $listAgente = $co->listarUserActual($dni);
        $areaAgente = $co->listarNombreAreaUsuario($dni);
        $totalEstadoTareas = $estadistica->totalEstadoTareaAgente($dni);
        $listEstadosTareas = $estadistica->listarEstadoTareaAgente($dni);
        $listMotivosTareas = $estadistica->listarMotivosAgente($dni);
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('estadisticasAgente.php');
    }

    public function listarTareasEncargadoContr($listado)
    {
        echo ('<title>Listado de Tareas - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listAreas = $co->listarAreas();
        $listMotivos = $co->listarMotivosProblemas($listado);
        $listTareasEncargados = $co->listarTareasEncargados($listado);

        if ($listado == 'completadas') {
            $tareasEncargadosCompletasActual = $co->listarTareasEncargadosCompletosActual();
        }

        $listDirecciones = $co->listarDirecciones();

        if ($listado == 'actual') {
            $estado = 'Pendientes y En Progreso';
        } else if ($listado == 'completadas') {
            $estado = 'Completadas';
        } else if ($listado == 'canceladas') {
            $estado = 'Canceladas';
        }
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listaTareas.php');
    }

    public function listarTareasAgenteContr($listado)
    {
        //listado = estadoTarea
        echo ('<title>Listado de Tareas - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();

        if ($listado == 'actual') {
            $estado = 'Pendiente y en Progreso';
            $listTareasAgentes = $co->listarTareasAgentes($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3'], $listado);
        } else if ($listado == 'completas') {
            $estado = 'Completadas';
            $tareasCompletasActual = $co->listarTareasAgentesCompletosActual($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3']);
            $listTareasAgentes = $co->listarTareasAgentes($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3'], $listado);
        } else if ($listado == 'canceladas') {
            $estado = 'Canceladas';
            $listTareasAgentes = $co->listarTareasAgentes($_SESSION['areaUsuario'], $_SESSION['areaUsuario2'], $_SESSION['areaUsuario3'], $listado);
        } else{
            header("location:javascript:history.go(-1)");
        }

        $listMotivos = $co->listarMotivosProblemasUsuario($_SESSION['dni']);
        $listDirecciones = $co->listarDirecciones();
        $listAgentes = $co->listarAgentes();
        $areaUsuario = $co->listarNombreAreaUsuario($_SESSION['dni']);
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listaTareas.php');
    }

    public function listarTareasAdminContr($lista, $areaSupervisor)
    {
        echo ('<title>Listado de Tareas - Gestión Requerimientos</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listDatosAgentes = $co->listarAgentes();
        //Comprobar si esta en un Área el usuario, sino es Admin
        if (isset($_SESSION['areaUsuario'])) {
            if ($_SESSION['areaUsuario'] == $areaSupervisor) {
                if ($lista == 'actual') {
                    $listTareasAgentes = $co->listarTareasAgentes($areaSupervisor, '', '', $lista);
                    $estado = "Pendientes y en Progreso";
                } else if ($lista == 'completas') {
                    $estado = "Completadas";
                    $listTareasAgentes = $co->listarTareasAgentes($areaSupervisor, '', '', $lista);
                    $listTareasCompletasActual = $co->listarTareasAgentesCompletosActual($areaSupervisor, '', '');
                } else if ($lista == 'canceladas') {
                    $listTareasAgentes = $co->listarTareasAgentes($areaSupervisor, '', '', $lista);
                    $estado = "Canceladas";
                } else {
                    header("location:javascript:history.go(-1)");
                }
            } else {
                header("location:javascript:history.go(-1)");
            }
        } else {
            if ($lista == 'actual') {
                $estado = "Pendientes y en Progreso";
                $listTareasAgentes = $co->listarTareasAdmin($lista);
            } else if ($lista == 'completas') {
                $estado = "Completadas";
                $listTareasAgentes = $co->listarTareasAdmin($lista);
                $listTareasCompletasActual = $co->listarTareasCompletasActual();
            } else if ($lista == 'canceladas') {
                $estado = "Canceladas";
                $listTareasAgentes = $co->listarTareasAdmin($lista);
            } else {
                header("location:javascript:history.go(-1)");
            }
        }

        $listMotivos = $co->listarMotivosProblemasUsuario($_SESSION['dni']);
        $listDirecciones = $co->listarDirecciones();
        $listAgentes = $co->listarAgentes();
        $listAreas = $co->listarAreas();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listarTareasAdmin.php');
    }

    public function listarTareasEliminadasContr()
    {
        echo ('<title>Listado de Tareas Eliminadas - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listTareasEliminadas = $co->listarTareasEliminadas();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listaTareasEliminadas.php');
    }

    public function listarAgentesContr()
    {
        echo ('<title>Listado de Agentes - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listEncAgentes = $co->listarEncargadosAgentes();
        $listAreas = $co->listarAreas();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listaAgentes.php');
    }

    public function listarMotivosReqContr()
    {
        echo ('<title>Listado de Agentes - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listMotivosReq = $co->listarMotivosReq();
        $listAreas = $co->listarAreas();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listaMotivos.php');
    }

    public function listarTareaAgenteContr($dni)
    {
        echo ('<title>Tareas de Agente - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listTareaAgente = $co->listarTareaAgente($dni);
        $listEstados = $co->listarEstadoTarea();
        $agente = $co->listarUserActual($dni);
        $areaUsuario = $co->listarNombreAreaUsuario($dni);
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listarTareaAgente.php');
    }

    public function listarDireccionesContr()
    {
        echo ('<title>Listado de Direcciones - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listDirecciones = $co->listarDirecciones();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listaDirecciones.php');
    }


    public function listarUsuariosContr()
    {
        echo ('<title>Lista de Usuarios - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listUsuarios = $co->listarUsuarios();
        $listRoles = $co->listarRoles();
        $listAreas = $co->listarAreas();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('cambioRoles.php');
    }

    public function listarUsuariosBajaContr()
    {
        echo ('<title>Lista de Usuarios de baja - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listBajas = $co->listarBajasUsuarios();
        $listRoles = $co->listarRoles();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('listarUsuariosBaja.php');
    }

    public function listarUsuariosCargadosContr()
    {
        echo ('<title>Lista de Usuarios cargados - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listUsuarios = $co->listarUsuariosCargados();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('usuariosCargados.php');
    }

    public function pageBlanquearPassContr()
    {
        echo ('<title>Blanquear Contraseña - Gestión de tareas Sistemas</title>');
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        $listUsuarios = $co->listarUsuarios();
        require('libreriaEstilos.php');
        require('headerNav.php');
        require('blanqueoPass.php');
    }
}
