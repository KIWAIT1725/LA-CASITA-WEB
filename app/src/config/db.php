<?php
// src/config/db.php

$host = "dpg-d27b7u8gjchc73fvjbqg-a";
$dbname = "sql_postgresql_casa";
$user = "sql_postgresql_casa_user";
$password = "aB5mWnMnrH7BvRR67cP6sy732hVKE7nc";

// Conexión a PostgreSQL usando pg_connect
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Error al conectar a PostgreSQL: " . pg_last_error());
}
?>
