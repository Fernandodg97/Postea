<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';

// Verificar si se ha enviado el formulario (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contenido']) && !empty($_POST['contenido'])) {
    $contenido = $_POST['contenido'];

    // Asegúrate de obtener el user_id desde la sesión o de la base de datos
    session_start(); // Si usas sesiones para manejar la autenticación
    $user_id = $_SESSION['user_id'] ?? 1; // Usamos el ID de sesión o un valor de prueba

    try {
        // Insertar el nuevo post en la base de datos
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, contenido) VALUES (:user_id, :contenido)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':contenido', $contenido);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header('Location: ../../index.php');
            exit();
        } else {
            echo "<h3 style='color: red;'>Hubo un problema al crear el post</h3>";
        }
    } catch (PDOException $e) {
        // Mensaje de error
        echo "<h3 style='color: red;'>Error al insertar el post: " . $e->getMessage() . "</h3>";
    }
} else {
    echo "<h3 style='color: red;'>Por favor, ingresa el contenido del post.</h3>";
}
