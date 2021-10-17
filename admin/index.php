<?php 
    $resultado = $_GET['resultado'] ?? null;
    /*
    echo "<pre>";
    var_dump($_GET["resultado"]);
    echo "</pre>";
    */
    require '../includes/funciones.php';
    
    incluirTemplate('header');
    

?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
    
    <?php if(intval($resultado) == 200): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>
    </main>

    <?php incluirTemplate('footer'); ?>

