<?php 
    
    // Importar Conexion
    require 'includes/config/database.php';
    $db = conectarDB();
    
    // Crear Email y password
    $password = '123456';
    $email = 'email@email.com';

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    var_dump($passwordHash);

    // Query para el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

    // Agregarlo a la DB
    mysqli_query($db, $query);
?> 