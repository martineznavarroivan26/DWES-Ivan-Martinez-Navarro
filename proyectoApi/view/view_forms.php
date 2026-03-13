<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios</title>
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

    <?php
        $formulariosValidos = ['actividad', 'alimentacion', 'sueno', 'antropometrico'];
        $formularioSeleccionado = $_GET['form'] ?? 'actividad';
        $formulariosRellenados = $_SESSION['formularios_rellenados'] ?? [];
        $formularioRellenado = !empty($formulariosRellenados[$formularioSeleccionado]);
        $guardadoOk = isset($_GET['saved']) && $_GET['saved'] === '1';
        $guardadoError = isset($_GET['error']) && $_GET['error'] === '1';
        $psqiResultado = null;
        if (isset($_SESSION['psqi_result']) && is_array($_SESSION['psqi_result'])) {
            $psqiResultado = $_SESSION['psqi_result'];
            unset($_SESSION['psqi_result']);
        }
        $alimentacionResultado = null;
        if (isset($_SESSION['alimentacion_result']) && is_array($_SESSION['alimentacion_result'])) {
            $alimentacionResultado = $_SESSION['alimentacion_result'];
            unset($_SESSION['alimentacion_result']);
        }
        $needParticipante = isset($_GET['need_participante']) && $_GET['need_participante'] === '1';
        $participanteSet = isset($_GET['participante_set']) && $_GET['participante_set'] === '1';
        $codParticipanteActivo = isset($_SESSION['cod_participante_actual']) ? (int) $_SESSION['cod_participante_actual'] : 0;
        $hayParticipanteActivo = $codParticipanteActivo > 0;
        $formulariosCompletos = !empty($formulariosRellenados['actividad'])
            && !empty($formulariosRellenados['alimentacion'])
            && !empty($formulariosRellenados['sueno'])
            && !empty($formulariosRellenados['antropometrico']);
        if (!in_array($formularioSeleccionado, $formulariosValidos, true)) {
            $formularioSeleccionado = 'actividad';
        }

        function etiquetaRellenado($clave, $formulariosRellenados) {
            return !empty($formulariosRellenados[$clave]) ? ' (Rellenado)' : '';
        }
    ?>

    <h1>Formularios Disponibles</h1>

    <?php if ($participanteSet): ?>
        <p><strong>Participante guardado correctamente. Ya puedes rellenar formularios.</strong></p>
    <?php endif; ?>

    <?php if ($needParticipante): ?>
        <p><strong>Para acceder a cualquier formulario debes anadir un participante con codigo, sexo, edad y centro.</strong></p>
    <?php endif; ?>

    <?php if (!$hayParticipanteActivo): ?>
        <section>
            <h2>Registrar participante obligatorio</h2>
            <form action="./index.php" method="POST">
                <input type="hidden" name="action" value="insertarParticipante">
                <input type="hidden" name="origen" value="forms">

                <label for="cod_participante_required">Codigo participante</label>
                <input id="cod_participante_required" name="cod_participante" type="number" min="1" required><br>

                <label for="centro_required">Centro</label>
                <select id="centro_required" name="centro" required>
                    <option value="">Selecciona centro</option>
                    <option value="IES Fernando Zobel">IES Fernando Zobel</option>
                    <option value="CIFP N1">CIFP N1</option>
                    <option value="IES Lorenzo Hervas y Panduro">IES Lorenzo Hervas y Panduro</option>
                </select><br>

                <label for="familia_required">Familia profesional</label>
                <select id="familia_required" name="familia" required>
                    <option value="">Selecciona familia</option>
                    <option value="Sanidad">Sanidad</option>
                    <option value="Salud">Salud</option>
                    <option value="Informatica y Comunicaciones">Informatica y Comunicaciones</option>
                    <option value="Seguridad y Medio Ambiente">Seguridad y Medio Ambiente</option>
                </select><br>

                <label for="sexo_required">Sexo</label>
                <select id="sexo_required" name="sexo" required>
                    <option value="">Selecciona sexo</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Prefiere no indicar">Prefiere no indicar</option>
                </select><br>

                <label for="edad_required">Edad</label>
                <input id="edad_required" name="edad" type="number" min="1" max="120" required><br>

                <button type="submit">Guardar participante</button>
            </form>
        </section>
    <?php else: ?>
        <p><strong>Participante activo: <?php echo $codParticipanteActivo; ?></strong></p>

        <div>
            <a href="./index.php?action=forms&form=actividad" id="btnActi">Actividad fisica<?= etiquetaRellenado('actividad', $formulariosRellenados) ?></a>
            <a href="./index.php?action=forms&form=alimentacion" id="btnAlim">Alimentacion<?= etiquetaRellenado('alimentacion', $formulariosRellenados) ?></a>
            <a href="./index.php?action=forms&form=sueno" id="btnSueno">Habito de sueno<?= etiquetaRellenado('sueno', $formulariosRellenados) ?></a>
            <a href="./index.php?action=forms&form=antropometrico" id="btnAntro">Datos antropometricos<?= etiquetaRellenado('antropometrico', $formulariosRellenados) ?></a>
        </div>

    <?php if ($guardadoOk): ?>
        <p><strong>Formulario guardado correctamente.</strong></p>
    <?php endif; ?>
    <?php if ($guardadoError): ?>
        <p><strong>No se pudo guardar el formulario.</strong></p>
    <?php endif; ?>
    <?php if ($formularioRellenado): ?>
        <p><strong>Este formulario ya esta rellenado y se encuentra bloqueado.</strong></p>
    <?php endif; ?>

    <?php if ($formulariosCompletos): ?>
        <p><strong>Has completado todos los formularios de este participante.</strong></p>
        <form action="./index.php" method="POST">
            <input type="hidden" name="action" value="nuevoParticipanteForms">
            <button type="submit">Anadir otro participante</button>
        </form>
    <?php endif; ?>

        <hr>
    <?php if ($formularioSeleccionado === 'actividad'): ?>
    <section id="actividad">
        <h2>Formulario de Actividad</h2>
        <form action="./index.php" method="POST">
            <input type="hidden" name="action" value="insertarActividad">
            <input type="hidden" name="cod_participante" value="<?php echo $codParticipanteActivo; ?>">
            <fieldset <?= $formularioRellenado ? 'disabled' : '' ?>>

            <p>Codigo participante: <strong><?php echo $codParticipanteActivo; ?></strong></p>

            <label for="AcF1">1. Durante los ultimos 7 dias, en cuantos dias realizo actividades fisicas intensas (levantar pesos pesados, cavar, ejercicios aerobicos o bici rapida)?</label>
            <input id="AcF1" name="AcF1" type="number" min="0" max="7" required>
            <small>Dias por semana (0-7). Si es 0, pase a la pregunta 3.</small><br>

            <label for="AcF2">2. Habitualmente, cuanto tiempo total dedico a actividad fisica intensa en uno de esos dias?</label>
            <input id="AcF2" name="AcF2" type="number" min="0" max="1440">
            <label>
                <input type="checkbox" onchange="document.getElementById('AcF2').value = this.checked ? -1 : ''; document.getElementById('AcF2').readOnly = this.checked;">
                No sabe/no esta seguro
            </label><br>

            <label for="AcF3">3. Durante los ultimos 7 dias, en cuantos dias hizo actividad fisica moderada (transportar pesos livianos o bici a velocidad regular, sin incluir caminar)?</label>
            <input id="AcF3" name="AcF3" type="number" min="0" max="7" required>
            <small>Dias por semana (0-7). Si es 0, pase a la pregunta 5.</small><br>

            <label for="AcF4">4. Habitualmente, cuanto tiempo total dedico a actividad fisica moderada en uno de esos dias?</label>
            <input id="AcF4" name="AcF4" type="number" min="0" max="1440">
            <label>
                <input type="checkbox" onchange="document.getElementById('AcF4').value = this.checked ? -1 : ''; document.getElementById('AcF4').readOnly = this.checked;">
                No sabe/no esta seguro
            </label><br>

            <label for="AcF5">5. Durante los ultimos 7 dias, en cuantos dias camino al menos 10 minutos seguidos?</label>
            <input id="AcF5" name="AcF5" type="number" min="0" max="7" required>
            <small>Dias por semana (0-7). Si es 0, pase a la pregunta 7.</small><br>

            <label for="AcF6">6. Habitualmente, cuanto tiempo total dedico a caminar en uno de esos dias?</label>
            <input id="AcF6" name="AcF6" type="number" min="0" max="1440">
            <label>
                <input type="checkbox" onchange="document.getElementById('AcF6').value = this.checked ? -1 : ''; document.getElementById('AcF6').readOnly = this.checked;">
                No sabe/no esta seguro
            </label><br>

            <label for="AcF7">7. Durante los ultimos 7 dias, cuanto tiempo paso sentado durante un dia habil?</label>
            <input id="AcF7" name="AcF7" type="number" min="0" max="1440" required>
            <label>
                <input type="checkbox" onchange="document.getElementById('AcF7').value = this.checked ? -1 : ''; document.getElementById('AcF7').readOnly = this.checked;">
                No sabe/no esta seguro
            </label><br>

            <button type="submit">Guardar Actividad</button>
            </fieldset>
        </form>
    </section>
    <?php endif; ?>

    <?php if ($formularioSeleccionado === 'alimentacion'): ?>
    <section id="alimentacion">
        <h2>Formulario de Alimentacion</h2>
        <?php if ($alimentacionResultado): ?>
            <div class="alert alert-info" role="alert">
                <strong>Puntuacion de alimentacion: <?php echo (int) $alimentacionResultado['total']; ?> / <?php echo (int) $alimentacionResultado['maximo']; ?></strong>
                (Si = 1, No = 0)
            </div>
        <?php endif; ?>
        <form action="./index.php" method="POST">
            <input type="hidden" name="action" value="insertarAlimentacion">
            <input type="hidden" name="cod_participante" value="<?php echo $codParticipanteActivo; ?>">
            <fieldset <?= $formularioRellenado ? 'disabled' : '' ?>>

            <p>Codigo participante: <strong><?php echo $codParticipanteActivo; ?></strong></p>

            <p>Selecciona Si o No para cada item.</p>

            <label>Ali1 - Usas aceite de oliva como grasa principal para cocinar?</label>
            <input id="Ali1_si" name="Ali1" type="radio" value="1" required>
            <label for="Ali1_si">Si</label>
            <input id="Ali1_no" name="Ali1" type="radio" value="0" required>
            <label for="Ali1_no">No</label><br>

            <label>Ali2 - Tomas 4 o mas cucharadas de aceite de oliva al dia?</label>
            <input id="Ali2_si" name="Ali2" type="radio" value="1" required>
            <label for="Ali2_si">Si</label>
            <input id="Ali2_no" name="Ali2" type="radio" value="0" required>
            <label for="Ali2_no">No</label><br>

            <label>Ali3 - Tomas 2 o mas raciones de verduras u hortalizas al dia?</label>
            <input id="Ali3_si" name="Ali3" type="radio" value="1" required>
            <label for="Ali3_si">Si</label>
            <input id="Ali3_no" name="Ali3" type="radio" value="0" required>
            <label for="Ali3_no">No</label><br>

            <label>Ali4 - Tomas 3 o mas piezas de fruta al dia?</label>
            <input id="Ali4_si" name="Ali4" type="radio" value="1" required>
            <label for="Ali4_si">Si</label>
            <input id="Ali4_no" name="Ali4" type="radio" value="0" required>
            <label for="Ali4_no">No</label><br>

            <label>Ali5 - Tomas menos de 1 racion al dia de carne roja, hamburguesa o embutido?</label>
            <input id="Ali5_si" name="Ali5" type="radio" value="1" required>
            <label for="Ali5_si">Si</label>
            <input id="Ali5_no" name="Ali5" type="radio" value="0" required>
            <label for="Ali5_no">No</label><br>

            <label>Ali6 - Tomas menos de 1 racion al dia de mantequilla, margarina o nata?</label>
            <input id="Ali6_si" name="Ali6" type="radio" value="1" required>
            <label for="Ali6_si">Si</label>
            <input id="Ali6_no" name="Ali6" type="radio" value="0" required>
            <label for="Ali6_no">No</label><br>

            <label>Ali7 - Tomas menos de 1 bebida azucarada al dia?</label>
            <input id="Ali7_si" name="Ali7" type="radio" value="1" required>
            <label for="Ali7_si">Si</label>
            <input id="Ali7_no" name="Ali7" type="radio" value="0" required>
            <label for="Ali7_no">No</label><br>

            <label>Ali8 - Tomas 7 o mas copas de vino a la semana?</label>
            <input id="Ali8_si" name="Ali8" type="radio" value="1" required>
            <label for="Ali8_si">Si</label>
            <input id="Ali8_no" name="Ali8" type="radio" value="0" required>
            <label for="Ali8_no">No</label><br>

            <label>Ali9 - Tomas 3 o mas raciones de legumbres a la semana?</label>
            <input id="Ali9_si" name="Ali9" type="radio" value="1" required>
            <label for="Ali9_si">Si</label>
            <input id="Ali9_no" name="Ali9" type="radio" value="0" required>
            <label for="Ali9_no">No</label><br>

            <label>Ali10 - Tomas 3 o mas raciones de pescado o marisco a la semana?</label>
            <input id="Ali10_si" name="Ali10" type="radio" value="1" required>
            <label for="Ali10_si">Si</label>
            <input id="Ali10_no" name="Ali10" type="radio" value="0" required>
            <label for="Ali10_no">No</label><br>

            <label>Ali11 - Tomas menos de 2 veces por semana bolleria industrial o dulces?</label>
            <input id="Ali11_si" name="Ali11" type="radio" value="1" required>
            <label for="Ali11_si">Si</label>
            <input id="Ali11_no" name="Ali11" type="radio" value="0" required>
            <label for="Ali11_no">No</label><br>

            <label>Ali12 - Tomas 3 o mas raciones de frutos secos a la semana?</label>
            <input id="Ali12_si" name="Ali12" type="radio" value="1" required>
            <label for="Ali12_si">Si</label>
            <input id="Ali12_no" name="Ali12" type="radio" value="0" required>
            <label for="Ali12_no">No</label><br>

            <label>Ali13 - Prefieres carne blanca (pollo, pavo, conejo) frente a carne roja?</label>
            <input id="Ali13_si" name="Ali13" type="radio" value="1" required>
            <label for="Ali13_si">Si</label>
            <input id="Ali13_no" name="Ali13" type="radio" value="0" required>
            <label for="Ali13_no">No</label><br>

            <label>Ali14 - Tomas 2 o mas veces por semana sofrito (tomate, ajo, cebolla)?</label>
            <input id="Ali14_si" name="Ali14" type="radio" value="1" required>
            <label for="Ali14_si">Si</label>
            <input id="Ali14_no" name="Ali14" type="radio" value="0" required>
            <label for="Ali14_no">No</label><br>

            <button type="submit">Guardar Alimentacion</button>
            </fieldset>
        </form>
    </section>
    <?php endif; ?>

    <?php if ($formularioSeleccionado === 'sueno'): ?>
    <section id="sueno">
        <h2>Formulario de Sueno</h2>
        <?php if ($psqiResultado): ?>
            <div class="alert alert-info" role="alert">
                <strong>Tu puntuacion PSQI total es: <?php echo (int) $psqiResultado['total']; ?></strong><br>
                Item 1: <?php echo (int) $psqiResultado['item1']; ?> |
                Item 2: <?php echo (int) $psqiResultado['item2']; ?> |
                Item 3: <?php echo (int) $psqiResultado['item3']; ?> |
                Item 4: <?php echo (int) $psqiResultado['item4']; ?> |
                Item 5: <?php echo (int) $psqiResultado['item5']; ?> |
                Item 6: <?php echo (int) $psqiResultado['item6']; ?> |
                Item 7: <?php echo (int) $psqiResultado['item7']; ?><br>
                Eficiencia habitual de sueno: <?php echo htmlspecialchars((string) $psqiResultado['eficiencia'], ENT_QUOTES, 'UTF-8'); ?>%
            </div>
        <?php endif; ?>
        <form action="./index.php" method="POST">
            <input type="hidden" name="action" value="insertarSuenyo">
            <input type="hidden" name="cod_participante" value="<?php echo $codParticipanteActivo; ?>">
            <fieldset <?= $formularioRellenado ? 'disabled' : '' ?>>

            <p>Codigo participante: <strong><?php echo $codParticipanteActivo; ?></strong></p>

            <label for="Sue1">Sue1 - Hora de acostarse</label>
            <input id="Sue1" name="Sue1" type="time" required><br>

            <label for="Sue2">Sue2 - Cuanto tiempo tardas en dormirte?</label>
            <select id="Sue2" name="Sue2" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Menos de 15 min</option>
                <option value="1">Entre 16-30 min</option>
                <option value="2">Entre 31-60 min</option>
                <option value="3">Mas de 60 min</option>
            </select><br>

            <label for="Sue3">Sue3 - Hora de levantarse</label>
            <input id="Sue3" name="Sue3" type="time" required><br>

            <label for="Sue4">Sue4 - Horas dormidas reales</label>
            <input id="Sue4" name="Sue4" type="number" min="0" max="24" step="0.1" required><br>

            <p>5.- Durante el ultimo mes, cuantas veces ha tenido problemas para dormir a causa de:</p>

            <label for="Sue5a">5a) No poder conciliar el sueno en la primera media hora</label>
            <select id="Sue5a" name="Sue5a" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5b">5b) Despertarse durante la noche o de madrugada</label>
            <select id="Sue5b" name="Sue5b" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5c">5c) Tener que levantarse para ir al servicio</label>
            <select id="Sue5c" name="Sue5c" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5d">5d) No poder respirar bien</label>
            <select id="Sue5d" name="Sue5d" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5e">5e) Toser o roncar ruidosamente</label>
            <select id="Sue5e" name="Sue5e" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5f">5f) Sentir frio</label>
            <select id="Sue5f" name="Sue5f" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5g">5g) Sentir demasiado calor</label>
            <select id="Sue5g" name="Sue5g" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5h">5h) Tener pesadillas o malos suenos</label>
            <select id="Sue5h" name="Sue5h" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5i">5i) Sufrir dolores</label>
            <select id="Sue5i" name="Sue5i" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5j">5j) Otras razones</label>
            <select id="Sue5j" name="Sue5j" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue5j_Desc">5j) Describa esas otras razones</label>
            <input id="Sue5j_Desc" name="Sue5j_Desc" type="text" maxlength="255"><br>

            <label for="Sue6">6) Durante el ultimo mes, como valoraria en conjunto la calidad de su sueno?</label>
            <select id="Sue6" name="Sue6" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Muy buena</option>
                <option value="1">Bastante buena</option>
                <option value="2">Bastante mala</option>
                <option value="3">Muy mala</option>
            </select><br>

            <label for="Sue7">7) Durante el ultimo mes, cuantas veces ha tomado medicinas para dormir?</label>
            <select id="Sue7" name="Sue7" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue8">8) Durante el ultimo mes, cuantas veces ha sentido somnolencia mientras conducia, comia u otra actividad?</label>
            <select id="Sue8" name="Sue8" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ninguna vez en el ultimo mes</option>
                <option value="1">Menos de una vez a la semana</option>
                <option value="2">Una o dos veces a la semana</option>
                <option value="3">Tres o mas veces a la semana</option>
            </select><br>

            <label for="Sue9">9) Durante el ultimo mes, cuanto problema ha tenido para mantener animos en actividades diarias?</label>
            <select id="Sue9" name="Sue9" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Ningun problema</option>
                <option value="1">Solo un leve problema</option>
                <option value="2">Un problema</option>
                <option value="3">Un grave problema</option>
            </select><br>

            <label for="Sue10">10) Duerme usted solo o acompanado?</label>
            <select id="Sue10" name="Sue10" required>
                <option value="">Selecciona una opcion</option>
                <option value="0">Solo</option>
                <option value="1">Con alguien en otra habitacion</option>
                <option value="2">En la misma habitacion, pero en otra cama</option>
                <option value="3">En la misma cama</option>
            </select><br>

            <button type="submit">Guardar Sueno</button>
            </fieldset>
        </form>
    </section>
    <?php endif; ?>

    <?php if ($formularioSeleccionado === 'antropometrico'): ?>
    <section id="antropometrico">
        <h2>Formulario Antropometrico</h2>
        <form action="./index.php" method="POST">
            <input type="hidden" name="action" value="insertarAntropometrico">
            <input type="hidden" name="cod_participante" value="<?php echo $codParticipanteActivo; ?>">
            <fieldset <?= $formularioRellenado ? 'disabled' : '' ?>>

            <p>Codigo participante: <strong><?php echo $codParticipanteActivo; ?></strong></p>

            <label for="Ant1">Ant1 - Peso (kg)</label>
            <input id="Ant1" name="Ant1" type="number" step="0.01" required><br>
            <label for="Ant2">Ant2 - Talla (cm)</label>
            <input id="Ant2" name="Ant2" type="number" step="0.01" required><br>
            <label for="Ant3">Ant3 - IMC</label>
            <input id="Ant3" name="Ant3" type="number" step="0.01" required><br>

            <label for="Ant4">Ant4 - Clasificacion IMC</label>
            <select id="Ant4" name="Ant4" required>
                <option value="">-- Selecciona --</option>
                <option value="Bajo peso">Bajo peso</option>
                <option value="Normopeso">Normopeso</option>
                <option value="Sobrepeso">Sobrepeso</option>
                <option value="Obesidad">Obesidad</option>
            </select><br>

            <label for="Ant5">Ant5 - Cintura (cm)</label>
            <input id="Ant5" name="Ant5" type="number" step="0.01" required><br>
            <label for="Ant6">Ant6 - Cadera (cm)</label>
            <input id="Ant6" name="Ant6" type="number" step="0.01" required><br>
            <label for="Ant7">Ant7 - ICC</label>
            <input id="Ant7" name="Ant7" type="number" step="0.01" required><br>
            <label for="Ant8">Ant8 - Indice cintura-altura</label>
            <input id="Ant8" name="Ant8" type="number" step="0.01" required><br>
            <label for="Ant9">Ant9 - Pliegue tricipital (mm)</label>
            <input id="Ant9" name="Ant9" type="number" step="0.01" required><br>
            <label for="Ant10">Ant10 - Perimetro brazo relajado (cm)</label>
            <input id="Ant10" name="Ant10" type="number" step="0.01" required><br>
            <label for="Ant11">Ant11 - PMB (cm)</label>
            <input id="Ant11" name="Ant11" type="number" step="0.01" required><br>
            <label for="Ant12">Ant12 - Masa muscular total</label>
            <input id="Ant12" name="Ant12" type="number" step="0.01" required><br>
            <label for="Ant13">Ant13 - Grasa corporal total (%)</label>
            <input id="Ant13" name="Ant13" type="number" step="0.01" required><br>
            <label for="Ant14">Ant14 - Hidratacion corporal (%)</label>
            <input id="Ant14" name="Ant14" type="number" step="0.01" required><br>
            <label for="Ant15">Ant15 - Grasa visceral</label>
            <input id="Ant15" name="Ant15" type="number" required><br>
            <label for="Ant16">Ant16 - Masa osea (kg)</label>
            <input id="Ant16" name="Ant16" type="number" step="0.01" required><br>
            <label for="Ant17">Ant17 - Edad metabolica</label>
            <input id="Ant17" name="Ant17" type="number" required><br>

            <label for="Ant18_BD">Ant18_BD - Muscular brazo derecho</label>
            <input id="Ant18_BD" name="Ant18_BD" type="number" step="0.01" required><br>
            <label for="Ant18_BI">Ant18_BI - Muscular brazo izquierdo</label>
            <input id="Ant18_BI" name="Ant18_BI" type="number" step="0.01" required><br>
            <label for="Ant18_PD">Ant18_PD - Muscular pierna derecha</label>
            <input id="Ant18_PD" name="Ant18_PD" type="number" step="0.01" required><br>
            <label for="Ant18_PI">Ant18_PI - Muscular pierna izquierda</label>
            <input id="Ant18_PI" name="Ant18_PI" type="number" step="0.01" required><br>

            <label for="Ant19_BD">Ant19_BD - Grasa brazo derecho</label>
            <input id="Ant19_BD" name="Ant19_BD" type="number" step="0.01" required><br>
            <label for="Ant19_BI">Ant19_BI - Grasa brazo izquierdo</label>
            <input id="Ant19_BI" name="Ant19_BI" type="number" step="0.01" required><br>
            <label for="Ant19_PD">Ant19_PD - Grasa pierna derecha</label>
            <input id="Ant19_PD" name="Ant19_PD" type="number" step="0.01" required><br>
            <label for="Ant19_PI">Ant19_PI - Grasa pierna izquierda</label>
            <input id="Ant19_PI" name="Ant19_PI" type="number" step="0.01" required><br>

            <label for="Ant20">Ant20 - FC reposo (lpm)</label>
            <input id="Ant20" name="Ant20" type="number" required><br>

            <label for="Ant21">Ant21 - Observaciones</label><br>
            <textarea id="Ant21" name="Ant21" rows="4" cols="50"></textarea><br>

            <button type="submit">Guardar Antropometrico</button>
            </fieldset>
        </form>
    </section>
    <?php endif; ?>
    <?php endif; ?>
</body> 
</html>