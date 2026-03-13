<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Analiticas</title>
	<!-- import de los estilos -->
    <link rel="stylesheet" href="./view/css/styles.css">
    <link rel="stylesheet" href="./view/css/template.css">

    <!-- import de bootstrap -->
    <link rel="stylesheet" href="./view/css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js" defer></script>


    <!-- import script propio modales -->
     <script src="./js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
	<header>
		<?php require_once './view/templates/header.php'; ?>
	</header>

	<main class="container">
		<h1>Analiticas</h1>
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
		<h2>Resultados de encuestas por participante</h2>
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

				$texto = htmlspecialchars(json_encode($datos, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
				return '<details><summary>Ver resultados</summary><small>' . $texto . '</small></details>';
			}
		?>

		<?php if (empty($resumenParticipantes)): ?>
			<p>No hay participantes registrados todavia.</p>
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
							<th>Alimentacion</th>
							<th>Sueno</th>
							<th>Antropometrico</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($resumenParticipantes as $participante): ?>
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
