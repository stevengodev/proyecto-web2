<?php
require '../../funciones/funciones.php';
require '../../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$arregloServicios = [];
$citaId = '';
$nombres = "";
$apellidos = '';
$tipoIdentificacion = '';
$identificacion = '';
$precio = 0;
$costo = 0;
$ganancia = 0;
$precioTotal = 0;
$gananciaTotal = 0;
$costoTotal = 0;
$servicioId = '';
$nombreServicio = '';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $citaId = $_POST['citaId'];
    $resultado = datosNecesariosFactura($citaId, $bd);

    $iterador = 0;

    while ($fila = $resultado->fetch_assoc()) {
        $nombres = $fila['nombres'];
        $apellidos = $fila['apellidos'];
        $tipoIdentificacion = $fila['tipoidentificacion'];
        $identificacion = $fila['identificacion'];
        $precio = $fila['precio'];
        $costo = $fila['costoTotal'];
        $ganancia = $fila['ganancia'];
        $servicioId = $fila['servicioId'];
        $nombreServicio = $fila['nombre'];
        $arregloServicios[$iterador]['identificador'] = $servicioId;
        $arregloServicios[$iterador]['nombre'] = $nombreServicio;
        $arregloServicios[$iterador]['precio'] = $precio;
        $arregloServicios[$iterador]['costo'] = $costo;
        $arregloServicios[$iterador]['ganancia'] = $ganancia;

        $precioTotal += $precio;
        $iterador++;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Facturar servicios</title>
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
                                <a class="nav-link" style="color: #0d6efd;" href="facturarServicio.php">facturar Servicio</a>
                            </nav>
                        </div>

                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Facturar servicios</h1>

                    <form action="facturarServicio.php" method="post">
                        <div class="form-group col">
                            <label for=""> Identificador de la cita</label>
                            <input class="form-control" type="number" name="citaId" value="<?php echo $citaId; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Buscar">
                        </div>
                    </form>

                    <form action="../crud/crudFacturar.php" method="post">

                        <div class="">
                            <label for="">Numero de factura</label>
                            <input type="number" class="form-control mb-4" name="numerofactura">
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="">Tipo de Identificacion</label>
                                <input disabled type="text" class="form-control w-100 mb-4" value="<?php echo $tipoIdentificacion;?>">
                                <input type="hidden" name="tipoIdentificacion" value="<?php echo $tipoIdentificacion;?>">

                            </div>

                            <div class="col">
                                <label for="">Numero de Identificacion</label>
                                <input disabled type="text" class="form-control w-100 mb-4" value="<?php echo $identificacion; ?>">
                                <input type="hidden" name="identificacion" value="<?php echo $identificacion;?>">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col">
                                <label for="">Nombres</label>
                                <input disabled type="text" class="form-control w-100" name="" value="<?php echo $nombres; ?>">
                                <input type="hidden" name="nombres" value="<?php echo $nombres;?>">

                            </div>

                            <div class="col">
                                <label for="">Apellidos</label>
                                <input disabled type="text" class="form-control w-100" name="" value="<?php echo $apellidos; ?>">
                                <input type="hidden" name="apellidos" value="<?php echo $apellidos;?>">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="mb-3">Servicios a facturar</label>
                            <?php foreach ($arregloServicios as $servicio => $valor) { ?>
                                <p><?php echo $valor['nombre']; ?></p>
                                <!-- <input type="hidden" name=""> -->
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <p for="">Precio: <?php echo $precioTotal;?> </p>
                            <input type="hidden" name="preciototal" value="<?php echo $precioTotal;?>">
                        </div>


                        <div class="form-group">
                            <input type="hidden" name="identificadorCita" value="<?php echo $citaId; ?>">
                            <input type="hidden" name="operacion" value="guardar">
                            <input type="hidden" name="costo" value="<?php echo $costo; ?>">
                            <input type="hidden" name="ganancia" value="<?php echo $ganancia; ?>">
                            <input class="btn btn-primary" type="reset" value="Cancelar">
                            <input class="btn btn-primary" type="submit" value="Facturar">
                        </div>

                    </form>


                </div>
            </main>

            <?php require "../templates/footer.php" ?>


        </div>
    </div>
    <script src="../../assets/js/utilidades.js"></script>
    <script src="../../assets/js/buscador.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>