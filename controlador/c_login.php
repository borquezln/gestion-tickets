<?php


require('../modelo/m_consultas.php');

$user = $_POST['user'];
$password = $_POST['password'];

$co = new Consultas();

if ($co->autenticarUsuario($user, $password)) {
    switch ($co->verificarTipoUsuario($user)) {
        case 1:
            session_start();
            $_SESSION['username'] = $user;
            $_SESSION['rol'] = $co->verificarTipoUsuario($user);
            $_SESSION['nombreApellido'] = $co->mostrarDatosUsuario($user);
            $_SESSION['dni'] = $co->listarDniUserActual($user);
            $_SESSION['time'] = time();
            $co->verificarUltimoAcceso($user);
            header('Location: ../vista/inicio.php');
            break;
        case 2:
            session_start();
            $_SESSION['username'] = $user;
            $_SESSION['dni'] = $co->listarDniUserActual($user);
            $_SESSION['rol'] = $co->verificarTipoUsuario($user);
            $_SESSION['nombreApellido'] = $co->mostrarDatosUsuario($user);

            $totalAreasAgente = $co->verificarTotalAreasAgente($user);
            $_SESSION['cantAreas'] = $totalAreasAgente;

            if ($totalAreasAgente == 1) {
                $_SESSION['areaUsuario'] = $co->verificarAreaUsuario($user);
                $_SESSION['areaUsuarioNombre'] = $co->verificarNombreAreaUsuario($user);
            } else if ($totalAreasAgente == 2){
                $listAreas = $co->listarNombreAreaUsuario($_SESSION['dni']);
                $nombreAreas = '';
                foreach ($listAreas as $area) {
                    $codigoArea .= $area[0];
                    $nombreAreas .= $area[1] . '<br>';
                }
                $_SESSION['areaUsuario'] = $codigoArea[0];
                $_SESSION['areaUsuario2'] = $codigoArea[1];
                $_SESSION['areaUsuarioNombre'] = $nombreAreas;
            } else if ($totalAreasAgente == 3){
                $listAreas = $co->listarNombreAreaUsuario($_SESSION['dni']);
                $nombreAreas = '';
                foreach($listAreas as $area){
                    $codigoArea .= $area[0];
                    $nombreAreas .= $area[1] . '<br>';
                }

                $_SESSION['areaUsuario'] = $codigoArea[0];
                $_SESSION['areaUsuario2'] = $codigoArea[1];
                $_SESSION['areaUsuario3'] = $codigoArea[2];
                $_SESSION['areaUsuarioNombre'] = $nombreAreas;
            }
            $_SESSION['time'] = time();

            $co->verificarUltimoAcceso($user);

            
            header('Location: ../vistaAgente/inicio.php');
            break;
        case 3:
            session_start();
            $_SESSION['username'] = $user;
            $_SESSION['rol'] = $co->verificarTipoUsuario($user);
            $_SESSION['dni'] = $co->listarDniUserActual($user);
            $_SESSION['nombreApellido'] = $co->mostrarDatosUsuario($user);
            $_SESSION['time'] = time();

            $co->verificarUltimoAcceso($user);

            header('Location: ../vistaAgente/inicio.php');
            break;
        case 4:
            session_start();
            $_SESSION['username'] = $user;
            $_SESSION['dni'] = $co->listarDniUserActual($user);
            $_SESSION['rol'] = $co->verificarTipoUsuario($user);
            $_SESSION['nombreApellido'] = $co->mostrarDatosUsuario($user);
            $_SESSION['areaUsuario'] = $co->verificarAreaUsuario($user);
            $_SESSION['areaUsuarioNombre'] = $co->verificarNombreAreaUsuario($user);
            $_SESSION['time'] = time();

            $co->verificarUltimoAcceso($user);

            header('Location: ../vistaAgente/inicio.php');
            break;
        default:
            header('Location: ../vista/login.php');
            break;
    }
} else {
    session_start();
    $_SESSION['errLogin'] = true;
    header('Location: ../vista/login.php');
}
