<?php 
    $activePage = basename($_SERVER['PHP_SELF'], ".php"); 

    if (!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://kit.fontawesome.com/ab8fba2479.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="/build/css/style.css">
</head>
<body class="bg-light-grey">

    <header class="header bg-blue">
        <div class="contenido-header contenedor">
            <a href="/index.php" class="logo-header">
                <img id="logo" src="/build/img/logo_blanco.png" alt="logo betobe">
            </a>

            <nav class="navegacion-principal">
                
                <?php if($auth): ?>
                    
                    <a 
                        href="/admin/index.php" 
                        class="<?php echo $_SERVER['PHP_SELF'] === '/admin/index.php' ? 'activePage' : ''; ?>">Admin
                
                    </a>
                    <a 
                        href="/admin/pre-delete.php" 
                        class="<?php echo $activePage === 'pre-delete' ? 'activePage' : ''; ?>">Descartados
                
                    </a>
                    <a 
                        href="/admin/pre-select.php" 
                        class="<?php echo $activePage === 'pre-select' ? 'activePage' : ''; ?>">Seleccionados
                
                    </a>
                    <a 
                        href="/cerrar-sesion.php" 
                        class="close-session">Cerrar Sesion
                
                    </a>
                <?php else: ?>
                    <a 
                    href="/register.php" 
                    class="<?php echo $activePage === 'register' ? 'activePage' : ''; ?>">Registro
            
                    </a>
                    <a 
                        href="/login.php" 
                        class="<?php echo $activePage === 'login' ? 'activePage' : ''; ?>">Login
                
                    </a>
                <?php endif; ?>



            </nav>

            <div class="menu-btn" id="menu-btn">
                <div class="menu-btn__burger"></div>
            </div>
        </div>

    </header>

    <nav class="navegacion-movil">
        <a href="/register.php">Registro</a>
        <a href="/login.php" class="">Login</a>
    </nav>