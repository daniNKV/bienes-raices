<?php

namespace App;


class Propiedad {

    // BASE DE DATOS
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'estacionamiento', 'wc', 'creado', 'vendedor_ID'];


    // Definir conexión a BD
    public static function setDB($database) {
        self::$db = $database;
    }


    // Gestion Errores
    protected static $errores = [];


    // Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $estacionamiento;
    public $wc;
    public $creado;
    public $vendedor_ID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedor_ID = $args['vendedor_ID'] ?? '';
    }


    public function guardar() {
        // Sanitización
        $atributos = $this->sanitizarAtributos();


        // Inserción en BD
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

    }


    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === '$id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    public function sanitizarAtributos() {
        
        $atributos = $this->atributos();
        $sanitizado = [];
        
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;

    }

    // Validación 
    public static function getErrores() {
        return self::$errores;
    }

    public function validarFormulario() {
        // Validacion de formulario
        if(!$this->titulo) {
            self::$errores[] = "Debe tener un titulo";
        }
        if(!$this->precio) {
            self::$errores[] = "Debe tener un precio";
        }
        if(strlen($this->descripcion) < 20) {
            self::$errores[] = "Debe tener una descripcion de al menos 20 caracteres";
        }
        if(!$this->habitaciones) {
            self::$errores[] = "Debe tener un numero de habitaciones";
        }
        if(!$this->wc) {
            self::$errores[] = "Debe tener un numero de baños";
        }
        if(!$this->estacionamiento) {
            self::$errores[] = "Debe tener un numero de lugares para estacionar";
        }
        /*
        // Validacion imagen
        $escala = 10000 * 1000;
        if(!$this->imagen['name']) {
            self::$errores[] = "Debe tener una imagen";
        }
        if($this->imagen['size'] > $escala) {
            self::$errores[] = "La imagen es muy pesada";
        }
*/
        return self::$errores;
    }



}











/*
class Propiedad {
    public function __construct(        
        public $id,
        public $titulo,
        public $precio,
        public $imagen,
        public $descripcion,
        public $habitaciones,
        public $wc,
        public $creado,
        public $vendedor_ID) {

    }
 

}^
*/




/*         
QUERY ORIGINAL
    $query = "INSERT INTO propiedades ( 
            titulo, 
            precio, 
            imagen,
            descripcion, 
            habitaciones, 
            wc, 
            estacionamiento, 
            creado,
            vendedor_ID 
            ) 
            
            VALUES (
                '$this->titulo', 
                '$this->precio',
                '$this->imagen', 
                '$this->descripcion', 
                '$this->habitaciones', 
                '$this->wc', 
                '$this->estacionamiento', 
                '$this->creado',
                '$this->vendedor_ID'
            )";

            */