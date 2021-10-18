<?php 
    // Importar DB
    require '../includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM propiedades";

    $resultadoDB = mysqli_query($db, $query);

    // Mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    require '../includes/funciones.php';
    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
    
    <?php if(intval($resultado) == 200): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Resultados de DB -->
                <?php while ($propiedad = mysqli_fetch_assoc($resultadoDB)): ?>
                
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    
                    <td>
                        <a href="" class="boton-rojo-block">Eliminar</a>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                                    
                <?php endwhile ?>

            </tbody>
        </table>
    </main>

    <?php 
        mysqli_close($db);
        
        incluirTemplate('footer'); 
    ?>

