<?php
$host = getenv("db_sushi");
$dbname = getenv("db_sushi_user");
$user = getenv("DB_USER");
$password = getenv("a4G0j0rX5o1IWc2pmPqk59Khr9XdBUYW");
$port = getenv("5432");

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
