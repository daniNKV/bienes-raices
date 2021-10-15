<?php 

//BASE DE DATOS

    require '../../includes/config/database.php';
    $db = conectarDB();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['precio'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedor_ID = $_POST['vendedor_ID'];

        // INSERTAR EN BD

        $query = "INSERT INTO propiedades ( 
            titulo, 
            precio, 
            descripcion, 
            habitaciones, 
            wc, 
            estacionamiento, 
            vendedor_ID ) 
            
            VALUES (
                '$titulo', 
                '$precio', 
                '$descripcion', 
                '$habitaciones', 
                '$wc', 
                '$estacionamiento', 
                '$vendedor_ID'
        )";

        $resultado = mysqli_query($db, $query);

        if($resultado) {
            echo 'Insertado correctamente';
        }else {
            echo 'fallo';
        }
        


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
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">
               
                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="99">
            </fieldset>

            <fieldset>
                <legend>Vendedor/es</legend>

                <select name="vendedor_ID">
                    <option value="1">Daniel</option>
                    <option value="2">Jorge</option>
                    <option value="3">Carla</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>

