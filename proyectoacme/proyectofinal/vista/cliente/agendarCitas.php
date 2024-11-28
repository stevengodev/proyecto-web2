<?php

require '../../componentes/conexionbd.php';
require '../../funciones/funciones.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$resultado = mostrarIdentificadorCita($bd);

session_start();

$tipoIdentificacionCliente = $_SESSION['tipoidentificacioncliente'];
$identificacionCliente = $_SESSION['identificacioncliente'];

if (($tipoIdentificacionCliente == null || $tipoIdentificacionCliente == '') && ($identificacionCliente == null || $identificacionCliente == '')) {
  header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Agendar citas</title>
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
                <a class="nav-link" href="#">Agendar citas</a>
                <a class="nav-link" href="listadoCitas.php">Listado citas</a>
                <a class="nav-link" href="consultarHistoriaClinica.php">Historias clinicas</a>
              </nav>
            </div>

          </div>
        </div>
      </nav>
    </div>

    <div id="layoutSidenav_content">

      <main>
        <div class="container-fluid px-4">
          <h1 class="mb-4 mt-4 text-center">Agendar citas</h1>

          <a href="listadoCitas.php" class="btn btn-success mt-3 mb-3">Listado de citas agendadas</a>
          <a href="consultarHistoriaClinica.php" class="btn btn-success mt-3 mb-3">Historias clinicas</a>

          <form action="../crud/crudCitas.php" method="post">

            <fieldset>

              <legend>Datos requeridos</legend>

              <div class="form-group">
                <label for="">Identificador de la cita</label>
                <div>
                  <input class="form-control" type="text" name="identificador" disabled value="<?php echo $resultado; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="">Fecha</label>
                <div>
                  <input class="form-control" type="datetime-local" name="fecha" required>
                </div>
              </div>

            </fieldset>

            <div class="form-group">
              <input type="hidden" name="operacion" value="guardar">
              <input type="hidden" name="tipoIdentificacionCliente" value="<?php echo $tipoIdentificacionCliente; ?>">
              <input type="hidden" name="identificacionCliente" value="<?php echo $identificacionCliente; ?>">
              <input class="btn btn-primary" type="reset" value="Cancelar">
              <input class="btn btn-primary" type="submit" value="Registrar">
              <input type="hidden" name="rol" value="cliente">
              <input type="hidden" name="identificador" value="<?php echo $resultado; ?>">
            </div>

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