<?php
// src/config/db.php

$host = "dpg-d27b7u8gjchc73fvjbqg-a.oregon-postgres.render.com";
$dbname = "sql_postgresql_casa";
$user = "sql_postgresql_casa_user";
$password = "aB5mWnMnrH7BvRR67cP6sy732hVKE7nc";
$port = "5432";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    $pdo = new PDO($dsn, $user, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ));
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>