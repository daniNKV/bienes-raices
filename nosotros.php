<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');
    

?>
    
    <main class="contenedor seccion">
        <h1>Conocé más sobre nosotros!</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpeg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Foto de un living">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui sapiente praesentium pariatur laboriosam dolorum corrupti aliquid deleniti, nobis vel dolorem eius debitis incidunt facere alias cumque, unde, aperiam atque. Corporis labore explicabo cumque facere amet obcaecati aperiam! Voluptas nobis explicabo delectus quisquam obcaecati. Pariatur ullam, enim saepe doloremque qui sapiente.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil ab quidem corporis impedit autem ratione eos vitae quis molestiae obcaecati!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Nos Caracteriza:</h1>
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

    </section>


    <?php incluirTemplate('footer'); ?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>