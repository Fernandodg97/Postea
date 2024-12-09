<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';

// Depuración: Verifica qué datos están llegando
var_dump($_POST); // Esto debería mostrar el contenido del formulario que se envió

// Verificar si se ha enviado el ID del post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id']) && !empty($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    try {
        // Eliminar el post de la base de datos
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :post_id");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la página principal después de eliminar el post
            header('Location: ../../index.php');
            exit();
        } else {
            echo "<h3 style='color: red;'>Hubo un problema al eliminar el post</h3>";
        }
    } catch (PDOException $e) {
        // Mensaje de error
        echo "<h3 style='color: red;'>Error al eliminar el post: " . $e->getMessage() . "</h3>";
    }
} else {
    echo "<h3 style='color: red;'>No se especificó un ID de post para eliminar.</h3>";
}