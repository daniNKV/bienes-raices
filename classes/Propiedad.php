<?php

namespace App;

class Propiedad extends ActiveRecord {
    
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'estacionamiento', 'wc', 'creado', 'vendedor_ID'];

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
        $this->id = $args['id'] ?? null;
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

    public function validar() {
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
        
        // Validacion imagen
        if(!$this->imagen) {
            self::$errores[] = "Debe tener una imagen";
        }
    }
}