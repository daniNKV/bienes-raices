<?php 
    
    // Importar Conexión
    require 'includes/config/database.php';
    $db = conectarDB();
    
    // Consulta
    $query = "SELECT * FROM propiedades LIMIT ${limit}";

    // Resultados
    $resultado = mysqli_query($db, $query);



?>
        <div class="contenedor-anuncios">
            <?php while ($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio">
                <picture>
                    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Una casa frente al lago">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa de Lujo en el Lago</h3>
                    <p>Casa frente al lago con una excelente vista, acabados de lujo a un excelente precio</p>
                    <p class="precio"><?php echo $propiedad['precio']; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono estacionamiento">
                            <p><?php echo $propiedad['estacionamiento']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo-block">
                        Ver Propiedad
                    </a>
                    
                </div><!--.Contenido-Anuncio-->
            </div><!--.Anuncio-->
        </div> <!--.Contenedor Anuncios-->

        <?php endwhile ?>

<?php 
        //Cerrar Conexión

?>