<?php include 'includes/templates/header.php'; ?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Terraza">
        </picture>

        <h2>Llene el Formulario de Contacto</h2>

        <form class="form">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Su nombre" id="nombre">
                
                <label for="email">Nombre:</label>
                <input type="email" placeholder="Su email" id="email">
                
                <label for="telefono">Nombre:</label>
                <input type="tel" placeholder="Su teléfono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o Compra:</label>
                <select id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="comprar">Comprar</option>
                    <option value="vender">Vender</option>
                </select>

                <label for="presupuesto">Precio o Presupesto</label>
                <input type="number" placeholder="Su Precio o Presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <p>Elija cómo desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                    
                    <label for="contactar-email">Email</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligió teléfono, elija la fecha y hora</p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>


    <?php include 'includes/templates/footer.php'; ?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>