<?php
require('../../modelo/m_conexionPage.php');
$link = conexion();

$codigoArea = $_POST['codigoArea'];

$sql = "SELECT m.id, m.motivos from motivos m where m.codigoArea in (select a.codigo from areas a where a.codigo = '$codigoArea')";
$result = mysqli_query($link, $sql);

if ($codigoArea == '') {
    $html = '<option value="" selected>Seleccione primero el Área</option>';
} else {
    $html = '<option value="" selected>Seleccione...</option>';
}


while ($row = mysqli_fetch_row($result)) {
    $html .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
}

echo $html;
