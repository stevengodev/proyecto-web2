<?php

require '../../componentes/conexionbd.php';
require '../../funciones/funciones.php';

session_start();

$tipoIdentificacionProfesional = $_SESSION['tipoidentificacionprofesional'];
$identificacionProfesional = $_SESSION['identificacionprofesional'];

if( ($tipoIdentificacionProfesional == null || $tipoIdentificacionProfesional == '') && ($identificacionProfesional == null || $identificacionProfesional == '') ){
    header("Location: ../login.php");
  }

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$array_json = [];

$resultado = mostrarServicios($bd);

while ($fila = $resultado->fetch_assoc()) {
    $array_json[] = $fila;
}

$datos_json =  json_encode($array_json);

// escribimos en el archvo json
// el primer parametro es la ubicacion donde vamos a tener el archivo json
$gestor = fopen("servicios.json", 'w+');
fwrite($gestor, $datos_json);
fclose($gestor);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Diagnostico</title>
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

                        <a class="nav-link" href="menuProfesional.php">
                            Menu
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Privilegios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="diagnostico.php">diagnosticar</a>
                                <a class="nav-link" href="tratamiento.php">tratamiento</a>
                                <a class="nav-link" href="asignarCita.php">asignar cita</a>
                                <a class="nav-link" href="listadoCitas.php">Listado de citas</a>

                            </nav>
                        </div>

                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Datos medicos: Diagnostico</h1>

                    <div>
                        <a href="listadoDiagnosticos.php" class="btn btn-primary mb-3 mt-3">Listado de diagnosticos</a>
                    </div>

                    <form action="../crud/crudDiagnostico.php" method="POST">

                        <div>
                            <label for="">Identificador</label>
                            <input type="number" class="form-control" name="identificador" min="1" required>
                        </div>

                        <div>
                            <label for="">Identificador de la cita</label>
                            <input type="number" class="form-control" name="citaId" min="1" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="">Peso</label>
                                <input type="text" class="form-control w-100" name="peso" required>
                            </div>

                            <div class="col">
                                <label for="">Presion arterial</label>
                                <input type="text" class="form-control w-100" name="presionArterial" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Diagnostico</label>
                            <textarea type="text" class="form-control" name="diagnostico" required></textarea>
                        </div>

                        <label for="">Servicios que necesita</label>
                        <div class="col-md-12">
                            <button class="btn btn-secondary mb-3 mt-3" id="agregarServiciosNecesarios">Agregar servicio</button>
                        </div>

                        <div class="row">
                            <div class="col">
                                <select name="servicioNecesario1" required>
                                    <option value="">Selecciona el servicio</option>
                                    <?php
                                    $resultado = mostrarServicios($bd);
                                    while ($fila = $resultado->fetch_assoc()) { ?>
                                        <option value="<?php echo $fila['identificador']; ?>"><?php echo $fila['nombre']; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="col">
                                <label for="">Sesiones recomendadas</label>
                                <input type="number" class="form-control" name="numeroSesiones" min="1" required>
                            </div>
                        </div>

                        <!-- inputs dinamicamente -->

                        <div id="contenedorServiciosNecesarios" class="form-group mt-0">

                        </div>

                        <div class="form-group">
                            <input type="hidden" name="totalServiciosNecesarios" id="totalServiciosNecesarios">
                            <input type="hidden" name="operacion" value="guardar">
                            <input type="hidden" name="tipoidentificacionprofesional" value="<?php echo $tipoIdentificacion; ?>">
                            <input type="hidden" name="identificacionprofesional" value="<?php echo $identificacion; ?>">
                            <input class="btn btn-primary" type="reset" value="Cancelar" id="cancelarDiagnostico">
                            <input class="btn btn-primary" type="submit" value="Registrar" id="registrarDiagnostico">
                        </div>

                    </form>

                </div>
            </main>

            <?php
            require "../templates/footer.php";
            ?>

        </div>
    </div>
    <script src="/proyectofinal/assets/js/app.js"></script>
    <script src="/proyectofinal/assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>