<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
    
   
    $sql = "SELECT * FROM cursos WHERE id_curso = '$id_curso'";
    $result = $conn->query($sql);
    $curso = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Curso Inscrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">¡Felicidades, <?= htmlspecialchars($_SESSION['nombre_usuario']); ?>!</h1>
        <p class="text-center">Te has inscrito exitosamente en el curso: <strong><?= htmlspecialchars($curso['nombre_curso']); ?></strong></p>
        <p class="text-center"><?= htmlspecialchars($curso['descripcion']); ?></p>
        <div class="text-center">
            <a href="../public/index.php" class="btn btn-purple">Volver a la Página Principal</a>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
