<?php 

    require 'includes/config/database.php';
    $db = conectarDB();

    // Autenticación de Usuarios
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email ingresado no es válido";
        }

        if(!$password) {
            $errores[] = "La contraseña ingresada no es válida";
        }

        if(empty($erorres)) {
            // Revisar si existe el usuario
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario['password']);
                
                if($auth) {
                    // Usuario Autenticado
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    
                    header('Location: /admin');
                }else {
                    $errores[] = "El password es incorrecto";
                }

            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }

    



    require 'includes/funciones.php';
    incluirTemplate('header');
    

?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div> 
        <?php endforeach ?>

        <form method="POST" class="form">
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email:</label>
                <input name="email" type="email" placeholder="Su email" id="email" >
                
                <label for="password">password:</label>
                <input name="password" type="password" placeholder="Su contraseña" id="password" >
                
            </fieldset>

            <input type="submit" class="boton boton-verde-block" value="Iniciar Sesión">

        </form>
    </main>

    <?php incluirTemplate('footer'); ?>

