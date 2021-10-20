<?php 
    require 'includes/funciones.php';
    

    incluirTemplate('header', $inicio = true);
    

?>
    
    
    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono de Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt recusandae ratione distinctio nemo labore quaerat odit a eos quo nesciunt.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono de Seguridad" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt recusandae ratione distinctio nemo labore quaerat odit a eos quo nesciunt.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono de Seguridad" loading="lazy">
                <h3>Rapidez</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt recusandae ratione distinctio nemo labore quaerat odit a eos quo nesciunt.</p>
            </div>
        </div>

    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
            <?php 
                $limit = 3;
                include 'includes/templates/anuncios.php'
            ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">
                Ver Todas
            </a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contáctenos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpeg" type="image/jpeg">
                        <img src="build/img/blog1.jpg" alt="Imagen de blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2020</span> por: <span>Admin</span></p>
                        <p>Consejos para construir la terraza que siempre soñaste, con los mejores materiales y al menor precio.</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpeg" type="image/jpeg">
                        <img src="build/img/blog2.jpg" alt="Imagen de blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Maximiza el espacio en tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2020</span> por: <span>Admin</span></p>
                        <p>Aprovecha al máximo el espacio de tu hogar con esta práctica guía, aprede a combinar muebles y colores para darle vida a tu espacio.</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y fue muy difícil decidirme entre las casas disponibles.
                </blockquote>
                <p>- Daniel Nikiforov</p>
            </div>
        </section>

    </div> <!-- seccion-inferior -->
    
    <?php incluirTemplate('footer'); ?>

