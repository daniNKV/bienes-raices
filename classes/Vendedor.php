<?php

namespace App;

class Vendedor extends ActiveRecord {
    
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'imagen'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $imagen;

    
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->email = $args['email'] ?? ''; 
    }

    public function validar() {
        // Validacion de formulario
        if(!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if(!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }
        if(!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio";
        }
        if(!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Formato de teléfono inválido";

        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = "Formato de email inválido";

        }

        return self::$errores;

    }

}

