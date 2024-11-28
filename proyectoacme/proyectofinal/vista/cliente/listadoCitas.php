<?php

require '../../componentes/conexionbd.php';
require '../../modelos/citas.php';
require '../../controladores/controladorcitas.php';

session_start();

$tipoIdentificacionCliente = $_SESSION['tipoidentificacioncliente'];
$identificacionCliente = $_SESSION['identificacioncliente'];

if (($tipoIdentificacionCliente == null || $tipoIdentificacionCliente == '') && ($identificacionCliente == null || $identificacionCliente == '')) {
  header("Location: ../login.php");
}

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorCita = new ControladorCitas();
$resultado = $controladorCita->registroDeCitas($tipoIdentificacionCliente,$identificacionCliente,$bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Mis citas</title>
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
                <a class="nav-link" href="agendarCitas.php">Agendar citas</a>
                <a class="nav-link" href="listadoCitas.php">Listado de citas</a>
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
          <h1 class="mt-4">Listado de citas</h1>

          <a href="agendarCitas.php" class="btn btn-success">Agendar cita</a>
          <a href="consultarHistoriaClinica.php" class="btn btn-success">Historias clinicas</a>


          <table class="table">
            <thead>
              <tr>
                <th>Identificador</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>

              <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $fila['identificador']; ?></td>
                  <td><?php echo $fila['fecha']; ?></td>
                  <td class="d-flex" >
                    <a href="editarCita.php?identificador=<?php echo $fila['identificador'] . '&fecha='. $fila['fecha']. '&identificacionCliente='. $identificacionCliente. '&tipoIdentificacionCliente='. $tipoIdentificacionCliente?>"  class="btn btn-warning" style="margin-right: 10px;">Editar</a>
                    <form action="../crud/crudCitas.php" method="post">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="identificador" value="<?php echo $fila['identificador']; ?>">
                      <input  type="submit" class="btn btn-danger" name="" value="Eliminar">
                      <input type="hidden" name="rol" value="cliente">

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