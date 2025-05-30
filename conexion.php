<?php
$host = getenv("DB_HOST");        // Debes tener una variable de entorno llamada DB_HOST
$dbname = getenv("DB_NAME");      // Y otra llamada DB_NAME
$user = getenv("DB_USER");        // Variable de entorno para el usuario
$password = getenv("DB_PASSWORD");// Variable de entorno para la contraseña
$port = getenv("DB_PORT");        // Variable de entorno para el puerto

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

