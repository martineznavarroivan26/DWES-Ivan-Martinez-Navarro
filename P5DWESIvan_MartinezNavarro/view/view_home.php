<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto API</title>

    <!-- import de los estilos -->
    <link rel="stylesheet" href="./view/css/styles.css">
    <link rel="stylesheet" href="./view/css/template.css">

    <!-- import de bootstrap -->
    <link rel="stylesheet" href="./view/css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js" defer></script>

    <!-- import del jquery -->
    <script src="./js/jquery-4.0.0.js" defer></script>
    <script src="./js/navegacion.js" defer></script>

    <!-- import script propio modales -->
     <script src="./js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <header>
        <?php require_once './view/templates/header.php'; ?>
    </header>

    <main>
        <section class="container">
            <h2>Bienvenido</h2>
            <?php
                require_once './class/User.php';
                $usuarioEntidad = null;
                if (isset($_SESSION['usuario_obj'])) {
                    $tmpUsuario = @unserialize($_SESSION['usuario_obj'], ['allowed_classes' => ['User']]);
                    if ($tmpUsuario instanceof User) {
                        $usuarioEntidad = $tmpUsuario;
                    }
                }
            ?>
            <?php if ($usuarioEntidad && (int) $usuarioEntidad->getRol() === 1): ?>
                <p>Presentacion para administradores: panel completo y control de usuarios.</p>
            <?php else: ?>
                <p>Presentacion general: informacion del proyecto y acceso al area de formularios.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <?php require_once './view/templates/footer.php'; ?>
    </footer>
</body>
</html>