<?php

session_start();

$identificador = $_GET['identificador'];
$tipoIdentificacionProfesional = $_SESSION['tipoidentificacionprofesional'];
$identificacionProfesional = $_SESSION['identificacionprofesional'];

if( ($tipoIdentificacionProfesional == null || $tipoIdentificacionProfesional = '') && ($identificacionProfesional == null || $identificacionProfesional = '') ){
    header("Location: ../login.php");
}

// var_dump($_GET);

// die();

require '../../componentes/conexionbd.php';
require '../../funciones/funciones.php';
require '../../controladores/controladordiagnostico.php';
require '../../modelos/diagnosticos.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$array_json = [];

$resultado = mostrarServicios($bd);

while ($fila = $resultado->fetch_assoc()) {
    $array_json[] = $fila;
}

$datos_json =  json_encode($array_json);

// escribimos en el archvo json
// el primer parametro es la ubicacion donde vamos a tener el archivo json
$gestor = fopen("servicios.json", 'w+');
fwrite($gestor, $datos_json);
fclose($gestor);

$controladorDiagnostico = new ControladorDiagnosticos();
$diagnostico = new Diagnosticos($identificador);
$resultadoDiagnostico = $controladorDiagnostico->consultarRegistro($diagnostico, $bd);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar diagnostico</title>
    <link rel="stylesheet" href="/proyectofinal/assets/css/styles.css">
</head>

<body>

    <h1 class="mt-4 text-center">Editar diagnostico</h1>

    <form action="../crud/crudDiagnostico.php" method="POST" style="margin: 0 auto; width:1000px">

        <?php while ($filaDiagnostico = $resultadoDiagnostico->fetch_assoc()) { ?>

            <div>
                <label for="">Identificador</label>
                <input type="number" class="form-control" name="identificador" min="1" required value="<?php echo $filaDiagnostico['identificador'] ?>">
            </div>

            <div>
                <label for="">Identificador de la cita</label>
                <input type="number" class="form-control" name="citaId" min="1" required value="<?php echo $filaDiagnostico['citaId'] ?>"">
        </div>

        <div class=" row">
                <div class="col">
                    <label for="">Peso</label>
                    <input type="text" class="form-control w-100" name="peso" required value="<?php echo $filaDiagnostico['peso'] ?>">
                </div>

                <div class="col">
                    <label for="">Presion arterial</label>
                    <input type="text" class="form-control w-100" name="presionArterial" required value="<?php echo $filaDiagnostico['presionarterial'] ?>"">
            </div>
        </div>

        <div class=" form-group">
                    <label for="">Diagnostico</label>
                    <textarea type="text" class="form-control" name="diagnostico" required><?php echo $filaDiagnostico['diagnostico'] ?>
            </textarea>
                </div>

                <label for="">Servicios que necesita</label>
                <div class="col-md-12">
                    <button class="btn btn-secondary mb-3 mt-3" id="agregarServiciosNecesarios">Agregar servicio</button>
                </div>

                <div class="row">
                    <div class="col">
                        <select name="servicioNecesario1" required>
                            <option value="">Selecciona el servicio</option>
                            <?php
                            $resultado = mostrarServicios($bd);
                            while ($fila = $resultado->fetch_assoc()) { ?>
                                <option value="<?php echo $fila['identificador']; ?>"><?php echo $fila['nombre']; ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="col">
                        <label for="">Sesiones recomendadas</label>
                        <input type="number" class="form-control" name="numeroSesiones" min="1" required value="<?php echo $filaDiagnostico['numerosesiones'] ?>">
                    </div>
                </div>

                <!-- inputs dinamicamente -->

                <div id="contenedorServiciosNecesarios" class="form-group mt-0">

                </div>

                <label for="">Servicios existentes que tiene el diagnostico</label>

                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">Identificador</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>x</td>
                            <td>
                                <input type="hidden" name="servicioId">
                                <input type="button" class="btn btn-danger" name="operacion" value="eliminar">
                            </td>
                        </tr>

    </tbody>
    </table>

    <div class="form-group">
        <input type="hidden" name="tipoidentificacionprofesional" value="<?php echo $tipoIdentificacionProfesional; ?>">
        <input type="hidden" name="identificacionprofesional" value="<?php echo $identificacionProfesional; ?>">
        <input class="btn btn-primary" type="reset" value="Cancelar" id="cancelarDiagnostico">
        <input class="btn btn-primary" type="submit" value="Registrar" id="registrarDiagnostico">
        <input type="hidden" name="totalServiciosNecesarios" id="totalServiciosNecesarios">
        <input type="hidden" name="operacion" value="guardar">
    </div>

<?php } ?>

</form>

<script src="/proyectofinal/assets/js/app.js"></script>
<script src="/proyectofinal/assets/js/utilidades.js"></script>
</body>

</html>