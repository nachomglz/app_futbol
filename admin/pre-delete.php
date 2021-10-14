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


    <script src="/build/js/pre-delete.js"></script>
    <script src="/build/js/header.js"></script>
</body>
</html>