<?php

require '../componentes/conexionbd.php';
require '../controladores/controladorlogin.php';
require '../modelos/usuarios.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$errores = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  $nombreUsuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  $usuario = new Usuarios($nombreUsuario, $contrasena, null, null, null, null, null, null, null);
  $controladorLogin = new ControladorLogin();

  $resultado = $controladorLogin->consultarRegistro($usuario, $bd);

  if ($resultado->num_rows == 0) {
    $errores[] = 'El usuario y/o la contraseña es incorrecta';
  } else {

    session_start();

    $fila = $resultado->fetch_assoc();

    if ($fila['tipo'] == 'P') {
      $tipoIdentificacionProfesional = $fila['tipoidentificacionprofesional'];
      $identificacionProfesional = $fila['identificacionprofesional'];

      $_SESSION['tipoidentificacionprofesional'] = $tipoIdentificacionProfesional;
      $_SESSION['identificacionprofesional'] = $identificacionProfesional;

      header('Location: profesional/menuProfesional.php');

    } elseif ($fila['tipo'] == 'C') {
      $tipoIdentificacionCliente = $fila['tipoidentificacioncliente'];
      $identificacionCliente = $fila['identificacioncliente'];

      $_SESSION['tipoidentificacioncliente'] = $tipoIdentificacionCliente;
      $_SESSION['identificacioncliente'] = $identificacionCliente;

      header('Location: cliente/menuCliente.php');

    } elseif ($fila['tipo'] == 'A') {
      $tipoIdentificacionAdmin = $fila['tipoidentificacionempleado'];
      $identificacionAdmin = $fila['identificacionempleado'];

      $_SESSION['tipoidentificacionempleado'] = $tipoIdentificacionAdmin;
      $_SESSION['identificacionempleado'] = $identificacionAdmin;

      header('Location: admin/menuAdmin.php');

    } elseif ($fila['tipo'] == 'G') {
      $tipoIdentificacionGerente = $fila['tipoidentificacionempleado'];
      $identificacionGerente = $fila['identificacionempleado'];

      $_SESSION['tipoidentificacionempleado'] = $tipoIdentificacionGerente;
      $_SESSION['identificacionempleado'] = $identificacionGerente;

      header('Location: gerente/menuGerente.php');
    } elseif ($fila['tipo'] == 'S') {
      $tipoIdentificacionSecretaria = $fila['tipoidentificacionempleado'];
      $identificacionSecretaria = $fila['identificacionempleado'];

      $_SESSION['tipoidentificacionempleado'] = $tipoIdentificacionSecretaria;
      $_SESSION['identificacionempleado'] = $tipoIdentificacionSecretaria;

      header('Location: secretaria/menusecretaria.php');
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesion</title>
  <link href="../assets/css/styles.css" rel="stylesheet" />
</head>

<body>

  <section class="vh-100" style="background-color: #3b73db;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-5">Iniciar sesion</h3>

              <form action="" method="post">
                <div class="form-outline mb-4">
                  <input type="text" class="form-control w-100" placeholder="Usuario" name="usuario">
                </div>

                <div class="form-outline mb-4">
                  <input type="password" class="form-control w-100" placeholder="Contraseña" name="contrasena">
                </div>

                <input class="btn btn-primary btn-lg" value="Entrar" type="submit">
              </form>

              <hr class="my-4">

              <?php foreach ($errores as $error) { ?>
                <p class="alert alert-danger text-center" style="padding: 10px 10px;">
                <?php echo $error; ?></p>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>