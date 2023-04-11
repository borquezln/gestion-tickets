<?php
require('../../modelo/m_conexionPage.php');
$link = conexion();

$codigoArea = $_POST['codigoArea'];

$sql = "SELECT u.dni, concat(u.nombre, ' ', u.apellido) from usuario u, areas a, usuario_area ua  
        where u.dni = ua.usuario_dni2 and ua.codigo_area2 = a.codigo and a.codigo = '$codigoArea'";

$result = mysqli_query($link, $sql);

$html = '<option value="" selected>Seleccione...</option>';

while ($row = mysqli_fetch_row($result)) {
    $html .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
}
echo $html;
mysqli_close($link);
