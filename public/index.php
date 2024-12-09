<?php
require_once 'src/controller/db_connection.php';
require_once 'src/controller/get_posts.php';

$user_id = 1; // Asegúrate de obtener el ID de usuario desde la sesión

// Obtener los posts del usuario
$posts = obtenerPostsPorUsuario($user_id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postea</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/styles.css">
</head>

<body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1>Postea</h1>
        </div>
        <div class="row">
            <!-- Columna izquierda: Datos del usuario -->
            <div class="col-md-4 mt-4">
                <div class="card bg-dark border-light shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Usuario</h4>
                        <p><strong>Nombre:</strong> Fernando</p>
                        <p><strong>Apellido:</strong> Diaz</p>
                        <p><strong>Bio:</strong> Amante de la tecnología y el desarrollo web.</p>
                        <p><strong>Fecha de Registro:</strong> 12 de octubre de 2023</p>
                        <!--
                        <form action="src/controller/db_connection.php" method="POST">
                            <button type="submit" class="btn btn-secondary mt-3">Probar Conexión</button>
                        </form>
                        -->
                    </div>
                </div>
                <!--
                <div class="mt-4">
                    <div class="card bg-dark border-light shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Mascota</h4>
                            <p><strong>Nombre:</strong> Valkyria</p>
                            <p><strong>Raza:</strong> Podenco</p>
                            <p><strong>Bio:</strong> Perrita de caza que se adapto enseguida a vivir en un piso.</p>
                            <p><strong>Fecha de nacimiento:</strong> 16 de noviembre de 2018</p>
                        </div>
                    </div>
                </div>
            -->
            </div>


            <!-- Columna derecha: Formulario para crear un post -->
            <div class="col-md-8 mt-4">
                <div class="card bg-dark border-light shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Crear un Post</h4>
                        <form action="src/controller/create_post.php" method="POST">
                            <div class="mb-3">
                                <label for="contenido" class="form-label">Post</label>
                                <textarea class="form-control bg-dark text-light border-light" id="contenido"
                                    name="contenido" rows="5" placeholder="Escribe el contenido del post"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Mostrar los posts -->
                <div class="mt-4">
                    <?php if (empty($posts)): ?>
                        <p>No tienes posts aún.</p>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($posts as $post): ?>
                                <div class="col-12 mb-4">
                                    <div class="card bg-dark text-light border-light shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">Post</h5>
                                            <p class="card-text"><?= htmlspecialchars($post['contenido']) ?></p>
                                            <small>Publicado el:
                                                <?= date('d M Y, H:i', strtotime($post['fecha_publicacion'])) ?></small>

                                            <!-- Botón Eliminar alineado a la derecha -->
                                            <div class="d-flex justify-content-end mt-2">
                                                <form action="src/controller/delete_post.php" method="POST">
                                                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer 
    <footer class="bg-dark text-light text-center py-3 mt-5">
        <p>Creado por Fernando Diaz - 2024</p>
    </footer>
    -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>