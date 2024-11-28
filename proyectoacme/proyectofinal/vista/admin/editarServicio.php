<?php

require '../../componentes/conexionbd.php';
require '../../controladores/controladorservicios.php';
require '../../controladores/controladorcategoria.php';
require '../../modelos/servicios.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$identificador = $_GET['identificador'];

$servicio = new Servicios($identificador);

$controladorServicio = new ControladorServicios();
$resultado = $controladorServicio->consultarRegistro($servicio, $bd);

$controladorCategoria = new ControladorCategoria();
$resultadoCategoria = $controladorCategoria->listar($bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar servicio</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
</head>

<body>

    <h1 class="text-center mt-5">Editar servicio</h1>

    <form action="../crud/crudServicio.php" method="post" style="width: 1000px; margin:0 auto">

        <div>

            <fieldset>

                <div class="form-group">
                    <label for="">Identificador</label>
                    <input type="number" disabled class="form-control input-w100" value="<?php echo $identificador; ?>">
                    <input type="hidden" name="identificador" value="<?php echo $identificador; ?>">
                </div>

                <?php while ($fila = $resultado->fetch_assoc()) { ?>


                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-w100" name="nombre" value="<?php echo $fila['nombre']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea class="form-control" rows="3" name="descripcion"><?php echo $fila['descripcion']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Categoria</label>

                        <select name="categoriaId" required>
                            <option value="">Selecciona la categoria</option>
                            <?php while ($filaCategoria = $resultadoCategoria->fetch_assoc()) { ?>
                                <option value="<?php echo $filaCategoria['identificador']; ?>"><?php echo $filaCategoria['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

            </fieldset>
            <fieldset>

            <div>
                    <label class="mb-3" for="">Porcentaje de ganancia</label>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" name="porcentaje" value="<?php echo $fila['porcentaje'] * 100; ?>">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </fieldset>

            <fieldset>

                <legend>Reglas de evolucion</legend>
                <div class="form-group">

                    <label for=""> peso</label>

                    <select name="peso" required>
                        <option value="">elige una opcion</option>
                        <option value="baja">baja</option>
                        <option value="sube">sube</option>
                    </select>
                </div>

                <div class="form-group">

                    <label for=""> presion arterial</label>

                    <select name="presionArterial" required>
                        <option value="">elige una opcion</option>
                        <option value="baja">baja</option>
                        <option value="sube">sube</option>
                    </select>
                </div>


                <div>
                    <label>Evolucion</label>
                    <select name="evolucion" required>
                        <option value="">elija una opcion</option>
                        <option value="positiva">positiva</option>
                        <option value="negativa" disabled>negativa</option>
                    </select>
                </div>

            </fieldset>

            <div class="form-group">
                <input type="hidden" name="estado" value="activo">
                <input type="hidden" name="operacion" value="guardar">
                <input type="hidden" id="totalReactivosNecesarios" name="totalReactivosNecesarios">
                <input type="hidden" id="totalMaquinasNecesarias" name="totalMaquinasNecesarias">
                <input type="hidden" id="totalMateriasPrimasNecesarias" name="totalMateriasPrimasNecesarias"> <input type="submit" class="btn btn-primary" value="Guardar">
                <a href="listadoServicios.php" class="btn btn-secondary">Cancelar</a>
            </div>

        <?php } ?>


    </form>

    <script src="../../assets/js/utilidades.js"></script>
</body>

</html>