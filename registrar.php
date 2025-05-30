<?php
// Configura los encabezados necesarios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Credenciales de tu base de datos en Render
$host = 'dpg-d0t06b6mcj7s73ffdka0-a.oregon-postgres.render.com';
$db   = 'db_sushi';
$user = 'db_sushi_user';
$pass = 'a4G0j0rX5o1IWc2pmPqk59Khr9XdBUYW';
$port = '5432';

// Conexión a PostgreSQL con PDO
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error de conexión: " . $e->getMessage()]);
    exit();
}

// Leer datos JSON del cuerpo de la solicitud
$data = $_POST;

// Validar campos necesarios
$campos = ['nombre', 'apellido_paterno', 'apellido_materno', 'sexo', 'edad', 'celular', 'email', 'zona', 'm_pago', 'contrasenia'];
foreach ($campos as $campo) {
    if (empty($data[$campo])) {
        echo json_encode(["success" => false, "message" => "Falta el campo: $campo"]);
        exit();
    }
}

// Preparar y ejecutar la inserción
try {
    $stmt = $pdo->prepare("INSERT INTO tbl_clientes (nombre, apellido_paterno, apellido_materno, sexo, edad, celular, email, zona, m_pago, contrasenia)
                           VALUES (:nombre, :apellido_paterno, :apellido_materno, :sexo, :edad, :celular, :email, :zona, :m_pago, :contrasenia)");

    $stmt->execute([
        ':nombre' => $data['nombre'],
        ':apellido_paterno' => $data['apellido_paterno'],
        ':apellido_materno' => $data['apellido_materno'],
        ':sexo' => $data['sexo'],
        ':edad' => $data['edad'],
        ':celular' => $data['celular'],
        ':email' => $data['email'],
        ':zona' => $data['zona'],
        ':m_pago' => $data['m_pago'],
        ':contrasenia' => password_hash($data['contrasenia'], PASSWORD_DEFAULT),
    ]);

    echo json_encode(["success" => true, "message" => "Usuario registrado correctamente"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al registrar: " . $e->getMessage()]);
}
?>
