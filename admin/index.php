<?php
  include '../includes/templates/header_admin.php';
  require "../includes/app.php";
  
  if (!isset($_SESSION)) {
    session_start();
  }
  $auth = $_SESSION['login'] ?? false;
  if (!$auth) {
    header('Location: /');
  }

  // Conectar con la base de datos
  $db = connect();

  // Escribir query a la base de datos
  $query = "SELECT * FROM player WHERE preselected = false AND predeleted = false";

  // Realizar la consulta a la base de datos
  $resultado = mysqli_query($db, $query);

  // Pre-eliminar / Pre-seleccionar
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $op = $_POST['op'];
    $op = filter_var($op, FILTER_VALIDATE_INT);

    if ($op === 1) {
      // Marcar los jugadores como pre-eliminados
      if ($id) {
        $query = "UPDATE player SET predeleted = true where id = ${id}";
        $r = mysqli_query($db, $query);
        if ($r) {
          header('Location: /admin');
        }
      }
    } else if ($op === 2) {
      // Marcar los jugadores como pre-seleccionados
      if ($id) {
        $query = "UPDATE player SET preselected = true WHERE id = ${id}";
        $r = mysqli_query($db, $query);
        if ($r) {
          header('Location: /admin');
        }
      }
    }
  }

?>

<div class="contenedor opciones-admin">
  <a class="boton boton-rojo" href="/admin/properties/pre-delete.php">Pre-eliminados</a>
  <a class="boton boton-verde" href="/admin/properties/pre-select.php">Pre-seleccionados</a>
</div>

<div class="contenedor filter-wrapper">
  hola
</div>

<div class="contenedor players">


  <?php while ($player = mysqli_fetch_assoc($resultado)) : ?>
    <div class="player" data-id="<?php echo $player['id'] ?>">

      <div class="more-info-button">
        <a href="player.php?id=<?php echo $player['id'] ?>">
          <i class="fas fa-info-circle"></i>
        </a>
      </div>

      <div 
        class="circular-image-wrapper"
        style="background-image: url('/imagenes/<?php echo $player['image']; ?>');">
        <!-- <img class="player-image" src="../imagenes/<?php echo $player['image'] ?>" alt="player image"> -->
      </div>
      <div class="name-info">
        <p class="name"><?php echo ucwords( strtolower($player['name']) ) ?></p>
        <p class="surname"><?php echo ucwords( strtolower($player['surname']) ) ?></p>
      </div>
      <div class="measure-info">
        <p class="height"> <i class="fas fa-male"></i> <?php echo $player['height'] . ' m' ?></p>
        <p class="weight"> <i class="fas fa-weight"></i> <?php echo $player['weight'] . ' kg' ?></p>
      </div>
      <div class="lateralidad-info">
        <p class="lateralidad"><i class="fas fa-shoe-prints"></i> <?php echo isset( $player['lateralidad'] ) ? $player['lateralidad'] : 'Desconocido'; ?></p>
      </div>
      <div class="descartar-seleccionar">
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
          <input type="hidden" name="op" value="1">
          <button type="submit" class="btn-descartar">Descartar</button>
        </form>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
          <input type="hidden" name="op" value="2">
          <button type="submit" class="btn-seleccionar">Seleccionar</button>
        </form>
      </div>
    </div> <!-- .player -->
  <?php endwhile; ?>

</div> <!-- .players -->

<script src="../build/js/admin.js"></script>

<?php
include '../includes/templates/footer_admin.php';
