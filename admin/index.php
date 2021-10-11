<?php
include dirname(__DIR__) . '\includes\templates\header_admin.php';
require dirname(__DIR__) . '\includes\app.php';

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

<!-- <div class="contenedor opciones-admin">
   <a class="boton boton-rojo" href="/admin/properties/pre-delete.php">Pre-eliminados</a>
   <a class="boton boton-verde" href="/admin/properties/pre-select.php">Pre-seleccionados</a>
</div> -->

<div class="contenedor filter-wrapper">
   <select name="height-filter" id="height-filter">
      <option disabled selected>Altura</option>
      <option value="1.50">1.50 m</option>
      <option value="1.60">1.60 m</option>
      <option value="1.70">1.70 m</option>
      <option value="1.80">1.80 m</option>
      <option value="1.90">1.90 m</option>
      <option value="2.00">2.00 m</option>
      <option value="2.10">2.10 m</option>
   </select>
   <select name="weight-filter" id="weight-filter">
      <option disabled selected>Peso</option>
      <option value="50">50 kg</option>
      <option value="60">60 kg</option>
      <option value="70">70 kg</option>
      <option value="80">80 kg</option>
      <option value="90">90 kg</option>
      <option value="100">100 kg</option>
   </select>
   <select name="age-filter" id="age-filter">
      <option disabled selected>Edad</option>
      <option value="16">16 años</option>
      <option value="17">17 años</option>
      <option value="18">18 años</option>
      <option value="19">19 años</option>
      <option value="20">20 años</option>
      <option value="21">21 años</option>
      <option value="22">22 años</option>
      <option value="23">23 años</option>
      <option value="24">24 años</option>
      <option value="25">25 años</option>
      <option value="26">> 25 años</option>
   </select>
   <select name="country-filter" id="country-filter">
      <option disabled selected>Pais</option>
   </select>
   <select name="position-filter" id="position-filter">
      <option disabled selected>Posicion</option>
   </select>
   <select name="lateralidad-filter" id="lateralidad-filter">
      <option disabled selected>Lateralidad</option>
      <option value="Zurdo">Zurdo</option>
      <option value="Diestro">Diestro</option>
      <option value="Ambidextro">Ambidextro</option>
   </select>




</div>

<div class="contenedor players">


   <?php while ($player = mysqli_fetch_assoc($resultado)) : ?>
      <div class="player" data-id="<?php echo $player['id'] ?>">

         <div class="more-info-button">
            <a href="player.php?id=<?php echo $player['id'] ?>">
               <i class="fas fa-info-circle"></i>
            </a>
         </div>

         <div class="circular-image-wrapper" style="background-image: url('/imagenes/<?php echo $player['image']; ?>');">
            <!-- <img class="player-image" src="../imagenes/<?php echo $player['image'] ?>" alt="player image"> -->
         </div>
         <div class="name-info">
            <p class="name"><?php echo ucwords(strtolower($player['name'])) ?></p>
            <p class="surname"><?php echo ucwords(strtolower($player['surname'])) ?></p>
         </div>
         <div class="measure-info">
            <p class="height"> <i class="fas fa-male"></i> <?php echo $player['height'] . ' m' ?></p>
            <p class="weight"> <i class="fas fa-weight"></i> <?php echo $player['weight'] . ' kg' ?></p>
         </div>
         <div class="lateralidad-info">
            <p class="lateralidad"><i class="fas fa-shoe-prints"></i> <?php echo isset($player['lateralidad']) ? $player['lateralidad'] : 'Desconocido'; ?></p>
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
include dirname(__DIR__) . '/includes/templates/footer_admin.php';
