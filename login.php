<?php
include 'includes/templates/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $auth = false;
  $rec_username = $_POST['username'];
  $rec_password = $_POST['password'];

  if ($rec_username === 'correo@correo.com' && $rec_password === '123456') {
    session_start();

    $_SESSION['usuario'] = $rec_username;
    $_SESSION['login'] = true;
    header('Location: admin/index.php');
  } else {
    $_SESSION['login'] = false;
  }
}
?>
<div class="contenedor contenedor-formulario contenedor-formulario-login">
  <h2>Login</h2>
  <form action="login.php" method="POST" class="formulario formulario-login" autocomplete="off">
    <div class="field user-field">
      <input type="text" name="username" id="username" placeholder="Username">
    </div>
    <div class="field password-field">
      <input type="password" name="password" id="password" placeholder="Password">
    </div>
    <input type="submit" value="Login" class="boton boton-azul">
  </form>
</div>

<script src="build/js/login.js"> </script>

<?php
include 'includes/templates/footer.php';
