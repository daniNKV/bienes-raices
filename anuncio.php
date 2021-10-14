<?php include 'includes/templates/header.php'; ?>
    
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al Bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="Casa frente al bosque" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">Precio: $3.000.000</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius aut deleniti, blanditiis vel ullam, labore distinctio voluptate quo officiis molestias dicta, veniam consequuntur iste quaerat expedita. Ipsa repellendus ipsum velit adipisci blanditiis. Dignissimos, vitae, fugiat possimus repudiandae velit distinctio at corporis quo sapiente, iste sunt dolore saepe harum. Neque vero aliquam, incidunt repellendus laborum provident id vel labore similique! Cupiditate esse mollitia possimus ipsam molestiae quibusdam unde quae iste perspiciatis velit voluptatum facere, consequuntur repellat id quo at, enim minima illo et molestias amet? Est obcaecati et non dolorem suscipit. Ducimus dolor inventore doloribus cupiditate harum exercitationem accusamus id ut?
            </p>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, soluta? Veniam laboriosam vero neque eum porro commodi, sint magni necessitatibus eius ipsam incidunt, fuga soluta voluptatem temporibus assumenda dolore, totam iusto consequatur aliquam dolores saepe. Doloribus assumenda, deleniti tempora, consequatur placeat, animi commodi non est iste velit impedit labore ex!
            </p>
        </div>
    </main>


    <footer class="footer seccion">
        <div class="contenedor contenido-footer">
            <nav class="navbar">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados &copy;</p>

    </footer>
    <script src="build/js/bundle.min.js"></script>
</body>
</html>