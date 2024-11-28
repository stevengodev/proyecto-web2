<?php
require '../../componentes/conexionbd.php';
// require '../../funciones/funciones.php';
require '../../modelos/clientes.php';
require '../../controladores/controladorcliente.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$identificacion = "";
$tipoidentificacion = "";
$nombres = "";
$apellidos = "";
$correo = "";
$celular = "";
$fechaNacimiento = "";
// $usuario = "";
// $contrasena = "";

$nombresAcompanante = "";
$apellidosAcompanante = "";
$correoAcompanante = "";
$fechaNacimientoAcompanante = "";

$tipoidentificacion = $_GET['tipoidentificacioncliente'];
$identificacion = $_GET['identificacioncliente'];

// $resultadoUsuario = mostrarUsuario($tipoidentificacion, $identificacion, $bd);

$cliente = new Clientes($tipoidentificacion, $identificacion, null, null, null, null, null, null, null, null, null, null);

$controladorCliente = new ControladorClientes();
$resultado = $controladorCliente->consultarRegistro($cliente, $bd);

$errores = [];
$patronCelular = '/^([0-9]{3})(-)([0-9]{3})(-)([0-9]{4})$/';

// ejecutar el codigo despues de que el usuario envia el formulario

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  // var_dump($_POST);
  // die();

  $fechaActual = date('Y-m-d');
  $identificacion = $_POST['identificacion'];
  $tipoidentificacion =  $_POST['tipoidentificacion'];
  $nombres =  $_POST['nombres'];
  $apellidos =  $_POST['apellidos'];
  $correo = $_POST['correo'];
  $celular = $_POST['celular'];
  $fechaNacimiento = $_POST['fechaNacimiento'];
  // $usuario =  $_POST['usuario'];
  // $contrasena = $_POST['contrasena'];
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

  // if (!ctype_alnum($usuario)) {
  //   $errores[] = "El nombre de usuario no es correcto";
  // }

  // if (!ctype_alnum($contrasena)) {
  //   $errores[] = "La contraseña es incorrecta";
  // }

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

    header('Location: listadoClientes.php');

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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar clientes</title>
  <link href="../../assets/css/styles.css" rel="stylesheet" />
</head>

<body>

  <h1 class="text-center mt-5">Editar cliente</h1>

  <?php foreach ($errores as $error) : ?>
    <p class="alert alert-danger text-center" style="padding: 10px 10px; width:1000px; margin: 0 auto 10px auto;">
      <?php echo $error; ?></p>
  <?php endforeach; ?>

  <form action="" method="post" style="margin: 0 auto; width:1000px">
    <?php while ($fila = $resultado->fetch_assoc()) { ?>

      <fieldset>
        <legend class="">Cliente</legend>

        <div class="container-fluid">

          <div class="row mb-3">

            <div class="col">
              <label for="">tipo de Identificacion</label>
              <input type="text" class="form-control w-100" name="" disabled value="<?php echo $fila['tipoidentificacion']; ?>">
              <input type="hidden" class="form-control w-100" name="tipoidentificacion" value="<?php echo $fila['tipoidentificacion']; ?>">

            </div>

            <div class="col">
              <label for="">Numero de Identificacion</label>
              <input type="text" class="form-control w-100" name="" disabled value="<?php echo $fila['identificacion']; ?>">
              <input type="hidden" class="form-control w-100" name="identificacion" value="<?php echo $fila['identificacion']; ?>">

            </div>

          </div>

          <div class="row">
            <div class="col input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Nombres completos</span>
              </div>
              <input type="text" name="nombres" class="form-control" value="<?php echo $fila['nombres']; ?>">
            </div>

            <div class="col input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Apellidos completos</span>
              </div>
              <input type="text" name="apellidos" class="form-control" value="<?php echo $fila['apellidos']; ?>">
            </div>
          </div>

          <div class="row">
            <div class="col input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Correo</span>
              </div>
              <input type="email" name="correo" class="form-control" value="<?php echo $fila['correo']; ?>">
            </div>

            <div class="col input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Celular</span>
              </div>
              <input type="text" name="celular" class="form-control" value="<?php echo $fila['celular']; ?>">
            </div>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Fecha de nacimiento</span>
            </div>
            <input type="date" name="fechaNacimiento" class="form-control" value="<?php echo $fila['fechaNacimiento']; ?>">
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
              <input type="text" name="nombresAcompanante" class="form-control" value="<?php echo $fila['nombresAcompañante']; ?>">
            </div>

            <div class="col input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Apellidos completos</span>
              </div>
              <input type="text" name="apellidosAcompanante" class="form-control" value="<?php echo $fila['apellidosAcompañante']; ?>">
            </div>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Correo</span>
            </div>
            <input type="email" name="correoAcompanante" class="form-control" value="<?php echo $fila['correoAcompañante']; ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Fecha de nacimiento</span>
            </div>
            <input type="date" name="fechaNacimientoAcompanante" class="form-control" value="<?php echo $fila['fechaNacimientoAcompañante']; ?>">
          </div>
        </div>
      </fieldset>
    <?php } ?>

    <input type="hidden" name="tipo" value="C">
    <input type="submit" class="input-group mb-3 btn btn-primary btn-lg" value="Registrar" id="registrarUsuario">
    <input type="reset" class="input-group mb-3 btn btn-secondary btn-lg" value="Cancelar" id="cancelarRegistroCliente">
  </form>

</body>

</html>