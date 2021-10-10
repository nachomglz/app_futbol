<?php 
   include 'includes/templates/header.php';
   require 'includes/app.php';
   $db = connect();

   // Obtener las posiciones de los jugadores
   $query = "SELECT * FROM positions";
   $resultado = mysqli_query($db, $query);

   // Al hacer submit al formulario
   if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      // echo 'se ha hecho un envio de formulario';
      echo '<pre>';
      var_dump($_POST);
      echo '</pre>';



      $name = mysqli_real_escape_string( $db, $_POST['name'] );
      $surname = mysqli_real_escape_string( $db, $_POST['surname'] );
      $email = mysqli_real_escape_string( $db, $_POST['email'] );
      $phone = mysqli_real_escape_string( $db, $_POST['phone'] );
      $birthdate = mysqli_real_escape_string( $db, $_POST['birthdate'] );
      $weight = (int)mysqli_real_escape_string( $db, $_POST['weight'] );
      $height = (int)mysqli_real_escape_string( $db, $_POST['height'] );
      $agency = mysqli_real_escape_string( $db, $_POST['agency'] );
      $position = (int)mysqli_real_escape_string( $db, $_POST['position'] );
      $lateralidad = mysqli_real_escape_string( $db, $_POST['lateralidad'] );
      $country = mysqli_real_escape_string( $db, $_POST['country'] );
      $city = mysqli_real_escape_string( $db, $_POST['city'] );

      // Asignar imagen hacia una variable
      $image = $_FILES['image'];

      if (!$name) {
         $errores[] = 'No se ha introducido un nombre';
      }
      if (!$surname) {
         $errores[] = 'No se ha introducido un apellido';
      }
      if (!$email) {
         $errores[] = 'No se ha introducido un email';
      }
      if (!$phone) {
         $errores[] = 'No se ha introducido un teléfono';
      }
      if (!$birthdate) {
         $errores[] = 'No se ha introducido una fecha';
      }
      if (!$weight) {
         $errores[] = 'No se ha introducido el peso';
      }
      if (!$height) {
         $errores[] = 'No se ha introducido la altura';
      }
      if (!$agency) {
         $errores[] = 'No se ha introducido una agencia';
      }
      if (!$position) {
         $errores[] = 'No se ha introducido la posicion';
      }
      if (!$country) {
         $errores[] = 'No se ha introducido un país';
      }
      if (!$city) {
         $errores[] = 'No se ha introducido una ciudad';
      }
      if (!$lateralidad) {
         $errores[] = 'No se ha introducido lateralidad';
      }

      // Validar tamaño de imagen (max->2mb)
      $medida = 2000 * 2000;

      if ($image['size'] > $medida) {
         $errores[] = 'La imagen es demasiado grande, el límite son 2MB';
      }
      

      if( empty( $errores ) ) {
         /**SUBIR LOS DATOS**/

         //Crear carpeta de imagenes
         $carpetaImagenes = './imagenes/';
         if ( !is_dir( $carpetaImagenes ) ) {
            mkdir( $carpetaImagenes );
         }

         //Generar un nombre para las imagenes
         $nombre_imagen = md5( uniqid( rand(), true ) ) . ".jpg";

         //Subir imagenes
         move_uploaded_file($image['tmp_name'], $carpetaImagenes . $nombre_imagen);

         //Query para insertar los datos
         $query = "INSERT INTO player (name, surname, email, phone, birthdate, weight, height, country, city, image, agency, position, predeleted, preselected, lateralidad) VALUES ('$name', '$surname', '$email', '$phone', '$birthdate', $weight, $height, '$country', '$city', '$nombre_imagen', '$agency', $position, false, false, '$lateralidad')";

         $resultado = mysqli_query($db, $query) or die(mysqli_error($db));

         echo $resultado;

         if ($resultado) {
            //Redireccionar al usuario
            header('Location: index.php?resultado=1');
         } else {
            header('Location: index.php?resultado=2');
         }

      }

   }

?>

   <div class="contenedor contenedor-formulario contenedor-formulario-register">
      <h2>Register</h2>
      <form id="register-form" action="register.php" method="post" class="formulario formulario-register" autocomplete="off" enctype="multipart/form-data">

         <div class="field name-surname-field">
            <div class="name-field">
               <input type="text" name="name" id="name" placeholder="Name">
               <p class="incorrect-field">Introduce un nombre correcto</p>
            </div>
            <div class="surname-field">
               <input type="text" name="surname" id="surname" placeholder="Surname">
               <p class="incorrect-field">Introduce un apellido correcto</p>
            </div>
         </div>

         <div class="field mail-phone-field">
            <div class="mail-field">
               <input type="email" name="email" id="email" placeholder="Email">
               <p class="incorrect-field">Introduce un email correcto</p>
            </div>
            <div class="phone-field">
               <input type="text" name="phone" id="phone" placeholder="Phone Number">
               <p class="incorrect-field">Introduce un teléfono correcto</p>
            </div>
         </div>

         <div class="field birthdate-image-field">
            <div class="field birthdate-field">
               <label for="birthdate">Birthdate</label>
               <input name="birthdate" type="date" id="birthdate" class="birthdate" min="1900-12-31">
               <p class="incorrect-field">Introduce una fecha de nacimiento correcta</p>
            </div>
            <div class="field image-field">
               <label for="image">Selecciona una imagen actual</label>
               <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png">
            </div>

         </div>

         <div class="field weight-height-field">
            <div class="weight-field">
               <input type="number" name="weight" id="weight" placeholder="Weight" step="0.01" max="130.00">
               <p class="incorrect-field">Introduce un peso correcto</p>
            </div>
            <div class="height-field">
               <input type="number" name="height" id="height" placeholder="Height" step="0.01" max="2.40">
               <p class="incorrect-field">Introduce una altura correcta</p>
            </div>
         </div>

         <div class="field agency-lateralidad-field">
            <div class="field agency-field">
               <input type="text" name="agency" id="agency" placeholder="Agency">
               <p class="incorrect-field">Introduce una agencia correcta</p>
            </div>
            <div class="field lateralidad-field">
               <select name="lateralidad" id="lateralidad">
                  <option value="" disabled selected>-- Lateralidad --</option>
                  <option value="Zurdo">Zurdo</option>
                  <option value="Diestro">Diestro</option>
                  <option value="Ambidextro">Ambidextro</option>
               </select>
            </div>
         </div>
         
         <div class="field position-field">
            <select name="position" id="position">
               <option disabled selected value="">-- Position --</option>
               <?php while($position = mysqli_fetch_assoc($resultado)): ?>
                  <option value="<?php echo $position['id'] ?>"><?php echo $position['name'] ?></option>
               <?php endwhile; ?>
            </select>
            <p class="incorrect-field">Selecciona una posicion de la lista</p>
         </div>

         <div class="field country-city-field">
            <div class="country-field">
               <select name="country" id="country">
                  <option disabled selected value="">-- Country --</option>
               </select>
               <p class="incorrect-field">Selecciona un país de la lista</p>
            </div>
         
            <div class="city-field">
               <select name="city" id="city">
                  <option disabled selected value="">-- City --</option>
               </select>
               <p class="incorrect-field">Selecciona una ciudad de la lista</p>
            </div>
         </div>

         <!-- <div class="field image-field">
            <label for="image" class="boton boton-azul">Select Image</label>
            <input type="file" name="image" id="image" style="visibility: hidden;" accept=".jpg,.jpeg,.png">
            <p class="filename" ></p>
            <p class="incorrect-field">Selecciona una imagen de tu galería</p>
         </div> -->
         


         <input type="submit" value="Register" class="boton boton-azul">
      </form>

   </div>

   <script src="build/js/register.js">  </script>

   <?php 
        include 'includes/templates/footer.php';