CREATE DATABASE Orden_Jedi;

USE Orden_Jedi;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre_curso VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL
);

INSERT INTO cursos (nombre_curso, descripcion)
VALUES
('Aprendiz Padawan', 'Curso introductorio para aprender los fundamentos de la Fuerza.'),
('Maestro Jedi', 'Curso avanzado para los que dominan la Fuerza.'),
('Caminos de la Fuerza', 'Explora los misterios de la Fuerza y su conexión con los Jedi.');

CREATE TABLE inscripciones (
    id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES cursos(id_curso) ON DELETE CASCADE,
    UNIQUE(id_usuario, id_curso)
);
