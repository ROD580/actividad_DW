<?php
session_start();
require_once 'db_connection.php';

$nombre_usuario = $_POST['nombre_usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        header("Location: ../public/index.php");
    } else {
        echo "<script>alert('Contraseña incorrecta.'); window.location.href = '../public/login.php';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado.'); window.location.href = '../public/login.php';</script>";
}

$stmt->close();
$conn->close();
?>
