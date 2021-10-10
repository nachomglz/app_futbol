<?php
    require 'includes/app.php';
    $db = connect();

    $query = "SELECT * FROM paises";

    $resultado = mysqli_query($db, $query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($resultado)) {
        $data[] = $row;
    }

    echo json_encode($data);


