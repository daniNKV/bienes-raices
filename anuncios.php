<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');
    

?>
    
    <main class="contenedor seccion">
        <h2>Casas y Departamentos en Venta</h2>
 
        <?php 
            $limit = 20;
            include 'includes/templates/anuncios.php'
        ?>

    </main>

    <?php incluirTemplate('footer'); ?>


