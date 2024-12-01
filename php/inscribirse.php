<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");  
    exit();
}

if (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
    $id_usuario = $_SESSION['id_usuario'];

 
    $sql_verificar = "SELECT * FROM inscripciones WHERE id_usuario = '$id_usuario' AND id_curso = '$id_curso'";
    $resultado = $conn->query($sql_verificar);

    if ($resultado->num_rows > 0) {
        
        echo "<script>alert('Ya estás inscrito en este curso.'); window.location.href = '../public/index.php';</script>";
    } else {
       
        $sql_insertar = "INSERT INTO inscripciones (id_curso, id_usuario) VALUES ('$id_curso', '$id_usuario')";

        if ($conn->query($sql_insertar) === TRUE) {
            
            header("Location: bienvenida.php?id_curso=$id_curso");
            exit();
        } else {
           
            echo "Error al inscribirse: " . $conn->error;
        }
    }
} else {
   
    echo "<script>alert('No se ha encontrado el curso.'); window.location.href = '../public/index.php';</script>";
}

$conn->close();
?>
