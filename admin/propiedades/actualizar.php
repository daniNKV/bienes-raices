<?php 

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    // Autenticación
    require '../../includes/app.php';

    estadoAutenticado();

    // Información de la propiedad
    $id = $_GET['id']; 
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    //BASE DE DATOS

    // Obtener propiedad
    $propiedad = Propiedad::find($id);

    // Obtener Vendedores
    $vendedores = Vendedor::all();
    // Array con errores
    $errores = Propiedad::getErrores();
    




    // Ejecutar después de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Asignar atributos
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);

        // Validacion 
        $errores = $propiedad->validarFormulario();

        // Subir Archivos
        // Generar nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // Revisar que no existan errores
        if(empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();

        }
        
  }

    
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

            <?php include '../../includes/templates/formulario_propiedades.php'?>

            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>

