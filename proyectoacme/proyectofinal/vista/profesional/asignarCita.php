<?php 

require '../../componentes/conexionbd.php';
require '../../funciones/funciones.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$resultado = mostrarIdentificadorCita($bd);

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
  <title>Asignar cita</title>
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

            <!-- <div class="sb-sidenav-menu-heading">Servicios</div> -->
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

      <main class="">
        <div class="container-fluid px-4">
          <h1 class="mt-4">Asignar cita </h1>

          <form action="../crud/crudCitas.php" method="post">

            <div class="container-fluid">

              <div class="row">

                <div class="col">
                  <label for="">Tipo de Identificacion</label>

                  <select name="tipoIdentificacionCliente" required>
                    <option value="">Selecciona el tipo de Identificacion</option>
                    <option value="I">I</option>
                    <option value="C">C</option>
                    <option value="E">E</option>
                  </select>

                </div>



              </div>
                <div class="col">
                  <label for="">Numero de Identificacion</label>
                  <input type="text" class="form-control w-100" required name="identificacionCliente">
                </div>
                
              <div class="mb-4">
                <label for="">Identificador cita</label>
                <input type="text" class="form-control" disabled value="<?php echo $resultado; ?>">
              </div>

              <div class="mb-4">
                <label for="">Fecha</label>
                <input type="datetime-local" class="form-control" required name="fecha">
              </div>

              <input type="hidden" name="identificador" value="<?php echo $resultado; ?>">
              <input type="submit" class="input-group mb-3 btn btn-primary btn-lg" value="Guardar">
              <input class="input-group mb-3 btn btn-secondary btn-lg" type="reset" value="Cancelar">
              <input type="hidden" name="operacion" value="guardar">
              <input type="hidden" name="rol" value="profesional">
  
          </form>

        </div>

      </main>

      <?php require "../templates/footer.php" ?>


    </div>
  </div>
  <script src="../../assets/js/utilidades.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>