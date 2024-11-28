<?php

$identificador = $_GET['identificador'];
$fecha = $_GET['fecha'];
$tipoIdentificacionCliente = $_GET['tipoidentificacioncliente'];
$identificacionCliente = $_GET['identificacioncliente'];

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

<h1 class="text-center mt-5">Editar cita</h1>

<form action="../crud/crudCitas.php" method="post" style="margin: 0 auto; width:1000px" class="container">

<fieldset>

  <legend>Datos requeridos</legend>

  <div class="form-group">
    <label>Identificador de cita</label>
    <div>
      <input class="form-control w-100" type="text" disabled value="<?php echo $identificador; ?>" >
      <input type="hidden" name="identificador" value="<?php echo $identificador; ?>">
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
  <input type="hidden" name="rol" value="profesional">
  <input type="hidden" name="operacion" value="guardar">
  <input type="hidden" name="tipoIdentificacionCliente" value="<?php echo $tipoIdentificacionCliente; ?>">
  <input type="hidden" name="identificacionCliente" value="<?php echo $identificacionCliente; ?>">
  <input class="btn btn-primary" type="reset" value="Cancelar">
  <input class="btn btn-primary" type="submit" value="Registrar">
</div>

</form>
    
</body>
</html>