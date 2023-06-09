<?php
session_start();
include('conexion.php');

$correo = !empty($_POST['correo']) ? $_POST['correo'] : null;
$passwd = !empty($_POST['contrasena']) ? $_POST['contrasena'] : null;

$_SESSION['correo'] = $correo;

$consulta = "SELECT usuario FROM registro WHERE email = '$correo' and password = '$passwd'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $tipo_usuario = $row['usuario'];

    if ($tipo_usuario == 'administrador') {
        header("Location: ../html/menu_principal.html");
        exit();
    } elseif ($tipo_usuario == 'logistica') {
        header("Location: ../html/logistica_main.html");
        exit();
    } else {
        echo "Tipo de usuario desconocido";
    }
} else {
    sleep(2);
    ?>

    <html>
    <head>
        <title>Formulario de inicio de sesión</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Darumadrop+One&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
                background-color: #03052e;
                color: #E0E0E0;
            }

            .main_login {
                text-align: center;
                align-items: center;
                padding: 170px;
            }

            button {
                color: #E0E0E0;
                display: inline-block;
                border-radius: 3px;
                background-color: #1a7fc1;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 15px;
                padding: 10px;
                width: 380px;
                cursor: pointer;
                margin: 0.4px;
            }

            .main_left {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
        </style>
    </head>
    <body>
        <div class="main_left">
            <div class="main_login">
                <h1>Error en el inicio de sesión</h1>
                <br>
                <p>[Revisar credenciales de acceso]</p>
                <br>
                <div class="botoncentro">
                    <button onclick="window.location.href='../html/iniciosesion.html'">Regresar</button>
                </div>
            </div>
        </div>
    </body>
    </html>

    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>