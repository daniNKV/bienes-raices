<?php 

require '../../includes/app.php';

use App\Vendedor;

estadoAutenticado();

$vendedor = new Vendedor;

// Array con errores
$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {


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

    <form class="form" method="POST" action="/admin/vendedores/actualizar.php" enctype="multipart/form-data">
    
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        '

        <input type="submit" value="Guardar cambios" class="boton-verde">
    </form>

</main>

<?php incluirTemplate('footer'); ?>