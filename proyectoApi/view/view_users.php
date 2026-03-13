<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

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

    <main class="container py-4">
        <h1>Panel de gestion de usuarios</h1>

        <?php if (isset($_GET['u_saved']) && $_GET['u_saved'] === '1'): ?>
            <p><strong>Usuario creado correctamente.</strong></p>
        <?php endif; ?>
        <?php if (isset($_GET['u_deleted']) && $_GET['u_deleted'] === '1'): ?>
            <p><strong>Usuario eliminado correctamente.</strong></p>
        <?php endif; ?>
        <?php if (isset($_GET['u_error'])): ?>
            <p><strong>Error al gestionar usuarios. Revisa los datos e intentalo de nuevo.</strong></p>
        <?php endif; ?>

        <section class="mb-4">
            <h2>Crear nuevo usuario</h2>
            <form action="./index.php" method="POST" class="row g-3">
                <input type="hidden" name="action" value="crearUsuario">

                <div class="col-md-4">
                    <label for="nuevo_username" class="form-label">Username</label>
                    <input id="nuevo_username" name="nuevo_username" type="text" maxlength="50" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="nuevo_password" class="form-label">Contrasena</label>
                    <input id="nuevo_password" name="nuevo_password" type="text" maxlength="255" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="nuevo_rol" class="form-label">Rol</label>
                    <select id="nuevo_rol" name="nuevo_rol" class="form-select" required>
                        <option value="2">Participante (2)</option>
                        <option value="1">Admin (1)</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                </div>
            </form>
        </section>

        <section>
            <h2>Usuarios existentes</h2>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Username</th>
                        <th>Contrasena</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo (int) $usuario['id_user']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($usuario['password'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo ((int) $usuario['id_rol'] === 1) ? 'Admin (1)' : 'Participante (2)'; ?></td>
                            <td>
                                <form action="./index.php" method="POST" onsubmit="return confirm('Quieres eliminar este usuario?');" style="display:inline;">
                                    <input type="hidden" name="action" value="eliminarUsuario">
                                    <input type="hidden" name="id_user" value="<?php echo (int) $usuario['id_user']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <a href="./index.php" class="btn btn-secondary">Volver al menu</a>
    </main>
</body>
</html>