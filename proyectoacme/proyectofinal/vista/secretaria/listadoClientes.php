<?php

require '../../componentes/conexionbd.php';
require '../../controladores/controladorcliente.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorCliente = new ControladorClientes();
$resultado = $controladorCliente->listar($bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Clientes</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
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

                        <a class="nav-link" href="menuCliente.php">
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
                    <h1 class="mt-4">Listado de clientes</h1>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de identificacion</th>
                                <th>Identificacion</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $fila['tipoidentificacion']; ?></td>
                                    <td><?php echo $fila['identificacion']; ?></td>
                                    <td><?php echo $fila['nombres']; ?></td>
                                    <td><?php echo $fila['apellidos']; ?></td>

                                    <td class="d-flex">
                                        <a href="editarCliente.php?tipoidentificacioncliente=<?php echo $fila['tipoidentificacion'] . '&identificacioncliente=' . $fila['identificacion']; ?>" ; class="btn btn-warning" style="margin-right: 10px;">Editar</a>
                                        <form action="../crud/crudCliente.php" method="post">
                                            <input type="hidden" name="operacion" value="eliminar">
                                            <input type="hidden" name="tipoidentificacioncliente" value="<?php echo $fila['tipoidentificacion']; ?>">
                                            <input type="hidden" name="identificacioncliente" value="<?php echo $fila['identificacion']; ?>">
                                            <input type="submit" class="btn btn-danger" value="Eliminar">
                                            <input type="hidden" name="rol" value="profesional">
                                        </form>
                                    </td>
                                </tr>
                            <?php  } ?>

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