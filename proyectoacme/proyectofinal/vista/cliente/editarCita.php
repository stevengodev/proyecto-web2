<?php

$fecha = $_GET['fecha'];
$tipoIdentificacionCliente = $_GET['tipoIdentificacionCliente'];
$identificacionCliente = $_GET['identificacionCliente'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cita</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />

</head>
<body>

<h1 class="text-center mt-5">Editar citas</h1>

<form action="../crud/crudCitas.php" method="post" style="margin: 0 auto; width:500px" class="container">

<fieldset>

  <legend>Datos requeridos</legend>

  <div class="form-group">
    <label>Identificador de cita</label>
    <div>
      <input class="form-control w-100" type="text" disabled value="<?php echo $_GET['identificador']; ?>" >
      <input type="hidden" name="identificador" value="<?php echo $_GET['identificador']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label>Fecha</label>
    <div>
      <input class="form-control w-100" type="datetime-local" name="fecha" value="<?php echo $fecha;  ?>" >
    </div>
  </div>

</fieldset>

<div class="form-group">
  <input type="hidden" name="rol" value="cliente">
  <input type="hidden" name="operacion" value="guardar">
  <input type="hidden" name="tipoIdentificacionCliente" value="<?php echo $tipoIdentificacionCliente; ?>">
  <input type="hidden" name="identificacionCliente" value="<?php echo $identificacionCliente; ?>">
  <input class="btn btn-primary" type="reset" value="Cancelar">
  <input class="btn btn-primary" type="submit" value="Registrar">
</div>

</form>
    
</body>
</html>