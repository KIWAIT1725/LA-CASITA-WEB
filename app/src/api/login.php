<?php
session_start();

// Conexión: subir un nivel desde /api/ a /config/
require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $query = "SELECT * FROM Usuarios WHERE Usuario = $1 AND Contrasena = $2";
    $result = pg_query_params($conn, $query, array($usuario, $contrasena));

    if (!$result) {
        echo "<script>alert('Error al consultar la base de datos.'); window.history.back();</script>";
        exit;
    }

    if (pg_num_rows($result) > 0) {
        // Redirigir al dashboard
        header("Location: ../../public/dashboard.html");
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos.'); window.location.href = '../../public/index.html';</script>";
        exit;
    }
}
?>
