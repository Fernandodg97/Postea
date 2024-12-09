<?php
// Incluir la conexión a la base de datos
require_once 'db_connection.php';

function obtenerPostsPorUsuario($user_id) {
    global $pdo;  // Usamos la conexión $pdo ya definida en db_connection.php

    try {
        // Obtener todos los posts del usuario
        $stmt = $pdo->prepare("SELECT id, contenido, creado_en FROM posts WHERE user_id = :user_id ORDER BY creado_en DESC");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los resultados
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;

    } catch (PDOException $e) {
        echo "<h3 style='color: red;'>Error al obtener los posts: " . $e->getMessage() . "</h3>";
        return [];
    }
}