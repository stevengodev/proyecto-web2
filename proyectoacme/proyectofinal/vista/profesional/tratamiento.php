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
    <title>Tratamiento</title>
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

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Datos medicos: Tratamiento</h1>

                    <div>
                        <a href="listadoTratamientos.php" class="btn btn-primary mb-3 mt-3">Listado de tratamientos</a>
                    </div>

                    <form action="../crud/crudTratamiento.php" method="POST">

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="">Identificador del tratamiento</label>

                                <input type="number" class="form-control" name="identificador" required min="1">
                            </div>

                            <div class="mb-3 col">
                                <label for="">Identificador del diagnostico</label>
                                <input type="number" class="form-control" name="diagnosticoId" required min="1">
                            </div>

                            <div class="mb-3 col">
                                <label for="">Identificador de la cita</label>
                                <input type="number" class="form-control" name="citaId" required min="1">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label for="">peso anterior</label>
                                <input type="number" class="form-control" name="pesoAnterior" required min="1">
                            </div>

                            <div class="mb-3">
                                <label for="">presion arterial anterior</label>
                                <input type="number" class="form-control" name="presionArterialAnterior" required min="1">
                            </div>
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

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Sesiones que lleva: </label>
                                <input type="number" name="sesionesRealizadas" class="form-control" required>

                            </div>
                            <div class="col form-group">
                                <label for="">Sesiones que falta: </label>
                                <input type="number" name="sesionesRestantes" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Derivacion</label>
                            <textarea type="text" class="form-control" name="derivacion" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Resultados</label>
                            <textarea type="text" class="form-control" name="resultados" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="tipoidentificacionprofesional" value="<?php echo $tipoIdentificacionProfesional; ?>">
                            <input type="hidden" name="identificacionprofesional" value="<?php echo $identificacionProfesional; ?>">
                            <input class="btn btn-primary" type="reset" value="Cancelar">
                            <input class="btn btn-primary" type="submit" value="Registrar">
                            <input type="hidden" name="operacion" value="guardar">
                        </div>

                    </form>


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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>

</html>