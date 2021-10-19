<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');
    

?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <form class="form">
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email:</label>
                <input type="email" placeholder="Su email" id="email">
                
                <label for="password">password:</label>
                <input type="password" placeholder="Su contraseña" id="password">
                
            </fieldset>

            <input type="submit" class="boton boton-verde-block" value="Iniciar Sesión">

        </form>
    </main>

    <?php incluirTemplate('footer'); ?>

