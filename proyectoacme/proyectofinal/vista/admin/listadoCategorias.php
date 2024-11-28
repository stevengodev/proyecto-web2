<?php

require '../../componentes/conexionbd.php';
require '../../controladores/controladorcategoria.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

session_start();

$tipoIdentificacionAdmin = $_SESSION['tipoidentificacionempleado'];
$identificacionAdmin = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionAdmin == null || $tipoIdentificacionAdmin == '') && ($identificacionAdmin == null || $identificacionAdmin == '')) {
  header("Location: ../login.php");
}

$controladorCategoria = new ControladorCategoria();
$resultado = $controladorCategoria->listar($bd);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de categorias</title>
  <link href="../../assets/css/styles.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">

  <!-- Header -->
  <?php require("../templates/header.php") ?>

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
                <a class="nav-link" href="crearProfesionales.php">Crear profesionales</a>
                <a class="nav-link" href="crearServicios.php">Crear servicios</a>
                <a class="nav-link" href="crearCategorias.php">Crear categorias</a>
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
          <h1 class="mt-4">Listado de categorias</h1>

          <table class="table">

            <thead>
              <tr>
                <th scope="col">Identificador</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $fila['identificador']; ?></td>
                  <td><?php echo $fila['nombre']; ?></td>

                  <td class="d-flex" >
                    <a href="editarCategoria.php?identificador=<?php echo $fila['identificador']; ?>" class="btn btn-warning" style="margin-right: 10px;" >Editar</a>
                    <form action="../crud/crudCategoria.php" method="post">
                      <input type="hidden" name="operacion" value="eliminar">
                      <input type="hidden" name="identificador" value="<?php echo $fila['identificador']; ?>">
                      <input  type="submit" class="btn btn-danger" name="" value="Eliminar">
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
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
  <script src="../../assets/js/utilidades.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>