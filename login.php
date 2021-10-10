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
      <label class="placeholder placeholder-username">Username</label>
      <input autocomplete="false" type="text" name="username" id="username">
    </div>
    <div class="field password-field">
      <label class="placeholder placeholder-password">Password</label>
      <input autocomplete="false" type="password" name="password" id="password">
    </div>
    <input type="submit" value="Login" class="boton boton-azul">
  </form>
</div>

<script src="build/js/login.js"> </script>

<?php
include 'includes/templates/footer.php';
