<?php

$errores = [];
$patronCelular = '/^([0-9]{3})(-)([0-9]{3})(-)([0-9]{4})$/';

$identificacion = "";
$tipoidentificacion = "";
$nombres = "";
$apellidos = "";
$correo = "";
$celular = "";
$fechaNacimiento = "";
$usuario = "";
$contrasena = "";

$nombresAcompanante = "";
$apellidosAcompanante = "";
$correoAcompanante = "";
$fechaNacimientoAcompanante = "";


// ejecutar el codigo despues de que el usuario envia el formulario

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  $fechaActual = date('Y-m-d');
  $identificacion = $_POST['identificacion'];
  $tipoidentificacion =  $_POST['tipoidentificacion'];
  $nombres =  $_POST['nombres'];
  $apellidos =  $_POST['apellidos'];
  $correo = $_POST['correo'];
  $celular = $_POST['celular'];
  $fechaNacimiento = $_POST['fechaNacimiento'];
  $usuario =  $_POST['usuario'];
  $contrasena = $_POST['contrasena'];
  $nombresAcompanante = $_POST['nombresAcompanante'];
  $apellidosAcompanante = $_POST['apellidosAcompanante'];
  $correoAcompanante = $_POST['correoAcompanante'];
  $fechaNacimientoAcompanante = $_POST['fechaNacimientoAcompanante'];
  $tipo = $_POST['tipo'];

  if ($identificacion == '') {
    array_push($errores, "Debes añadir una identificacion");
  }

  if ($tipoidentificacion == '') {
    array_push($errores, "Debes añadir un tipo de identificacion");
  }

  if ($nombres == '') {
    array_push($errores, "Los nombres no son correctos");
  }

  if ($apellidos == '') {
    $errores[] = "Los apellido no son correctos";
  }

  if (!preg_match('/^[(a-z0-9\_\-\.)]+@[(a-z0-9\_\-\.)]+\.[(a-z)]{2,15}$/i', $correo)) {
    $errores[] = "Correo no valido";
  }

  if (!preg_match($patronCelular, $celular)) {
    $errores[] = "El numero de celular no es correcto";
  }

  if ($fechaNacimiento == '') {
    $errores[] = "Fecha de nacimiento no valida";
  }

  if (!ctype_alnum($usuario)) {
    $errores[] = "El nombre de usuario no es correcto";
  }

  if (!ctype_alnum($contrasena)) {
    $errores[] = "La contraseña es incorrecta";
  }

  if ($nombresAcompanante == '') {
    array_push($errores, "Los nombres del acompañante no son correctos");
  }


  if ($apellidosAcompanante == '') {
    $errores[] = "Los apellido del acompañante no son correctos";
  }

  if (!preg_match('/^[(a-z0-9\_\-\.)]+@[(a-z0-9\_\-\.)]+\.[(a-z)]{2,15}$/i', $correoAcompanante)) {
    $errores[] = "Correo del acompañante no valido";
  }

  if ($fechaNacimientoAcompanante == '') {
    $errores[] = "La fecha de nacimiento del acompañante es obligatoria";
  }

  $date1 = new DateTime($fechaNacimientoAcompanante);
  $date2 = new DateTime($fechaActual);
  $diff = $date1->diff($date2);
  $difereciaDeAnos = $diff->y;

  if ($difereciaDeAnos < 25) {
    $errores[] = "La edad del acompañante debe ser mayor o igual a 25 años";
  }

  if (empty($errores)) {

    require '../../componentes/conexionbd.php';
    require '../../modelos/clientes.php';
    require '../../controladores/controladorcliente.php';
    require '../../modelos/usuarios.php';
    require '../../controladores/controladorusuarios.php';

    $conexion = new ConexionBD();
    $bd = $conexion->getConexion();

    $cliente = new Clientes(
      $tipoidentificacion,
      $identificacion,
      $nombres,
      $apellidos,
      $correo,
      $celular,
      $fechaNacimiento,
      $nombresAcompanante,
      $apellidosAcompanante,
      $fechaNacimientoAcompanante,
      $correoAcompanante
    );


    $controladorCliente = new ControladorClientes();
    $controladorCliente->guardar($cliente, $bd);

    $usuario = new Usuarios($usuario, $contrasena, $tipoidentificacion, $identificacion, null, null, null, null, $tipo);

    $controladorUsuario = new ControladorUsuarios();
    $controladorUsuario->guardar($usuario, $bd);

    $identificacion = "";
    $tipoidentificacion = "";
    $nombres = "";
    $apellidos = "";
    $correo = "";
    $celular = "";
    $fechaNacimiento = "";
    $usuario = "";
    $contrasena = "";

    $nombresAcompanante = "";
    $apellidosAcompanante = "";
    $correoAcompanante = "";
    $fechaNacimientoAcompanante = "";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Registrar Usuarios</title>
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

            <a class="nav-link" href="menusecretaria.php">
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
                <a class="nav-link" href="registrarusuario.php">Registrar usuario</a>
                <a class="nav-link " href="recordatorioCitas.php">Recordatorio de citas</a>
                <a class="nav-link " href="facturarServicio.php">facturar Servicio</a>
              </nav>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <div id="layoutSidenav_content">

      <main class="">
        <div class="container-fluid px-4">
          <h1 class="mt-4">Registrar Cliente</h1>

          <?php foreach ($errores as $error) : ?>
            <p class="alert alert-danger text-center" style="padding: 10px 10px;">
              <?php echo $error; ?></p>
          <?php endforeach; ?>

          <div>
            <a href="listadoClientes.php" class="btn btn-primary mb-3 mt-3">Listado de clientes</a>
          </div>

          <form action="" method="post">
            <fieldset>
              <legend class="">Cliente</legend>

              <div class="container-fluid">

                <div class="row mb-3">

                  <div class="col">
                    <label for="">Tipo de Identificacion</label>

                    <select name="tipoidentificacion" id="">
                      <option value="">Selecciona el tipo de Identificacion</option>
                      <option value="I">I</option>
                      <option value="C">C</option>
                      <option value="E">E</option>
                    </select>

                  </div>

                  <div class="col">
                    <label for="">Numero de Identificacion</label>
                    <input type="text" class="form-control w-100" name="identificacion" value="<?php echo $identificacion; ?>">
                  </div>

                </div>

                <div class="row">
                  <div class="col input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Nombres completos</span>
                    </div>
                    <input type="text" name="nombres" class="form-control" value="<?php echo $nombres; ?>">
                  </div>

                  <div class="col input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Apellidos completos</span>
                    </div>
                    <input type="text" name="apellidos" class="form-control" value="<?php echo $apellidos; ?>">
                  </div>
                </div>

                <div class="row">
                  <div class="col input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Correo</span>
                    </div>
                    <input type="email" name="correo" class="form-control" value="<?php echo $correo; ?>">
                  </div>

                  <div class="col input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Celular</span>
                    </div>
                    <input type="text" name="celular" class="form-control" value="<?php echo $celular; ?>">
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Fecha de nacimiento</span>
                  </div>
                  <input type="date" name="fechaNacimiento" class="form-control" value="<?php echo $fechaNacimiento; ?>">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Usuario</span>
                  </div>
                  <input type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Contraseña</span>
                  </div>
                  <input type="password" name="contrasena" class="form-control" value="<?php echo $contrasena; ?>">
                </div>
              </div>
            </fieldset>

            <fieldset>

              <legend class="">Acompañante</legend>

              <div>
                <div class="row">
                  <div class="col input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Nombres completos</span>
                    </div>
                    <input type="text" name="nombresAcompanante" class="form-control" value="<?php echo $nombresAcompanante; ?>">
                  </div>

                  <div class="col input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Apellidos completos</span>
                    </div>
                    <input type="text" name="apellidosAcompanante" class="form-control" value="<?php echo $apellidosAcompanante; ?>">
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Correo</span>
                  </div>
                  <input type="email" name="correoAcompanante" class="form-control" value="<?php echo $correoAcompanante; ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Fecha de nacimiento</span>
                  </div>
                  <input type="date" name="fechaNacimientoAcompanante" class="form-control" value="<?php echo $fechaNacimientoAcompanante; ?>">
                </div>
              </div>
            </fieldset>

            <input type="hidden" name="tipo" value="C">
            <input type="submit" class="input-group mb-3 btn btn-primary btn-lg" value="Registrar" id="registrarUsuario">
            <input type="reset" class="input-group mb-3 btn btn-secondary btn-lg" value="Cancelar" id="cancelarRegistroCliente">
          </form>

        </div>



      </main>

      <?php require "../templates/footer.php" ?>


    </div>
  </div>
  <script src="../../assets/js/utilidades.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>

</body>

</html>