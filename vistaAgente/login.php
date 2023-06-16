<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Gestion de Tareas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            box-sizing: 0;
        }

        body {
            /* fallback for old browsers */
            background-color: #e6ece8;
        }

        h4 {
            color: white;
        }

        .contenedor {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        nav {
            position: absolute;
            background-color: #5a3377;
            color: white;
            width: 100%;
            padding: 10px;
        }


        form {
            background-color: #343a40;
            border-radius: 20px;
            padding: 30px 20px;
        }

        p {
            color: white;
        }

        #btn {
            display: flex;
            justify-content: center;
        }

        button {
            background-color: transparent;
            padding: 5px 20px;
            border: 2px solid white;
            color: white;
            border-radius: 5px;
            transition: 0.1s all;
        }

        button:active {
            background-color: #6610f2;
            border: 2px solid #6610f2;
            box-shadow: 0 0 0 1px #3F11CB;
        }
    </style>
</head>

<body>
    <nav class="">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Gestión de Tareas</span>
        </div>
    </nav>
    <div class="contenedor">

        <form action="../controlador/c_login.php" method="post">
            <h4>Acceder</h4>
            <p class="fs-6">Ingrese sus credenciales para acceder</p>

            <?php
            error_reporting(0);
            session_start();
            if (isset($_SESSION['errLogin'])) {
            ?>
                <div class="alert alert-danger" role="alert">
                    Datos Erróneos. Ingrese nuevamente
                </div>
            <?php
                unset($_SESSION['errLogin']);
            }

            if (isset($_SESSION['session_caducada'])) {
            ?>

                <div class="alert alert-warning" role="alert">
                    Sesión caducada.
                    <br>
                    Iniciar sesión nuevamente.
                </div>

            <?php
                unset($_SESSION['session_caducada']);
            }
            ?>

            <div class="form-floating mb-3">
                <input type="text" name="user" class="form-control" id="floatingInput" placeholder="Usuario">
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Contraseña">
                <label for="floatingPassword">Contraseña</label>
            </div>
            <div id="btn">
                <button type="submit">Acceder</button>
            </div>
        </form>

    </div>
</body>

</html>