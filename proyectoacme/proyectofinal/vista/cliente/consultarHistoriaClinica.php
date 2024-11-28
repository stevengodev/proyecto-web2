<?php

require("../../controladores/controladorhistoriasclinicas.php");
require '../../componentes/conexionbd.php';
require '../../modelos/clientes.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

session_start();

$tipoIdentificacionCliente = $_SESSION['tipoidentificacioncliente'];
$identificacionCliente = $_SESSION['identificacioncliente'];

if (($tipoIdentificacionCliente == null || $tipoIdentificacionCliente == '') && ($identificacionCliente == null || $identificacionCliente == '')) {
  header("Location: ../login.php");
}

$cliente = new Clientes($tipoIdentificacionCliente, $identificacionCliente, null, null, null, null, null, null, null, null, null);

$controladorHistoriaClinica = new ControladorHistoriasClinicas();
$resultado = $controladorHistoriaClinica->consultarRegistro($cliente, $bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Consultar historia clinica</title>
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
                <a class="nav-link" href="agendarCitas.php">Agendar citas</a>
                <a class="nav-link" href="#">consultar Historias Clinicas</a>
              </nav>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <div id="layoutSidenav_content">

      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Historia clinica</h1>

          <a href="agendarCitas.php" class="btn btn-success">Agendar cita</a>
          <a href="listadoCitas.php" class="btn btn-success">Listado de mis citas</a>

          <table class="table">
            <thead>
              <tr>
                <th>Peso</th>
                <th>Presion Arterial</th>
                <th>Sesiones realizadas</th>
                <th>Sesiones restantes</th>
                <th>Derivacion</th>
                <th>Resultados</th>
                <th>Servicio</th>
                <th>Evolucion</th>
              </tr>
            </thead>
            <tbody>

              <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $fila['peso']?></td>
                  <td><?php echo $fila['presionarterial']?></td>
                  <td><?php echo $fila['sesionesrealizadas']?></td>
                  <td><?php echo $fila['sesionesrestantes']?></td>
                  <td><?php echo $fila['derivacion']?></td>
                  <td><?php echo $fila['resultados']?></td>
                  <td><?php echo $fila['nombre']?></td>
                  <td><?php echo $fila['evolucion']?></td>
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