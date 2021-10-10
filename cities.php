<?php 
    require 'includes/app.php';
    $db = connect();

    $country_code = $_GET['country_code'];
    $query = "SELECT * FROM Ciudades WHERE Paises_Codigo = '${country_code}'";

    $resultado = mysqli_query($db, $query);
    
    $data = array();

    while($row = mysqli_fetch_assoc($resultado)) {
        $data[] = mb_convert_encoding($row, 'UTF-8', 'UTF-8');
    }
    
    echo json_encode($data);