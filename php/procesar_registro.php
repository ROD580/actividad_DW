<?php
session_start();
require_once 'db_connection.php';

$nombre_usuario = $_POST['nombre_usuario'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre_usuario, $email, $password);

if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso. Por favor, inicia sesión.'); window.location.href = '../public/login.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
