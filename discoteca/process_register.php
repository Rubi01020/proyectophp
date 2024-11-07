<?php
// Incluir conexión a la base de datos
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Encripta la contraseña
    $rol = $_POST['role'];
    $fecha_registro = date("Y-m-d H:i:s");  // Genera la fecha actual

    // Insertar nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, password, rol, fecha_registro) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $email, $password, $rol, $fecha_registro);

    if ($stmt->execute()) {
        echo "Registro exitoso";
        header("Location: login.php"); // Redirigir al login tras el registro exitoso
        exit();
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
