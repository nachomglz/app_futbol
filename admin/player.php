<?php
    include dirname(__DIR__) . '/includes/templates/header.php';
    require dirname(__DIR__) . '/includes/app.php';


    if (!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;

    if (!$auth) {
        header('Location: /');
    }

    $player_id = intval( $_GET['id'] );

    //Importar conexion a BD
    $db = connect();

    //Escribir query
    $query = "SELECT * FROM player WHERE id = ${player_id}";

    //Ejecutar query y obtener resultados
    $resultado = mysqli_query($db, $query);
    $player = mysqli_fetch_assoc($resultado);
?>

    <div class="contenedor player-info">
        <img src="../imagenes/<?php echo $player['image'];?>" alt="player image" >
        
        <div class="detailed-info">
            <h2>Detailed Info</h2>
            <div class="detailed-info__field detailed-info__name">
                <i class="fas fa-user fa-lg"></i>
                <p class="detailed-info__name-name"><?php echo $player['name']; ?></p>
                <p class="detailed-info__name-surname"><?php echo $player['surname']; ?></p>
            </div>
            <div class="detailed-info__field detailed-info__email">
                <i class="fas fa-envelope fa-lg"></i>
                <p><?php echo $player['email']; ?></p>
            </div>
            <div class="detailed-info__field detailed-info__phone-number">
                <i class="fas fa-phone fa-lg"></i>
                <p><?php echo $player['phone']; ?></p>
            </div>
            <div class="detailed-info__field detailed-info__birthdate">
                <i class="fas fa-birthday-cake fa-lg"></i>
                <p><?php echo $player['birthdate']; ?></p>
            </div>
            <div class="detailed-info__field detailed-info__height">
                <i class="fas fa-ruler-vertical fa-lg"></i>
                <p><?php echo $player['height']; ?></p>
            </div>
            <div class="detailed-info__field detailed-info__weight">
                <i class="fas fa-weight fa-lg"></i>
                <p><?php echo $player['weight']; ?></p>
            </div>
            <div class="detailed-info__field detailed-info__location">
                <i class="fas fa-map-marker-alt fa-lg"></i>
                <p class="detailed-info__location-city"><?php echo $player['city']; ?>, </p>
                <p class="detailed-info__location-country"><?php echo $player['country']; ?></p>
            </div>


        </div> <!-- .detailed-info -->
    </div> <!-- .player-info -->

   <script src="/build/js/header.js"></script>
</body>
</html>