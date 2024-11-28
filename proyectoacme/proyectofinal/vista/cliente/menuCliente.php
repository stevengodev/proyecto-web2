<?php

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
  <title>Menu cliente</title>
  <link href="../../assets/css/styles.css" rel="stylesheet"/>
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

  <!-- Header -->
  <?php require "../templates/header.php"?>

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
                <a class="nav-link" href="agendarCitas.php">Agendar Citas</a>
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
          <h1 class="mt-4">Menu</h1>

          <div class="contenedorMenu">

            <a href="agendarCitas.php">
              <div class="elementoMenu">
                <i class="fa-regular fa-calendar-days tamañoIconosMenu"></i>
                <span>Agendar citas</span>
              </div>
            </a>

            <a href="listadoCitas.php">
              <div class="elementoMenu">
                <i class="fa-solid fa-clipboard-list tamañoIconosMenu"></i>
                <span>Listado de mis citas</span>
              </div>
            </a>

            <a href="consultarHistoriaClinica.php">
              <div class="elementoMenu">
                <i class="fa-regular fa-calendar-days tamañoIconosMenu"></i>
                <span>Historia clinica</span>
              </div>
            </a>

          </div>

        </div>
      </main>

      <?php require "../templates/footer.php" ?>


    </div>
  </div>
  <script src="../../assets/js/utilidades.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>