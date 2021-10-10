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

    <?php while ($player = mysqli_fetch_assoc($resultado)) : ?>
        <div class="player">

            <div class="option-menu">
                <a href="#"><span>Editar</span><i class="fas fa-pencil-alt"></i></a>
                <a href="#"><span>Eliminar</span><i class="fas fa-trash"></i></a>

                <a href="../player.php?id=<?php echo $player['id'] ?>"><span>Más información</span><i class="fas fa-info"></i></a>
            </div>

            <div class="circular-image-wrapper">
                <img class="player-image" src="../../imagenes/<?php echo $player['image'] ?>" alt="player image">
            </div>
            <div class="name-info">
                <p class="name"><?php echo $player['name'] ?></p>
                <p class="surname"><?php echo $player['surname'] ?></p>
            </div>
            <div class="measure-info">
                <p class="height"> <i class="fas fa-weight"></i> <?php echo $player['height'] ?></p>
                <p class="weight"> <i class="fas fa-male"></i> <?php echo $player['weight'] ?></p>
            </div>
            <div class="descartar-seleccionar">
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                    <input type="hidden" name="op" value="2">
                    <button class="boton boton-verde">Recuperar</button>
                </form>

                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                    <input type="hidden" name="op" value="1">
                    <button class="boton boton-rojo">Confirmar</button>
                </form>

            </div>
        </div> <!-- .player -->

    <?php endwhile; ?>

</div> <!-- .players -->




<?php
include '../../includes/templates/footer_properties.php';
