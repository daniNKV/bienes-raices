<?php

namespace App;
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

class Propiedad {
    // BASE DE DATOS
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'estacionamiento', 'wc', 'creado', 'vendedor_ID'];

    // Definir conexión a BD
    public static function setDB($database) {
        self::$db = $database;
    }
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
        $this->imagen = $args['imagen'] ?? '';
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

            $resultado = self::$db->query($query);
        
 
    }


    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === '$id') continue;
            $atributos[$columna] = $this->$columna;
        }
        debug($atributos);
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

}