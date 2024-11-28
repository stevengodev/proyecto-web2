<?php

require '../../funciones/funciones.php';
require '../../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

$resultado = mostrarCitasProximas($fecha, $bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Recordatorio de citas</title>
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

                        <a class="nav-link" href="menusecretaria.php">
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
                                <a class="nav-link" href="registrarusuario.php">Registrar usuario</a>
                                <a class="nav-link " href="recordatorioCitas.php">Recordatorio de citas</a>
                                <a class="nav-link " href="facturarServicio.php">facturar Servicio</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Recordatorio de citas</h1>

                    <div class="form-group">
                        <p>Hora actual: <?php echo $fecha; ?> </p>
                    </div>

                    <a href="recordatorioCitas.php" class="btn btn-success">Actualizar</a>


                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php while ($fila = $resultado->fetch_assoc()) {?>
                            
                                <tr>
                                <td><?php echo $fila['nombres']; ?></td>
                                <td><?php echo $fila['apellidos']; ?></td>
                                <td><?php echo $fila['celular']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                            </tr>
                            
                            <?php } ?>

                        </tbody>
                    </table>

                </div>
            </main>

            <?php require "../templates/footer.php" ?>


        </div>
    </div>
    <script src="../../assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>