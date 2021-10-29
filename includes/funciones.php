<?php

define('TEMPLATES_URL', __DIR__.'\templates');
define('FUNCIONES_URL', __DIR__. 'funciones.php');


function incluirTemplate(string $nombre, bool $inicio = false) {

    include TEMPLATES_URL."/${nombre}.php"; 
    
}

function estadoAutenticado() : void {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debug($variable) : void {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}    
