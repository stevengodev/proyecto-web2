<?php 

session_start();

$tipoIdentificacionAdmin = $_SESSION['tipoidentificacionempleado'];
$identificacionAdmin = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionAdmin == null || $tipoIdentificacionAdmin == '') && ($identificacionAdmin == null || $identificacionAdmin == '')) {
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Crear categorias</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <?php require "../templates/header.php" ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Navegacion</div>

                        <a class="nav-link" href="menuAdmin.php">
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
                                <a class="nav-link" href="crearProfesionales.php">Crear profesionales</a>
                                <a class="nav-link" href="crearServicios.php">Crear servicios</a>
                                <a class="nav-link" href="#">Crear categorias</a>
                                <a class="nav-link" href="crearReactivos.php">Crear elementos</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Crear categorias</h1>

                    <div>
                        <a href="listadoCategorias.php" class="btn btn-primary mb-3 mt-3">Listado de categorias</a>
                    </div>

                    <form action="../crud/crudCategoria.php" method="POST">
                        <fieldset>

                            <legend>Información de categoria</legend>


                            <div class="form-group">
                                <label for="">Identificador</label>
                                <input required type="number" class="form-control" name="identificador">
                            </div>

                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input required type="text" class="form-control" name="nombre">
                            </div>

                        </fieldset>

                        <div class="form-group">
                            <input class="btn btn-primary" type="reset" value="Cancelar">
                            <input class="btn btn-primary" type="submit" value="Registrar">
                        </div>

                        <input type="hidden" name="operacion" value="guardar">

                    </form>

                </div>
            </main>

            <?php require "../templates/footer.php" ?>

        </div>
    </div>
    <script src="../../assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>