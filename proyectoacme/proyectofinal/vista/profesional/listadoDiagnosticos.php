<?php

session_start();

$tipoIdentificacionProfesional = $_SESSION['tipoidentificacionprofesional'];
$identificacionProfesional = $_SESSION['identificacionprofesional'];

if( ($tipoIdentificacionProfesional == null || $tipoIdentificacionProfesional == '') && ($identificacionProfesional == null || $identificacionProfesional == '') ){
  header("Location: ../login.php");
}

require '../../componentes/conexionbd.php';
require '../../funciones/funciones.php';
require '../../controladores/controladordiagnostico.php';
require '../../controladores/controladordiagnosticosservicio.php';
require '../../modelos/diagnosticos.php';
require '../../modelos/diagnosticosservicios.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();


$controladorDiagnostico = new ControladorDiagnosticos();
$resultado = $controladorDiagnostico->listar($bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Listado de diagnosticos</title>
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
          <h1 class="mt-4">Listado de diagnosticos</h1>

          <table class="table">
            <thead>
              <tr>
                <th>identificador</th>
                <th>acciones</th>
              </tr>
            </thead>
            <tbody>

              <tr>
              <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $fila['identificador']; ?></td>

                  <td class="" >
                    <a href="editarDiagnostico.php?identificador=<?php echo $fila['identificador']. "&tipoidentificacionprofesional=$tipoIdentificacionProfesional". "&identificacionprofesional=$identificacionProfesional"?>" class="btn btn-warning" style="margin-right: 10px;">Editar</a>
                  </td>
                </tr>

              <?php  } ?>

              </tr>

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

</html>