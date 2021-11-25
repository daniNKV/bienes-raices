<?php 
    
    // Importar Conexion
    require 'includes/app.php';
    $db = conectarDB();
    
    // Crear Email y password
    $password = 'admin';
    $email = 'email@email.com';

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    // Query para el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

    // Agregarlo a la DB
    mysqli_query($db, $query);
?> 