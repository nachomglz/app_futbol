<?php
include dirname(__DIR__) . '/includes/templates/header.php';
require dirname(__DIR__) . "/includes/app.php";


if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
if (!$auth) {
   header('Location: /');
}

// Conectar con la base de datos
$db = connect();

//Obtener jugadores pre-eliminados
$query = "SELECT * FROM player where preselected = true";
$resultado = mysqli_query($db, $query);


// Confirmar delete / recuperar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $id = $_POST['id'];
   $id = filter_var($id, FILTER_VALIDATE_INT);
   $op = $_POST['op'];
   $op = filter_var($op, FILTER_VALIDATE_INT);

   if ($op === 1) {
      // Recuperar jugador
      if ($id) {
         $query = "UPDATE player SET preselected = false WHERE id = ${id}";
         $r = mysqli_query($db, $query);
         if ($r) {
            // Recargar datos
            header('Location: /admin/properties/pre-select.php');
         }
      }
   } else if ($op === 2) {
      //Confirmar seleccion

   }
}

?>

<div class="contenedor players">

</div> <!-- .players -->


   <script src="/build/js/pre-select.js"></script>
   <script src="/build/js/header.js"></script>
</body>
</html>