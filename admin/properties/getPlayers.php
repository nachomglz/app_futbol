<?php 
   // Get app database connections and functions
   require dirname(dirname(__DIR__)) . '/includes/app.php';

   if (!isset($_SESSION)) {
      session_start();
   }
   $auth = $_SESSION['login'] ?? false;
   if (!$auth) {
      header('Location: /');
   }

   // Create database instance
   $db = connect();

   // Write query for database

   if (isset($_GET['query'])) {
      $query = $_GET['query'];
   } else {
      $query = "SELECT * FROM player WHERE preselected = false AND predeleted = false";
   }

   // Execute query
   $resultado = mysqli_query($db, $query);
?>

<?php while($player = mysqli_fetch_assoc($resultado)): ?>

<div class="player" data-id="<?php echo $player['id']; ?>">
   <div class="more-info-button">
         <a href="player.php?id="<?php echo $player['id']; ?>">
            <i class="fas fa-info-circle"></i>
         </a>
   </div>
   <div class="circular-image-wrapper" style="background-image: url('/imagenes/<?php echo $player['image']; ?>');">
         <!-- <img class="player-image" src="../imagenes/${player.image}" alt="player image"> -->
   </div>
   <div class="name-info">
         <p class="name"><?php echo ucwords(strtolower($player['name'])); ?></p>
         <p class="surname"><?php echo ucwords(strtolower($player['surname'])); ?></p>
   </div>
   <div class="measure-info">
         <p class="height"> <i class="fas fa-male"></i> <?php echo $player['height'] . ' m'; ?></p>
         <p class="weight"> <i class="fas fa-weight"></i> <?php echo $player['weight'] . ' kg'; ?></p>
   </div>
   <div class="lateralidad-info">
         <p class="lateralidad"><i class="fas fa-shoe-prints"></i>
            <?php echo $player['lateralidad'] ? $player['lateralidad'] : 'Desconocido' ?>
         </p>
   </div>
   <div class="descartar-seleccionar">
         <form method="post">
            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
            <input type="hidden" name="op" value="1">
            <button type="submit" class="btn-descartar" >Descartar</button>
         </form>
         <form method="post">
            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
            <input type="hidden" name="op" value="2">
            <button type="submit" class="btn-seleccionar" >Seleccionar</button>
         </form>
   </div>
</div> <!-- .player -->

<?php endwhile; ?>

<!-- 
   Idea basica para los filtros

if (isset(filtros[])) {
   $query = $query . ' where '
} 
-->