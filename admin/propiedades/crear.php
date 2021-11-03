<?php 
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estadoAutenticado();

//BASE DE DATOS

    $db = conectarDB();

    $propiedad = new Propiedad;

    $consulta = "SELECT * FROM vendedores";
    $resultadoVendedor = mysqli_query($db, $consulta);


    // Array con errores
    $errores = Propiedad::getErrores();


    // Ejecutar después de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Crear nueva Instancia
        $propiedad = new Propiedad($_POST['propiedad']);

        // Generar nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

        // SETEAR IMAGEN //
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            // Re-size
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
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
      
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            '

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