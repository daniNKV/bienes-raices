<?php 

    $id = $_GET['id']; 
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }
    //BASE DE DATOS
    //Conexión 
    require '../../includes/config/database.php';
    $db = conectarDB();
    
    //Consultas
    $consultaPropiedades = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultadoPropiedad = mysqli_query($db, $consultaPropiedades);
    $propiedad = mysqli_fetch_assoc($resultadoPropiedad);

    $consultaVendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consultaVendedores);

    // Array con errores
    $errores = [];
    
    $titulo = $propiedad['titulo'] ?? '';
    $precio = $propiedad['precio'] ?? '';
    $descripcion = $propiedad['descripcion'] ?? '' ;
    $habitaciones = $propiedad['habitaciones'] ?? '';
    $wc = $propiedad['wc'] ?? '';
    $estacionamiento = $propiedad['estacionamiento'] ?? '';
    $vendedor_ID = $propiedad['vendedor_ID'] ?? '';
    $imagenPropiedad = $propiedad['imagen'];


    // Ejecutar después de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>'; 
        
        exit;
        */
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor_ID = mysqli_real_escape_string($db, $_POST['vendedor_ID']);
        $creado = date('Y/m/d');

        // Asignar files en una variable
        $imagen = $_FILES['imagen'];

        // Validacion de formulario
        if(!$titulo) {
            $errores[] = "Debe tener un titulo";
        }
        if(!$precio) {
            $errores[] = "Debe tener un precio";
        }
        if(strlen($descripcion) < 20) {
            $errores[] = "Debe tener una descripcion de al menos 20 caracteres";
        }
        if(!$habitaciones) {
            $errores[] = "Debe tener un numero de habitaciones";
        }
        if(!$wc) {
            $errores[] = "Debe tener un numero de baños";
        }
        if(!$estacionamiento) {
            $errores[] = "Debe tener un numero de lugares para estacionar";
        }

        // Validacion imagen
        $escala = 10000 * 1000;
        if($imagen['size'] > $escala) {
            $errores[] = "La imagen es muy pesada";
        }

        // Revisar que no existan errores
        if(empty($errores)) {
            // SUBIR ARCHIVOS
            
            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            // Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;
            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            
            // INSERTAR EN BD
            $query = "UPDATE propiedades SET
                titulo = '${titulo}', 
                precio = '${precio}', 
                imagen = '${imagen}',
                descripcion = '${descripcion}', 
                habitaciones = ${habitaciones}, 
                wc = ${wc}, 
                estacionamiento = ${estacionamiento}, 
                creado = ${creado},
                vendedor_ID = ${vendedor_ID} 
                WHERE id = ${id}
                ) 
                
                VALUES (
                    '$titulo', 
                    '$precio',
                    '$nombreImagen', 
                    '$descripcion', 
                    '$habitaciones', 
                    '$wc', 
                    '$estacionamiento', 
                    '$creado',
                    '$vendedor_ID'
                )";
    
            $resultado = mysqli_query($db, $query);
            
            if($resultado) {
                //Redireccionar
                header('Location: /admin?resultado=210');
            }else {
                echo 'fallo';
            }
        }
        

  }

    require '../../includes/funciones.php';
    
    incluirTemplate('header');
    

?>
    <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>

        <a href="/admin" class="boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="form" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="titulo" 
                    placeholder="Titulo de la Propiedad" 
                    value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio"
                    placeholder="Precio de la Propiedad" 
                    value="<?php echo $precio; ?>">
                
                <label for="imagen">Imagenes:</label>
                <input 
                    type="file" 
                    id="imagen" 
                    name="imagen" 
                    accept="image/jpeg, image/png">
                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small" alt="">

                <label for="descripcion" >Descripción:</label>
                <textarea id="descripcion" name="descripcion">
                    <?php echo "$descripcion"; ?>
                </textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $habitaciones; ?>">
               
                <label for="wc">Baños:</label>
                <input 
                    type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $wc; ?>">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="estacionamiento" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="99" 
                    value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor/es</legend>

                <select name="vendedor_ID">
                    <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedores)): ?>
                        <option <?php echo $vendedor_ID === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                                <?php echo $vendedor['nombre']." ".$vendedor['apellido']; ?>
                        </option>
                    <?php endwhile; ?> 
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>

