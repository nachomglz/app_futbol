<?php
    require 'includes/app.php';
    include 'includes/templates/header.php';
?>

<h1 style="text-align: center;color:white;font-size:3rem;">Pagina Principal</h1>

<?php if (isset($_GET['resultado'])) : ?>
    <?php if ($_GET['resultado'] == 1) :   ?>
        <div class="contenedor message success-message">
            Se han insertado los datos con éxito, nos pondremos en contacto!
        </div>
    <?php endif; ?>
    <?php if ($_GET['resultado'] == 2) :   ?>
        <div class="contenedor message fail-message">
            Ha ocurrido un error en el registro, por favor inténtelo de nuevo
        </div>
    <?php endif; ?>

<?php endif; ?>


<script src="build/js/success_message.js"></script>

<?php
include 'includes/templates/footer.php';
