<?php

session_start();

$tipoIdentificacionProfesional = $_SESSION['tipoidentificacionprofesional'];
$identificacionProfesional = $_SESSION['identificacionprofesional'];

if( ($tipoIdentificacionProfesional == null || $tipoIdentificacionProfesional == '') && ($identificacionProfesional == null || $identificacionProfesional == '') ){
    header("Location: ../login.php");
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Menu profesional</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Header -->
    <?php require "../templates/header.php" ?>
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
                            Privilegios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tratamiento.php">Tratamiento</a>
                                <a class="nav-link" href="diagnostico.php">diagnostico</a>
                                <a class="nav-link" href="asignarCita.php">asignar cita</a>
                                <a class="nav-link" href="listadoCitas.php">Listado de citas</a>

                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main class="centrar-main">
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Menu de profesional</h1>
                    <br>
                </div>

                <div style="display: flex; justify-content: center;">
                    <div style="display: flex; flex-direction: column;">
                        <div class="container-fluid px-4 mb-3">
                            <a href="diagnostico.php" class="btn btn-primary btn-lg" style="width: 500px;">
                                diagnosticar
                            </a>
                        </div>
                        <div class="container-fluid px-4">
                            <a href="tratamiento.php" class="btn btn-primary btn-lg" style="width: 500px; margin-bottom: 15px;">
                                tratamiento
                            </a>
                        </div>

                        <div class="container-fluid px-4">
                            <a href="asignarProfesional.php" class="btn btn-primary btn-lg" style="width: 500px; margin-bottom: 15px;">
                                asignar profesional
                            </a>
                        </div>

                    </div>
                </div>

            </main>



            <?php
            require "../templates/footer.php";
            ?>

        </div>
    </div>
    <script src="../../assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>