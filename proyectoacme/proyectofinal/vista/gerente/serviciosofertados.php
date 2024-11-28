<?php

require '../../componentes/conexionbd.php';
require '../../controladores/controladorservicios.php';

session_start();

$tipoIdentificacionGerente = $_SESSION['tipoidentificacionempleado'];
$identificacionGerente = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionGerente == null || $tipoIdentificacionGerente == '') && ($identificacionGerente == null || $identificacionGerente == '')) {
    header("Location: ../login.php");
}

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorServicio = new ControladorServicios();
$resultado = $controladorServicio->listar($bd);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Servicios ofertados</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Header -->
    <?php require "../templates/header.php"; ?>
    <!-- Fin Header -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Navegacion</div>

                        <a class="nav-link" href="menugerente.php">
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
                                <a class="nav-link" href="serviciosofertados.php" style="color: #0d6efd;">Servicios
                                    ofertados</a>
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
                    <h1 class="mt-4">Servicios ofertados</h1>
                </div>
            </main>
            <div class="container-fluid px-4">
                <table class="table table-striped">
                    <thead style="background-color: black; color: white;">
                        <tr>
                            <th>Identificador</th>
                            <th>Servicio</th>
                            <th>Eliminar servicio</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($fila = $resultado->fetch_assoc()) { ?>

                           <?php if ($fila['estado'] == 'activo') { ?>
                            <tr>
                                <td><?php echo $fila['identificador']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>

                                <td>
                                    <form action="../crud/crudServicio.php" method="post">
                                        <input type="hidden" name="operacion" value="eliminar">
                                        <input type="hidden" name="identificador" value="<?php echo $fila['identificador']; ?>">
                                        <input type="submit" class="btn btn-danger" name="" value="Eliminar">
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>

                        <?php  } ?>

                    </tbody>
                </table>
            </div>

            <?php require "../templates/footer.php"; ?>

        </div>
    </div>
    <script src="../../javascript/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>

</html>