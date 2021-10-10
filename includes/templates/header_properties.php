<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ab8fba2479.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/build/css/style.css">
</head>

<body class="bg-light-grey">

    <header class="header bg-blue">
        <div class="contenido-header contenedor">
            <a href="/index.php" class="logo-header">
                <img src="/build/img/logo_blanco.png" alt="logo betobe">
            </a>
            <nav class="navegacion-principal">
                <a href="/register.php">Registro</a>
                <a href="/login.php">Login</a>
            </nav>

            <div class="menu-btn" id="menu-btn">
                <div class="menu-btn__burger"></div>
            </div>
        </div>
    </header>

    <nav class="navegacion-movil">
        <a href="/register.php">Registro</a>
        <a href="/login.php">Login</a>
        <a href="#">Información</a>
    </nav>

    <div class="goto-admin contenedor boton boton-verde">
        <a href="/admin">
            <i class="fas fa-home"></i> Volver a Admin
        </a>
    </div>