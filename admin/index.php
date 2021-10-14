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

<div class="contenedor opciones-admin">
   <a class="boton boton-rojo" href="/admin/properties/pre-delete.php">Descartados</a>
   <a class="boton boton-verde" href="/admin/properties/pre-select.php">Seleccion</a>
</div>

<div class="contenedor filter-wrapper">

   <div class="filtros">
      <select name="height-filter" class="filter" id="height-filter">
         <option disabled selected value="">Altura</option>
         <option value="1.50">1.50 m</option>
         <option value="1.60">1.60 m</option>
         <option value="1.70">1.70 m</option>
         <option value="1.80">1.80 m</option>
         <option value="1.90">1.90 m</option>
         <option value="2.00">2.00 m</option>
         <option value="2.10">2.10 m</option>
      </select>
      <select name="weight-filter" class="filter" id="weight-filter">
         <option disabled selected value="">Peso</option>
         <option value="50">50 kg</option>
         <option value="60">60 kg</option>
         <option value="70">70 kg</option>
         <option value="80">80 kg</option>
         <option value="90">90 kg</option>
         <option value="100">100 kg</option>
      </select>
      <select name="age-filter" class="filter" id="age-filter">
         <option disabled selected value="">Edad</option>
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
      <select name="country-filter" class="filter" id="country-filter">
         <option disabled selected value="">Pais</option>
      </select>
      <select name="position-filter" class="filter" id="position-filter">
         <option disabled selected value="">Posicion</option>
      </select>
      <select name="lateralidad-filter" class="filter" id="lateralidad-filter">
         <option disabled selected value="">Lateralidad</option>
         <option value="Zurdo">Zurdo</option>
         <option value="Diestro">Diestro</option>
         <option value="Ambidextro">Ambidextro</option>
      </select>

   </div>
   <div class="funciones-filtros">
      <select name="filter-order" id="filter-order">
         <option value="asc">Desde el mas antiguo</option>
         <option value="desc">Desde el mas nuevo</option>
      </select>
      <button id="filter-submit" class="boton boton-naranja">Aplicar Filtros</button>
   </div>


</div>

<div class="contenedor players">
   
</div> <!-- .players -->

<script src="../build/js/admin.js"></script>

<?php

include dirname(__DIR__) . '/includes/templates/footer_admin.php';
