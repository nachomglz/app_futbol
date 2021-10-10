<?php 
function connect() {
    $db = mysqli_connect('localhost', 'root', 'root', 'app_futbol');
    if (!$db) {
        echo 'NO se ha podido conectar con la base de datos';
    } 
    return $db;
}





?>