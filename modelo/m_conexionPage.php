<?php
function conexion()
{
    $link = mysqli_connect('localhost','root','','gestion','3306');
    $link->set_charset("utf8");
    return $link;
}
