<?php
require_once './class/User.php';

$usuarioEntidad = null;
if (isset($_SESSION['usuario_obj'])) {
    $tmpUsuario = @unserialize($_SESSION['usuario_obj'], ['allowed_classes' => ['User']]);
    if ($tmpUsuario instanceof User) {
        $usuarioEntidad = $tmpUsuario;
    }
}

$usuario = $usuarioEntidad ? $usuarioEntidad->getUsername() : null;
$rol = $usuarioEntidad ? (int) $usuarioEntidad->getRol() : null;
?>

<nav class="d-flex justify-content-between align-items-center pb-5">
    <div class="logo">
        <img src="#" alt="JCCM">
    </div>
    <div class="titulo">
        <img src="#" alt="salud en primera persona">
    </div>
    <div class="reg">
        <img src="#" alt="icono sesion">
        <?php if ($usuario): ?>
            <span>Sesion: <?php echo htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'); ?></span>
            <button id="btnLogout"><a href="./index.php?action=logout">Cerrar sesion</a></button>
        <?php else: ?>
            <button id="btnLogin"><a href="./index.php?action=login">Iniciar sesion</a></button>
        <?php endif; ?>
    </div>

    

</nav>

<div class="menu d-flex justify-content-around">
        <?php if ($rol === 1): ?>
            <button class="public"><a href="./index.php?action=home">Home</a></button>
            <button class="user completar"><a href="./index.php?action=forms">Rellenar</a></button>
            <button class="admin"><a href="./index.php?action=analisis">Analiticas</a></button>
            <button class="admin"><a href="./index.php?action=usuarios">Usuarios</a></button>
            <button class="admin"><a href="./index.php?action=presentacionesAdmin">Presentaciones Admin</a></button>
        <?php elseif ($rol === 2): ?>
            <button class="public"><a href="./index.php?action=home">Home</a></button>
            <button class="user completar"><a href="./index.php?action=forms">Rellenar</a></button>
            <button class="public"><a href="./index.php?action=presentacion">Presentacion</a></button>
        <?php else: ?>
            <button class="public"><a href="./index.php?action=home">Home</a></button>
            <button class="public"><a href="./index.php?action=presentacion">Presentacion</a></button>
        <?php endif; ?>
    </div>