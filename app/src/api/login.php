<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    if (empty($usuario) || empty($contrasena)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    $query = "SELECT * FROM Usuarios WHERE Usuario = $1 AND Contrasena = $2";
    $result = pg_query_params($conn, $query, array($usuario, $contrasena));

    if (!$result) {
        echo "<script>alert('Error en la consulta'); window.history.back();</script>";
        exit;
    }

    if (pg_num_rows($result) > 0) {
        // ✅ Inicio de sesión correcto
        header("Location: ../../public/dashboard.html");
        exit;
    } else {
        // ❌ Usuario o contraseña incorrectos
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='../../public/index.html';</script>";
        exit;
    }
} else {
    echo "<script>alert('Método inválido'); window.history.back();</script>";
}
?>
