<?php

define('TEMPLATES_URL', __DIR__.'\templates');
define('FUNCIONES_URL', __DIR__. 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {

    include TEMPLATES_URL."/${nombre}.php"; 
    
}

function estadoAutenticado() {
    session_start();
    
    if(!$_SESSION['login']) {
        header('Location: /login.php');
    }else {
        return true;
    }
}

function debug($variable)  {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}    

// Escapar HTML

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}


// Validar tipo de contenido

function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}


// Mostrar mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 200: 
            $mensaje = "Creado correctamente";
            break;
        case 210: 
            $mensaje = "Actualizado correctamente";
            break;
        case 220: 
            $mensaje = "Eliminado correctamente";
            break;
        default: 
            $mensaje = false;
            break;
    }

    return $mensaje;
}
