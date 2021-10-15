<?php 

//BASE DE DATOS

    require '../../includes/config/database.php';
    $db = conectarDB();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
    }
    require '../../includes/funciones.php';
    
    incluirTemplate('header');
    

?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <form class="form" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la Propiedad">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad">
                
                <label for="imagen">Imagenes:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion" >Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9">
               
                <label for="wc">Habitaciones:</label>
                <input type="number" id="wc" placeholder="Ej: 3" min="1" max="9">
                
                <label for="estacionamiento">Habitaciones:</label>
                <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="99">
            </fieldset>

            <fieldset>
                <legend>Vendedor/es</legend>

                <select>
                    <option value="1">Daniel</option>
                    <option value="2">Jorge</option>
                    <option value="3">Carla</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>

