<?php

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'seraph_database';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    } catch (PDOException $e) {
        die('Conexion fallida: '.$e->getMessage());
    }

?>