<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentaciones Admin</title>
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

    <main class="container">
        <h1>Presentaciones del Administrador</h1>
        <p>Vista exclusiva para administradores.</p>
        <ul>
            <li>Resumen de gestion de usuarios.</li>
            <li>Revision global de formularios.</li>
            <li>Seguimiento de datos por participante.</li>
        </ul>
    </main>
    <section class="container graficas">
        <h1 class="text-center">Representaciones Graficas</h1><br>
        <div class="container-fluid  w-100 d-flex flex-column justify-content-center">
            <div class="row g-3 d-flex justify-content-evenly pb-3">
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#IMCfamilia">IMC por Familia</button>
                    
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#IMCsexo">IMC por sexo</button>
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#IMCcentro">IMC por centro</button>
                </div>
            </div>
            <div class="row g-3 d-flex justify-content-evenly pb-3">
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#ICAfamilia">ICA por Familia</button>
                    
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#ICAcentro">ICA por centro</button>
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center"> 
                    <button data-bs-toggle="modal" data-bs-target="#ICCsexo">ICC por sexo</button>
                </div>
                
            </div>
            <div class="row g-3 d-flex justify-content-evenly pb-3">
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#IMCdieta">IMC según Adherencia a Dieta Mediterranea</button>
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#ICAdieta">ICA según Adherencia a Dieta Mediterranea</button>
                    
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#ICCdieta">ICC según Adherencia a Dieta Mediterranea</button>
                </div> 
            </div>
            
            <div class="row g-2 d-flex justify-content-evenly pb-3">
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#NubeIMCfamilia">Nube IMC por Familia</button>
                    
                </div>
                <div class="col-md-4 d-flex justify-content-center  flex-column align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#IMCgrasa">IMC por Grasa Corporal Total</button>
                </div> 
            </div>
        </div>
    </section>
</body>
</html>


<div id="modales">
    <div class="modal fade" id="IMCfamilia" tabindex="-1" aria-labelledby="IMCfamiliaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="familiaIMC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="IMCsexo" tabindex="-1" aria-labelledby="IMCsexoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="sexoIMC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="IMCcentro" tabindex="-1" aria-labelledby="IMCcentroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="centroIMC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="ICAfamilia" tabindex="-1" aria-labelledby="ICAfamiliaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="familiaICA" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="ICAcentro" tabindex="-1" aria-labelledby="ICAcentroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="centroICA" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="ICCsexo" tabindex="-1" aria-labelledby="ICCsexoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="sexoICC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="NubeIMCfamilia" tabindex="-1" aria-labelledby="NubeIMCfamiliaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="familiaIMCP" class="w-100 bg-white" >

                </svg>
            </div>
        </div>              
    </div>
    <div class="modal fade" id="IMCgrasa" tabindex="-1" aria-labelledby="IMCgrasaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="grasaIMC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>
    </div> 
    <div class="modal fade" id="IMCdieta" tabindex="-1" aria-labelledby="IMCdietaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="dietaIMC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="ICAdieta" tabindex="-1" aria-labelledby="ICAdietaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="dietaICA" class="w-100 bg-white" >

                </svg>
            </div>
        </div>
    </div>  
    <div class="modal fade" id="ICCdieta" tabindex="-1" aria-labelledby="ICCdietaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >    
                <svg id="dietaICC" class="w-100 bg-white" >

                </svg>
            </div>
        </div>
    </div>    
</div>
           