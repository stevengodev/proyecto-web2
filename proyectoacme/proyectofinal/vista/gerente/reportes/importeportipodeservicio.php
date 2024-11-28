<?php

session_start();

$tipoIdentificacionGerente = $_SESSION['tipoidentificacionempleado'];
$identificacionGerente = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionGerente == null || $tipoIdentificacionGerente == '') && ($identificacionGerente == null || $identificacionGerente == '')) {
    header("Location: ../../login.php");
}

require '../../../funciones/funciones.php';
require '../../../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$resultado = importePorServicio($bd);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Importes por servicios</title>
    <link href="/proyectofinal/assets/css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Header -->
    <?php require '../../templates/header.php'; ?>
    <!-- Fin Header -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Navegacion</div>

                        <a class="nav-link" href="../menugerente.php">
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
                                <a class="nav-link" href="../serviciosofertados.php">Servicios ofertados</a>
                                <a class="nav-link " href="../reportesfinancieros.php">Reportes financieros</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main class="centrar-main">
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Importe por tipo de servicio</h1>
                    <br>
                </div>
            </main>

            <div class="container-fluid px-4">
                <table class="table table-striped">
                    <thead style="background-color: black; color: white;">
                        <tr>
                            <th scope="col">Servicio</th>
                            <th scope="col">Ganancias por servicio</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($fila = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['ganancia']; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <?php require "../../templates/footer.php"; ?>

        </div>
    </div>
    <script src="/proyectofinal/assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

</body>

</html>