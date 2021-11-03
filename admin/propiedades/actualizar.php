<?php 

    use App\Propiedad;

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
    //Conexión 
    $db = conectarDB();
    
    // Obtener propiedad
    $propiedad = Propiedad::find($id);


    $consultaVendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consultaVendedores);

    // Array con errores
    $errores = [];
    
    $titulo = $propiedad->titulo ?? '';
    $precio = $propiedad->precio ?? '';
    $descripcion = $propiedad->descripcion ?? '' ;
    $habitaciones = $propiedad->habitaciones ?? '';
    $wc = $propiedad->wc ?? '';
    $estacionamiento = $propiedad->estacionamiento ?? '';
    $vendedor_ID = $propiedad->vendedor_ID ?? '';
    $imagenPropiedad = $propiedad->imagen;
    $creado = $propiedad->creado;


    // Ejecutar después de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>'; 
        
        exit;
        */
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor_ID = mysqli_real_escape_string($db, $_POST['vendedor_ID']);

        // Asignar files en una variable
        $imagen = $_FILES['imagen'];

        // Validacion de formulario
        if(!$titulo) {
            $errores[] = "Debe tener un titulo";
        }
        if(!$precio) {
            $errores[] = "Debe tener un precio";
        }
        if(strlen($descripcion) < 20) {
            $errores[] = "Debe tener una descripcion de al menos 20 caracteres";
        }
        if(!$habitaciones) {
            $errores[] = "Debe tener un numero de habitaciones";
        }
        if(!$wc) {
            $errores[] = "Debe tener un numero de baños";
        }
        if(!$estacionamiento) {
            $errores[] = "Debe tener un numero de lugares para estacionar";
        }
        // Asignar atributos
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);

        // Validacion imagen
        $escala = 10000 * 1000;
        if($imagen['size'] > $escala) {
            $errores[] = "La imagen es muy pesada";
        }

        // Revisar que no existan errores
        if(empty($errores)) {
        
            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';
            // SUBIR ARCHIVOS
            if ($imagen['name']) {
                // Borrar imagen anterior
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar nombre único
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

                // Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
        
            }else {
                $nombreImagen = $propiedad['imagen'];
            }

            // INSERTAR EN BD
            $query = "UPDATE propiedades SET
                titulo = '${titulo}', 
                precio = '${precio}', 
                imagen = '${nombreImagen}',
                descripcion = '${descripcion}', 
                habitaciones = ${habitaciones}, 
                wc = ${wc}, 
                estacionamiento = ${estacionamiento}, 
                vendedor_ID = ${vendedor_ID} 
                WHERE id = ${id}
                ";

            $resultado = mysqli_query($db, $query)or die(mysqli_error($db));
            
            if($resultado) {
                //Redireccionar
                header('Location: /admin?resultado=210');
            }else {
                echo 'fallo';            
                


            }
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

