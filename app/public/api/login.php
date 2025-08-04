<?php
// Validar que sea método POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}

// Conexión a la base de datos
require_once __DIR__ . "/../../src/config/db.php";

$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
$contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : '';

if (empty($usuario) || empty($contrasena)) {
    echo "<script>alert('❌ Todos los campos son obligatorios'); window.location.href='../index.html';</script>";
    exit;
}

// Consulta segura con pg_query_params
$query = "SELECT * FROM usuarios WHERE usuario = $1 AND contrasena = $2";
$result = pg_query_params($conn, $query, array($usuario, $contrasena));

if (pg_num_rows($result) > 0) {
    // Inicio de sesión correcto
    echo "<script>alert('✅ Bienvenido, $usuario'); window.location.href='../dashboard.html';</script>";
    exit;
} else {
    // Usuario no válido
    echo "<script>alert('❌ Usuario o contraseña incorrectos'); window.location.href='../index.html';</script>";
    exit;
}
