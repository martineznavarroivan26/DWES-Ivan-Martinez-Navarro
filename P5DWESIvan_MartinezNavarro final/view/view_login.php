<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- import de bootstrap -->
    <link rel="stylesheet" href="./view/css/bootstrap.min.css">

    <!-- import de los estilos -->
    <link rel="stylesheet" href="./view/css/styles.css?v=3">
    <link rel="stylesheet" href="./view/css/template.css?v=3">

    <script src="./js/bootstrap.bundle.min.js" defer></script>

    <!-- import del jquery -->
    <script src="./js/jquery-4.0.0.js" defer></script>
    <script src="./js/navegacion.js" defer></script>

</head>
<body>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">Credenciales invalidas. Intentalo de nuevo.</p>
<?php endif; ?>

<form action="./index.php" method="POST" class="login-card">
<!--aunque despues hagamos control real el required avisa al usuario -->
    <h1 class="login-title">Acceso</h1>
    <label for="usuario">nombre de usuario</label>
    <input type="text" name="usuario" id="usuario" placeholder="nombre de usuario" required><br>
    <label for="pass">Contraseña</label>
    <input type="password" name="pass" id="pass" placeholder="contraseña" required><br>
    <div class="login-actions">
        <input type="submit" name="action" value="registro" class="enviar">
        <a href="./index.php?action=home" class="login-back-link" onclick="if (window.history.length > 1) { event.preventDefault(); window.history.back(); }">Volver atras</a>
    </div>
</form>
    
</body>
</html>