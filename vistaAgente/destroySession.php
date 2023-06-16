<?php session_destroy(); ?>

<!DOCTYPE html>
<html>

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