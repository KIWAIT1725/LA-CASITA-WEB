<?php
// public/api/login.php

require_once __DIR__ . '/../../src/config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    $query = "SELECT * FROM usuarios WHERE usuario = $1 AND contraseña = $2";
    $result = pg_query_params($conn, $query, array($usuario, $contrasena));

    if ($result && pg_num_rows($result) === 1) {
        // Redirigir al dashboard
        header("Location: ../dashboard.html");
        exit;
    } else {
        echo "❌ Usuario o contraseña incorrectos.";
    }
} else {
    echo "Método no permitido.";
}
