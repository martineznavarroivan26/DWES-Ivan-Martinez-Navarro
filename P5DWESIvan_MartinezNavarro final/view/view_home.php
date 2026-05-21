<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto API</title>

    <!-- import de bootstrap -->
    <link rel="stylesheet" href="./view/css/bootstrap.min.css">

    <!-- import de los estilos -->
    <link rel="stylesheet" href="./view/css/styles.css?v=2">
    <link rel="stylesheet" href="./view/css/template.css?v=3">

    <script src="./js/bootstrap.bundle.min.js" defer></script>

    <!-- import del jquery -->
    <script src="./js/jquery-4.0.0.js" defer></script>
    <script src="./js/navegacion.js" defer></script>
    <script src="./js/d3.v7.min.js" defer></script>
    <script type="module" src="./js/graficas.js" defer></script>

</head>
<body>
    <header>
        <?php require_once './view/templates/header.php'; ?>
    </header>

    <main>
        <section class="container">
            <h2>Bienvenido al proyecto Salud en Primera Persona</h2>

            <p>El Instituto de Enseñanza Secundaria Fernando Zóbel junto con el Instituto de Enseñanza Secundaria Lorenzo Hervás y Panduro quieren poner en marcha y hacer realidad el proyecto titulado Salud en primera persona. Para poder llevarlo a cabo han contactado con el Centro Integrado de Formación Profesional N.º 1 de Cuenca para que el alumnado de segundo del Ciclo de Grado Superior de Desarrollo de Aplicaciones Web desarrolle una aplicación web para dar soporte al proyecto: (1) recogida de datos y (2) análisis y difusión de resultados obtenidos.</p>

            <div class="home-grid">
                <article class="home-card">
                    <h3>Objetivo</h3>
                    <p>Digitalizar la recogida de informacion sobre alimentacion, actividad fisica y sueno para disponer de datos fiables, organizados y comparables.</p>
                </article>
                <article class="home-card">
                    <h3>Flujo de trabajo</h3>
                    <p>1) Recogida estructurada de datos. 2) Almacenamiento centralizado en la aplicacion. 3) Analisis y difusion de resultados de forma visual.</p>
                </article>
                <article class="home-card">
                    <h3>Modulos principales</h3>
                    <p>Formularios de cuestionarios, API de respuestas, panel de analiticas, gestion de usuarios y apoyo a la toma de decisiones educativas.</p>
                </article>
            </div>
            <section class="container">
                <h3>Resultados del proyecto</h3>

                <div id="carruselCards" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="hover">
                    <div class="carousel-inner">
                        <div class="carousel-item active w-100">
                            <svg id="familiaIMC" class="w-100 bg-white"></svg>
                        </div>
                        <div class="carousel-item w-100">
                            <svg id="sexoIMC" class="w-100 bg-white"></svg>
                        </div>
                        <div class="carousel-item w-100">
                            <svg id="centroIMC" class="w-100 bg-white"></svg>
                        </div>
                        <div class="carousel-item w-100">
                            <svg id="familiaICA" class="w-100 bg-white"></svg>
                        </div>
                        <div class="carousel-item w-100">
                            <svg id="centroICA" class="w-100 bg-white"></svg>
                        </div>
                        <div class="carousel-item w-100">
                            <svg id="sexoICC" class="w-100 bg-white"></svg>
                        </div>
                    </div>

                    <!-- Controles -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carruselCards" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carruselCards" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                </div>
                
            </section>

            <section class="home-logos">
                <h3>Entidades colaboradoras</h3>
                <div class="logos-strip">
                    <img src="./view/recursos/JCCM.png" alt="JCCM">
                    <img src="./view/recursos/logo_rehecho_fondo_blanco.png" alt="Salud en primera persona">
                    <img src="./view/recursos/Logo.png" alt="Logo del proyecto">
                    <img src="./view/recursos/FP_CLM.jpg" alt="FP Castilla-La Mancha">
                    <img src="./view/recursos/cifpcuencanro1.png" alt="CIFP Cuenca">
                    <img src="./view/recursos/Logo Hervás.png" alt="IES Lorenzo Hervas y Panduro">
                    <img src="./view/recursos/Ministerio Educaciขn.png" alt="Ministerio de Educacion">
                    <img src="./view/recursos/es_cofinanciado_logo_peqqueno.png" alt="Cofinanciado">
                </div>
            </section>
        </section>
    </main>

    <footer>
        <?php require_once './view/templates/footer.php'; ?>
    </footer>
</body>
</html>