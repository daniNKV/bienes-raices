<?php 

require '../../includes/app.php';
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estadoAutenticado();


// Validar ID
$id = $_GET['id'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}


// Obtener vendedor desde DB
$vendedor = Vendedor::find($id);

// Array con errores
$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar valores
    $args = $_POST['vendedor'];

    // Sincronizr objeto en memoria con la nueva data
    $vendedor->sincronizar($args);
    // Validar
    $errores = $vendedor->validar();

    // Subir Archivos
    // Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

    if($_FILES['vendedor']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
        $vendedor->setImagen($nombreImagen);
    }

    // Revisar que no existan errores
    if(empty($errores)) {
        if($_FILES['vendedor']['tmp_name']['imagen']) {
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        $vendedor->guardar();

    }

}
incluirTemplate('header');


?>


<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton-verde">Volver</a>
    
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="form" method="POST" enctype="multipart/form-data">
    
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Guardar cambios" class="boton-verde">
    </form>

</main>

<?php incluirTemplate('footer'); ?>