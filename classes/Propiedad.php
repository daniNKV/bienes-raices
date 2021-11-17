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


    
    public function guardar(){
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        }else {
            // Crear
            $this->crear();
    
        }
    }  

    public function crear() {
        // Sanitización
        $atributos = $this->sanitizarAtributos();
        // Inserción en BD
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        if($resultado) {
            //Redireccionar
            header('Location: /admin?resultado=200');
        }else {
            echo "fallo";
        }
    }


    public function actualizar() {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        
        $resultado = self::$db->query($query);
        
        if($resultado) {
            //Redireccionar
            header('Location: /admin?resultado=200');
        }
    }

    public function eliminar() {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1"; 
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=220');
        }
    }

    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            
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
        
        // Validacion imagen
        if(!$this->imagen) {
            self::$errores[] = "Debe tener una imagen";
        }

        return self::$errores;
    }

    public function setImagen($imagen) {
        // Eliminar imagen anterior
        if(!is_null($this->id)) {
            $this->borrarImagen();
        };
        // Subir nueva
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }    }
    
    public function sincronizar( $args = []){    // Sincronizar objeto en memoria con los cambios hechos

        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public static function getErrores() {
        return self::$errores;
    }

    public static function all() : array {  // Listar todas las propiedades

        $query = "SELECT * FROM propiedades";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;

    }

    public static function find($id) {  // Buscar una propiedad

        $query = "SELECT * FROM propiedades WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        
        return array_shift($resultado);
    }

    public static function consultarSQL($query) : array {
        // Consulta DB
        $resultado = self::$db->query($query); 
       
        // Iterar
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }
        
        // Flush Memoria
        $resultado->free();

        // Resultados
        return $array;
    }

    protected static function crearObjeto($array) : object {
        $objeto = new self;

        foreach($array as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            };
        }
        return $objeto;
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