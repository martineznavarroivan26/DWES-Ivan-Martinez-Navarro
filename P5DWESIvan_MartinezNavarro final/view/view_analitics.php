<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Analiticas</title>
	<!-- import de bootstrap -->
	<link rel="stylesheet" href="./view/css/bootstrap.min.css">

	<!-- import de los estilos -->
	<link rel="stylesheet" href="./view/css/styles.css?v=2">
	<link rel="stylesheet" href="./view/css/template.css?v=3">
    <script src="./js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
	<header>
		<?php require_once './view/templates/header.php'; ?>
	</header>

	<main class="container analytics-page">
		<h1 class="analytics-title">Analiticas y resultados</h1>
		<?php if (isset($_GET['p_deleted']) && $_GET['p_deleted'] === '1'): ?>
			<div class="alert alert-success" role="alert">
				Participante eliminado correctamente.
			</div>
		<?php endif; ?>
		<?php if (isset($_GET['p_error'])): ?>
			<div class="alert alert-danger" role="alert">
				No se pudo eliminar el participante.
			</div>
		<?php endif; ?>
		<hr>
		<?php
			function formatearResultadoEncuesta($resultado) {
				if (!is_array($resultado) || empty($resultado)) {
					return '<span>No rellenada</span>';
				}

				$datos = $resultado;
				unset($datos['cod_participante']);
				if (empty($datos)) {
					return '<span>No rellenada</span>';
				}

				$lineas = '';
				foreach ($datos as $clave => $valor) {
					if (is_array($valor)) {
						$partes = [];
						foreach ($valor as $subClave => $subValor) {
							$subTexto = is_scalar($subValor) || $subValor === null
								? (string) $subValor
								: json_encode($subValor, JSON_UNESCAPED_UNICODE);
							$partes[] = (string) $subClave . ': ' . (string) $subTexto;
						}
						$valorTexto = implode(' | ', $partes);
					} elseif (is_bool($valor)) {
						$valorTexto = $valor ? 'Si' : 'No';
					} elseif ($valor === null || $valor === '') {
						$valorTexto = '-';
					} else {
						$valorTexto = (string) $valor;
					}

					$lineas .= '<div class="result-row">'
						. '<span class="result-key">' . htmlspecialchars((string) $clave, ENT_QUOTES, 'UTF-8') . '</span>'
						. '<span class="result-value">' . htmlspecialchars($valorTexto, ENT_QUOTES, 'UTF-8') . '</span>'
						. '</div>';
				}

				if ($lineas === '') {
					return '<span>No disponible</span>';
				}

				return '<details><summary>Ver resultados</summary><div class="result-list">' . $lineas . '</div></details>';
			}

			function coincideValorORangoEntero($valorEntero, $filtroTexto) {
				$filtroTexto = trim((string) $filtroTexto);
				if ($filtroTexto === '') {
					return true;
				}

				if (preg_match('/^\s*(\d+)\s*-\s*(\d+)\s*$/', $filtroTexto, $coincidencias) === 1) {
					$min = (int) $coincidencias[1];
					$max = (int) $coincidencias[2];
					if ($min > $max) {
						$tmp = $min;
						$min = $max;
						$max = $tmp;
					}

					return $valorEntero >= $min && $valorEntero <= $max;
				}

				if (ctype_digit($filtroTexto)) {
					return $valorEntero === (int) $filtroTexto;
				}

				return false;
			}

			$campoFiltro = $_GET['f_campo'] ?? '';
			$valorFiltro = trim($_GET['f_valor'] ?? '');
			$camposPermitidos = ['cod', 'centro', 'familia', 'edad', 'sexo'];
			if (!in_array($campoFiltro, $camposPermitidos, true)) {
				$campoFiltro = '';
			}

			$participantesFiltrados = $resumenParticipantes;
			if ($campoFiltro !== '' && $valorFiltro !== '') {
				$participantesFiltrados = array_values(array_filter($resumenParticipantes, function ($participante) use ($campoFiltro, $valorFiltro) {
					switch ($campoFiltro) {
						case 'cod':
							return coincideValorORangoEntero((int) ($participante['cod_participante'] ?? 0), $valorFiltro);
						case 'edad':
							return coincideValorORangoEntero((int) ($participante['edad'] ?? 0), $valorFiltro);
						case 'centro':
							return stripos((string) ($participante['centro_educativo'] ?? ''), $valorFiltro) !== false;
						case 'familia':
							return stripos((string) ($participante['familia_profesional'] ?? ''), $valorFiltro) !== false;
						case 'sexo':
							return stripos((string) ($participante['sexo'] ?? ''), $valorFiltro) !== false;
						default:
							return true;
					}
				}));
			}
		?>

		<section class="analytics-filter-box">
			<form action="./index.php" method="GET" class="row g-2 align-items-end">
				<input type="hidden" name="action" value="analisis">

				<div class="col-12 col-md-4">
					<label for="f_campo" class="form-label">Filtrar por</label>
					<select id="f_campo" name="f_campo" class="form-select" required>
						<option value="">Selecciona un campo</option>
						<option value="cod" <?php echo ($campoFiltro === 'cod') ? 'selected' : ''; ?>>Cod</option>
						<option value="centro" <?php echo ($campoFiltro === 'centro') ? 'selected' : ''; ?>>Centro</option>
						<option value="familia" <?php echo ($campoFiltro === 'familia') ? 'selected' : ''; ?>>Familia</option>
						<option value="edad" <?php echo ($campoFiltro === 'edad') ? 'selected' : ''; ?>>Edad</option>
						<option value="sexo" <?php echo ($campoFiltro === 'sexo') ? 'selected' : ''; ?>>Sexo</option>
					</select>
				</div>

				<div class="col-12 col-md-5">
					<label for="f_valor" class="form-label">Valor</label>
					<input id="f_valor" name="f_valor" type="text" class="form-control" value="<?php echo htmlspecialchars($valorFiltro, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Ej: Sanidad | Mujer | 18 | 1001-1020" required>
				</div>

				<div class="col-12 col-md-3 d-flex gap-2">
					<button type="submit" class="btn btn-primary w-100">Filtrar</button>
					<a href="./index.php?action=analisis" class="btn btn-secondary w-100">Limpiar</a>
				</div>
			</form>
		</section>

		<?php if (empty($resumenParticipantes)): ?>
			<p>No hay participantes registrados todavia.</p>
		<?php elseif (empty($participantesFiltrados)): ?>
			<p>No hay resultados con ese filtro.</p>
		<?php else: ?>
			<div class="table-responsive">
				<table class="table table-bordered table-striped align-middle">
					<thead>
						<tr>
							<th>Cod encuestado</th>
							<th>Centro</th>
							<th>Familia</th>
							<th>Edad</th>
							<th>Sexo</th>
							<th>Actividad</th>
							<th>Alimentación</th>
							<th>Sueño</th>
							<th>Antropométrico</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($participantesFiltrados as $participante): ?>
							<tr>
								<td><?php echo (int) $participante['cod_participante']; ?></td>
								<td><?php echo htmlspecialchars($participante['centro_educativo'], ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo htmlspecialchars($participante['familia_profesional'], ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo (int) $participante['edad']; ?></td>
								<td><?php echo htmlspecialchars($participante['sexo'], ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo formatearResultadoEncuesta($participante['actividad']); ?></td>
								<td><?php echo formatearResultadoEncuesta($participante['alimentacion']); ?></td>
								<td><?php echo formatearResultadoEncuesta($participante['sueno']); ?></td>
								<td><?php echo formatearResultadoEncuesta($participante['antropometrico']); ?></td>
								<td>
									<form action="./index.php" method="POST" onsubmit="return confirm('Quieres borrar este participante y sus encuestas?');" style="display:inline;">
										<input type="hidden" name="action" value="eliminarParticipante">
										<input type="hidden" name="cod_participante" value="<?php echo (int) $participante['cod_participante']; ?>">
										<button type="submit" class="btn btn-danger btn-sm">Borrar</button>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</main>

	<div class="modal fade" id="modalParticipante" tabindex="-1" aria-labelledby="modalParticipanteLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalParticipanteLabel">Nuevo participante</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<form action="./index.php" method="POST">
					<div class="modal-body">
						<input type="hidden" name="action" value="insertarParticipante">

						<div class="mb-3">
							<label for="cod_participante" class="form-label">Codigo participante</label>
							<input type="number" class="form-control" id="cod_participante" name="cod_participante" min="1" required>
						</div>

						<div class="mb-3">
							<label for="centro" class="form-label">centro</label>
							<select class="form-select" id="centro" name="centro" required>
								<option value="">Selecciona centro</option>
								<option value="IES Fernando Zóbel">IES Fernando Zóbel</option>
								<option value="CIFP N1">CIFP N1</option>
								<option value="IES Lorenzo Hervás y Panduro">IES Lorenzo Hervás y Panduro</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="familia" class="form-label">familia</label>
							<select class="form-select" id="familia" name="familia" required>
								<option value="">Selecciona familia</option>
								<option value="Sanidad">Sanidad</option>
								<option value="Salud">Salud</option>
								<option value="Informática y Comunicaciones">Informática y Comunicaciones</option>
								<option value="Seguridad y Medio Ambiente">Seguridad y Medio Ambiente</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="sexo" class="form-label">Sexo</label>
							<select class="form-select" id="sexo" name="sexo" required>
								<option value="">Selecciona sexo</option>
								<option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
								<option value="Prefiere no indicar">Prefiere no indicar</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="edad" class="form-label">Edad</label>
							<input type="number" class="form-control" id="edad" name="edad" min="1" max="120" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Guardar participante</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
