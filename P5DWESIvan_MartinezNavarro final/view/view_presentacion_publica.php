<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentacion</title>
    <link rel="stylesheet" href="./view/css/bootstrap.min.css">
    <link rel="stylesheet" href="./view/css/styles.css?v=2">
    <link rel="stylesheet" href="./view/css/template.css?v=3">
    <script src="./js/bootstrap.bundle.min.js" defer></script>
    <script src="./js/d3.v7.min.js" defer></script>
    <script type="module" src="./js/graficas.js" defer></script>
</head>
<body>
    <header>
        <?php require_once './view/templates/header.php'; ?>
    </header>

    <main>
        <section class="container">
            <h2>Presentacion</h2>
            <p>Bienvenido a la presentacion general del proyecto.</p>
            <p>Desde aqui puedes informarte de como van los resultados.</p>
        </section>

        <section class="container">
            <h3>Graficas de resultados</h3>
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <article class="home-card">
                        <h4>IMC por familia profesional</h4>
                        <svg id="familiaIMC" class="w-100 bg-white border rounded" style="min-height: 340px;"></svg>
                    </article>
                </div>
                <div class="col-12 col-lg-6">
                    <article class="home-card">
                        <h4>IMC por sexo</h4>
                        <svg id="sexoIMC" class="w-100 bg-white border rounded" style="min-height: 340px;"></svg>
                    </article>
                </div>
                <div class="col-12">
                    <article class="home-card">
                        <h4>IMC por centro educativo</h4>
                        <svg id="centroIMC" class="w-100 bg-white border rounded" style="min-height: 360px;"></svg>
                    </article>
                </div>

                <div class="col-12 col-lg-6">
                    <article class="home-card">
                        <h4>ICA por familia profesional</h4>
                        <svg id="familiaICA" class="w-100 bg-white border rounded" style="min-height: 340px;"></svg>
                    </article>
                </div>
                <div class="col-12 col-lg-6">
                    <article class="home-card">
                        <h4>ICA por centro educativo</h4>
                        <svg id="centroICA" class="w-100 bg-white border rounded" style="min-height: 340px;"></svg>
                    </article>
                </div>
                <div class="col-12">
                    <article class="home-card">
                        <h4>ICC por sexo</h4>
                        <svg id="sexoICC" class="w-100 bg-white border rounded" style="min-height: 360px;"></svg>
                    </article>
                </div>

            </div>
        </section>
    </main>

    <footer>
        <?php require_once './view/templates/footer.php'; ?>
    </footer>
</body>
</html>
