<?php 
    // Importar conexión
    require 'includes/config/database.php';
    $db = conectarDB();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT );

    if(!$id) {
        header('Location: /');
    }
   
    // Consulta
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    // Resultado
    $resultado = mysqli_query($db, $query);
    $propiedad = mysqli_fetch_assoc($resultado);


    require 'includes/funciones.php';
    incluirTemplate('header');
    
?>
    
<main class="contenedor seccion contenido-centrado">

    <h1><?php echo $propiedad['titulo']?></h1>

    <picture>
        <img src="imagenes/<?php echo $propiedad['imagen']?>" alt="Casa frente al bosque" loading="lazy">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">Precio: $<?php echo $propiedad['precio']?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']?></p>
            </li>
        </ul>

        <p>
            <?php echo $propiedad['descripcion']?>
        </p>

        
    </div>    

</main>

<?php 
    incluirTemplate('footer'); 
    mysqli_close($db);
?>


