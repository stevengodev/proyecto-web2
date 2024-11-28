<?php

session_start();

$tipoIdentificacionProfesional = $_SESSION['tipoidentificacionprofesional'];
$identificacionProfesional = $_SESSION['identificacionprofesional'];

if( ($tipoIdentificacionProfesional == null || $tipoIdentificacionProfesional = '') && ($identificacionProfesional == null || $identificacionProfesional = '') ){
  header("Location: ../login.php");
}

require '../../componentes/conexionbd.php';
require '../../controladores/controladortratamiento.php';
require '../../modelos/tratamientos.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$tratamiento = new Tratamientos($identificador, null, null, null, null, null, null, null, null);
$controladorTratamiento = new ControladorTratamiento();
$resultado = $controladorTratamiento->consultarRegistro($tratamiento, $bd);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tratamiento</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>

    <h1 class="text-center mt-5" >Editar tratamiento</h1>

    <form action="../crud/crudTratamiento.php" method="POST" style="margin: 0 auto; width:1000px" class="container">

    <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <div class="mb-3">
            <label for="">Identificador del tratamiento</label>

            <input type="number" class="form-control" name="identificador" required min="1" value="<?php echo $fila['identificador']; ?>">
        </div>

        <div class="mb-3">
            <label for="">Identificador del diagnostico</label>
            <input type="number" class="form-control" name="diagnosticoId" required min="1" value="<?php echo $fila['diagnosticoId']; ?>">
        </div>

        <div class="mb-3">
            <label for="">Identificador de la cita</label>
            <input type="number" class="form-control" name="citaId" required min="1" value="<?php echo $fila['citaId']; ?>">
        </div>

        <div class="row">

            <div class="col">
                <label for="">Peso</label>
                <input type="text" class="form-control w-100" name="peso" required value="<?php echo $fila['peso']; ?>">
            </div>

            <div class="col">
                <label for="">Presion arterial</label>
                <input type="text" class="form-control w-100" name="presionArterial" required value="<?php echo $fila['presionarterial']; ?>">
            </div>

        </div>

        <div class="row">
            <div class="form-group col">
                <label for="">Sesiones que lleva: </label>
                <input type="number" name="sesionesRealizadas" class="form-control" required value="<?php echo $fila['sesionesrealizadas']; ?>">

            </div>
            <div class="col form-group">
                <label for="">Sesiones que falta: </label>
                <input type="number" name="sesionesRestantes" class="form-control" required value="<?php echo $fila['sesionesrestantes']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="">Derivacion</label>
            <textarea type="text" class="form-control" name="derivacion" required><?php echo $fila['derivacion']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="">Resultados</label>
            <textarea type="text" class="form-control" name="resultados" required><?php echo $fila['resultados']; ?></textarea>
        </div>

        <div class="form-group">
        <input type="hidden" name="tipoidentificacionprofesional" value="<?php echo $tipoIdentificacionProfesional; ?>">
        <input type="hidden" name="identificacionprofesional" value="<?php echo $identificacionProfesional; ?>">
            <input class="btn btn-primary" type="reset" value="Cancelar">
            <input class="btn btn-primary" type="submit" value="Registrar">
            <input type="hidden" name="operacion" value="guardar">
        </div>

        <?php } ?>

    </form>

</body>

</html>