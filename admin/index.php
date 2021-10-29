<?php 

    // Autenticación
    require '../includes/app.php';
    $auth = estadoAutenticado();
    if(!$auth) {
        header('Location: /login.php');
    }


    // Importar DB
    $db = conectarDB();

    $query = "SELECT * FROM propiedades";
    $resultadoDB = mysqli_query($db, $query);

    // Mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    // Eliminar Elementos
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT );

        if($id) {
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            //Eliminar Propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            if($resultado) {
                header('Location: /admin?resultado=220');
            }
        }
        var_dump($id);
    }

    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
    
    <?php if(intval($resultado) == 200): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif ?>

    <?php if(intval($resultado) == 210): ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php endif ?>

    <?php if(intval($resultado) == 220): ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
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
                        <form method="POST" class="w100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
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

