<?php
session_start();
require_once '../php/db_connection.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];


$sql_cursos = "SELECT * FROM cursos";
$result_cursos = $conn->query($sql_cursos);


$sql_cursos_inscritos = "SELECT c.id_curso, c.nombre_curso, c.descripcion 
                         FROM cursos c 
                         JOIN inscripciones i ON c.id_curso = i.id_curso 
                         WHERE i.id_usuario = '$id_usuario'";
$result_cursos_inscritos = $conn->query($sql_cursos_inscritos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Orden Jedi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bienvenido, <?= htmlspecialchars($_SESSION['nombre_usuario']); ?></h1>

        <h3 class="mt-4">Cursos en los que estás inscrito</h3>
        <div class="row">
            <?php if ($result_cursos_inscritos->num_rows > 0): ?>
                <?php while ($curso_inscrito = $result_cursos_inscritos->fetch_assoc()): ?>
                    <div class="col-md-4 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($curso_inscrito['nombre_curso']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($curso_inscrito['descripcion']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No estás inscrito en ningún curso todavía.</p>
            <?php endif; ?>
        </div>

        <h3 class="mt-4">Cursos Disponibles</h3>
        <div class="row">
            <?php while ($curso = $result_cursos->fetch_assoc()): ?>
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($curso['nombre_curso']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($curso['descripcion']); ?></p>
                            <?php if (isset($_SESSION['id_usuario'])): ?>
                                <a href="../php/inscribirse.php?id_curso=<?= $curso['id_curso']; ?>" class="btn btn-purple">Inscribirme</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-secondary">Inicia sesión para inscribirte</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
