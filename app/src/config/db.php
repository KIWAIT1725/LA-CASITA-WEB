<?php
// src/config/db.php

$host = "localhost";
$dbname = "casita";
$user = "tu_usuario";
$password = "tu_contraseña";

// Conexión a PostgreSQL usando pg_connect
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Error al conectar a PostgreSQL: " . pg_last_error());
}
?>
