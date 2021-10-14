<?php
include '../../includes/templates/header_properties.php';

require "../../includes/app.php";
$auth = autenticated();
if (!$auth) {
    header('Location: /');
}

// Conectar con la base de datos
$db = connect();

//Obtener jugadores pre-eliminados
$query = "SELECT * FROM player where predeleted = true";
$resultado = mysqli_query($db, $query);

//Confirmar delete / recuperar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $op = $_POST['op'];
    $op = filter_var($op, FILTER_VALIDATE_INT);

    if ($op === 1) {
        // Eliminar jugadores definitivamente
        if ($id) {
            $query = "DELETE FROM player where id = ${id}";
            $r = mysqli_query($db, $query);
            if ($r) {
                header('Location: /admin/properties/pre-delete.php');
            }
        }
    } else if ($op === 2) {
        // Recuperar jugadores
        if ($id) {
            $query = "UPDATE player SET predeleted = false WHERE id = ${id}";
            $r = mysqli_query($db, $query);
            if ($r) {
                header('Location: /admin/properties/pre-delete.php');
            }
        }
    }
}
?>

<div class="contenedor players">


</div> <!-- .players -->




<?php
include '../../includes/templates/footer_properties.php';
