<?php

session_start();

$tipoIdentificacionGerente = $_SESSION['tipoidentificacionempleado'];
$identificacionGerente = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionGerente == null || $tipoIdentificacionGerente == '') && ($identificacionGerente == null || $identificacionGerente == '')) {
    header("Location: ../login.php");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Menu gerente</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Header -->
    <?php require '../templates/header.php'; ?>

    <!-- Fin Header -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Navegacion</div>

                        <a class="nav-link" style="color: #0d6efd;" href="#">
                            Menu
                        </a>

                        <!-- <div class="sb-sidenav-menu-heading">Servicios</div> -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Servicios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="serviciosofertados.php">Servicios ofertados</a>
                                <a class="nav-link " href="reportesfinancieros.php">Reportes financieros</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main class="centrar-main">
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Opciones de gerente</h1>
                    <br>
                </div>
            </main>
            <div style="display: flex; justify-content: center;">
                <div style="display: flex; flex-direction: column;">
                    <div class="container-fluid px-4 mb-3">
                        <a href="serviciosofertados.php" class="btn btn-primary btn-lg" role="button" aria-disabled="true" style="width: 500px;">
                            Servicios ofertados
                        </a>
                    </div>
                    <div class="container-fluid px-4">
                        <a href="reportesfinancieros.php" class="btn btn-primary btn-lg" role="button" aria-disabled="true" style="width: 500px; margin-bottom: 15px;">
                            Reportes financieros
                        </a>
                    </div>
                </div>
            </div>
            <footer class="py-4 bg-footer mt-auto">
                <div class="container-fluid px-4">
                    <div>
                        <div class="text-muted text-center"> Todos los derechos reservados &copy; 2022 </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <script src="../../javascript/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>

</html>