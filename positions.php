<?php 
include __DIR__ . '/includes/app.php';
$db = connect();

$query = "SELECT * FROM positions";
$resultado = mysqli_query($db, $query);
$data = array();
if ($resultado) {
   while($position = mysqli_fetch_assoc($resultado)) {
      $data[] = $position;
   }
}

echo json_encode($data);

