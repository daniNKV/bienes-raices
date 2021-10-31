<?php 
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estadoAutenticado();

//BASE DE DATOS

    $db = conectarDB();

    $consulta = "SELECT * FROM vendedores";
    $resultadoVendedor = mysqli_query($db, $consulta);


    // Array con errores
    $errores = Propiedad::getErrores();
    
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedor_ID = '';


    // Ejecutar después de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Crear nueva Instancia
        $propiedad = new Propiedad($_POST);

        // Generar nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

        // SETEAR IMAGEN //
        if($_FILES['imagen']['tmp_name']) {
            // Re-size
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            // Guardar Ref
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validarFormulario();
        
        // Revisar que no existan errores
        if(empty($errores)) {     
            // Crear carpeta para las imagenes
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guardar archivos
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // INSERTAR EN BD
            $resultado = $propiedad->guardar();
            if($resultado) {
                //Redireccionar
                header('Location: /admin?resultado=200');
            }else {
                echo 'fallo';
            }
        }
        

  }

    
    incluirTemplate('header');
    

?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="form" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
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

                <label for="descripcion" >Descripción:</label>
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    value="<?php echo $descripcion; ?>">
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
                    <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedor)): ?>
                        <option <?php echo $vendedor_ID === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                                <?php echo $vendedor['nombre']." ".$vendedor['apellido']; ?>
                        </option>
                    <?php endwhile; ?> 
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>




    <?php   
    /*      
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor_ID = mysqli_real_escape_string($db, $_POST['vendedor_ID']);
        $creado = date('Y/m/d');
        */
        ?>