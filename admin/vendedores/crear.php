<?php 

require '../../includes/app.php';

use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estadoAutenticado();

$vendedor = new Vendedor;

// Array con errores
$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear instancia 
    $vendedor = new Vendedor($_POST['vendedor']);
    
    // Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

    // SETEAR IMAGEN //
    if($_FILES['vendedor']['tmp_name']['imagen']) {
        // Re-size
        $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
        // Guardar Ref
        $vendedor->setImagen($nombreImagen);
    }


    // Validar campos
    $errores = $vendedor->validar();

    if(empty($errores)) {
        // Crear carpeta para las imagenes
        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        // Guardar archivos
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guardar info
        $vendedor->guardar();
    }

}
incluirTemplate('header');


?>




<main class="contenedor seccion">
    <h1>Registro de Vendedores</h1>

    <a href="/admin" class="boton-verde">Volver</a>
    
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="form" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">
    
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        '

        <input type="submit" value="Añadir vendedor/a" class="boton-verde">
    </form>

</main>

<?php incluirTemplate('footer'); ?>