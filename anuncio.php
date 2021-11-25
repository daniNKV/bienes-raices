<?php 
    require 'includes/app.php';
    use App\Propiedad;


    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT );

    if(!$id) {
        header('Location: /');
    }

    $propiedad = Propiedad::find($id);

    incluirTemplate('header');
    
?>
    
<main class="contenedor seccion contenido-centrado">

    <h1><?php echo $propiedad->titulo; ?> </h1>

    <picture>
        <img src="imagenes/<?php echo $propiedad->imagen?>" alt="Propiedad" loading="lazy">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">Precio: $<?php echo $propiedad->precio; ?> </p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento;?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones;?></p>
            </li>
        </ul>

        <p>
            <?php echo $propiedad->descripcion;?>
        </p>

        
    </div>    

</main>

<?php 
    incluirTemplate('footer'); 

?>


