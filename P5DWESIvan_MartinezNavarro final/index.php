<?php
session_start();

require_once './class/User.php';
require_once './controller/controller_form.php';
require_once './api/controller_api_answer.php';

$apiController = new ApiController();
$partes = $apiController->extraerApi();

// Prioriza llamadas REST tipo /index.php/forms/{action}/{cod}
$accionesApi = ['sueno', 'actividad', 'alimentacion', 'antropometrico', 'todos', 'mostrarTodo', 'familiaImc', 'sexoImc' ,'centroImc', 'familiaIca', 'sexoIcc', 'centroIca', 'familiaImcp' , 'grasaImc', 'dietaImc', 'dietaIca', 'dietaIcc'];
$apiAction = null;
$apiCod = null;
for ($i = 0, $n = count($partes); $i < $n; $i++) {
    if (in_array($partes[$i], $accionesApi, true)) {
        $apiAction = $partes[$i];
        $apiCod = $partes[$i + 1] ?? null;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['action']) && $apiAction !== null && $apiCod !== null && ctype_digit($apiCod)) {
    if (method_exists($apiController, $apiAction)) {
        $apiController->$apiAction($apiCod);
    } else {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['error' => 'Accion API no encontrada']);
    }
    exit;
}

$controller = new FormController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'home';
} else {
    $action = $_GET['action'] ?? 'home';
}

$usuarioSesion = null;
if (isset($_SESSION['usuario_obj'])) {
    $tmpUsuario = @unserialize($_SESSION['usuario_obj'], ['allowed_classes' => ['User']]);
    if ($tmpUsuario instanceof User) {
        $usuarioSesion = $tmpUsuario;
    }
}

$rol = $usuarioSesion ? (int) $usuarioSesion->getRol() : null;
$permitidasVisitante = ['home', 'presentacion', 'login', 'registro'];
$permitidasUsuario = ['home', 'presentacion', 'forms', 'nuevoParticipanteForms', 'buscarParticipante', 'insertarParticipante', 'insertarActividad', 'insertarAlimentacion', 'insertarSuenyo', 'insertarAntropometrico', 'logout'];
$permitidasAdmin = ['home', 'presentacion', 'analisis', 'forms', 'usuarios', 'crearUsuario', 'eliminarUsuario', 'presentacionesAdmin', 'nuevoParticipanteForms', 'buscarParticipante', 'insertarParticipante', 'eliminarParticipante', 'insertarActividad', 'insertarAlimentacion', 'insertarSuenyo', 'insertarAntropometrico', 'logout'];

if ($rol === 1) {
    $permitidas = $permitidasAdmin;
} elseif ($rol === 2) {
    $permitidas = $permitidasUsuario;
} else {
    $permitidas = $permitidasVisitante;
}

if (!in_array($action, $permitidas, true)) {
    if ($rol === 2) {
        $action = 'forms';
    } else {
        $action = 'home';
    }
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    $controller->home();
}
?>