<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentaciones Admin</title>
    <link rel="stylesheet" href="./view/css/styles.css">
    <link rel="stylesheet" href="./view/css/template.css">

    
    <!-- import de bootstrap -->
    <link rel="stylesheet" href="./view/css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js" defer></script>

</head>
<body>
    <header>
        <?php require_once './view/templates/header.php'; ?>
    </header>

    <main class="container">
        <h1>Presentaciones del Administrador</h1>
        <p>Vista exclusiva para administradores.</p>
        <ul>
            <li>Resumen de gestion de usuarios.</li>
            <li>Revision global de formularios.</li>
            <li>Seguimiento de datos por participante.</li>
        </ul>
    </main>
</body>
</html>
