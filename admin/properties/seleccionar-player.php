<?php
   require dirname(dirname(__DIR__)) . '/includes/app.php';
   
   $db = connect();

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($_POST['id'])) {
         echo json_encode(array("success" => false, "error" => "No se ha recibido ningun parametro en la peticion ajax"));
      } else {
         $query = "UPDATE player SET preselected = true WHERE id = {$_POST['id']}";
         if (!$db) {
            echo json_encode(array("success" => false, "error" => "Ha ocurrido un error al conectar con la base de datos, inténtalo mas tarde"));
         } else {
            $resultado = mysqli_query($db, $query);
            if (!$resultado) {
               echo json_encode(array("success" => false, "seleccionado" => false, "msg" => "Ha ocurrido un error ejecutando la seleccion, intentalo mas tarde"));
            } else {
               echo json_encode(array("success" => true, "descartado" => true));
            }
         }
         
      }
   }