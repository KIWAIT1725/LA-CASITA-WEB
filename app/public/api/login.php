<?php
// api/login.php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    die("Método no permitido");
}

session_start();
require_once __DIR__ . "/../../src/config/db.php"; // Usa $pdo

$usuario = trim(isset($_POST['usuario']) ? $_POST['usuario'] : '');
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

if (empty($usuario) || empty($contrasena)) {
    echo "<script>alert('❌ Todos los campos son obligatorios'); window.location.href='../index.html';</script>";
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, usuario, contrasena FROM usuarios WHERE usuario = ?");
    $stmt->execute(array($usuario));
    $user = $stmt->fetch();

    if ($user && password_verify($contrasena, $user['contrasena'])) {
        // Login exitoso
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['id'] = $user['id'];

        echo "<script>
            alert('✅ Bienvenido, " . htmlspecialchars($user['usuario']) . "');
            window.location.href = '../dashboard.html';
        </script>";
    } else {
        echo "<script>
            alert('❌ Usuario o contraseña incorrectos');
            window.location.href = '../index.html';
        </script>";
    }

} catch (Exception $e) {
    error_log("Error en login: " . $e->getMessage());
    echo "<script>
        alert('❌ Error interno. Intenta más tarde.');
        window.location.href = '../index.html';
    </script>";
}
?>