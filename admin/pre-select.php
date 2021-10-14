<?php
include '../../includes/templates/header_properties.php';

require "../../includes/app.php";
$auth = autenticated();
if (!$auth) {
   header('Location: /');
}

// echo '<pre>';    
// var_dump($_POST);
// echo '</pre>';    
// die();

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




<?php
include '../../includes/templates/footer_properties.php';
