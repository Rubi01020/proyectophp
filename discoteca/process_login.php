<?php
session_start();
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['rol'] = $user['rol']; 

        if ($user['rol'] === 'admin') {
            header('Location: admin_home.php');
        } elseif ($user['rol'] === 'personal') {
            header('Location: personal_home.php'); 
        } elseif ($user['rol'] === 'cliente') {
            header('Location: cliente_home.php'); 
        } else {
            header('Location: login.php?error=rol_no_valido');
        }
        exit();
    } else {
        header('Location: login.php?error=contraseña_incorrecta');
        exit();
    }
} else {
    header('Location: login.php?error=usuario_no_encontrado');
    exit();
}
