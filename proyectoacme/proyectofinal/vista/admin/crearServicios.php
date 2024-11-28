<?php

require '../../componentes/conexionbd.php';
require '../../controladores/controladorcategoria.php';
require '../../funciones/funciones.php';

session_start();

$tipoIdentificacionAdmin = $_SESSION['tipoidentificacionempleado'];
$identificacionAdmin = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionAdmin == null || $tipoIdentificacionAdmin == '') && ($identificacionAdmin == null || $identificacionAdmin == '')) {
  header("Location: ../login.php");
}

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorCategoria = new ControladorCategoria();
$resultadoCategoria = $controladorCategoria->listar($bd);

//array donde tendremos los registros de los nombres que vienen de la consulta
$arrayReactivos_json = [];
$arrayMaquinas_json = [];
$arrayMateriasPrimas_json = [];

$resultadoReactivos = mostrarReactivos($bd);
$resultadoMaquinas = mostrarMaquinas($bd);
$resultadoMateriasPrimas = mostrarMateriasPrimas($bd);


while ($filaReactivos = $resultadoReactivos->fetch_assoc()) {
    $arrayReactivos_json[] = $filaReactivos;
}

while ($filaMaquinas = $resultadoMaquinas->fetch_assoc()) {
    $arrayMaquinas_json[] = $filaMaquinas;
}

while ($filaMateriasPrimas = $resultadoMateriasPrimas->fetch_assoc()) {
    $arrayMateriasPrimas_json[] = $filaMateriasPrimas;
}

$datosReactivos_json =  json_encode($arrayReactivos_json);
$datosMaquinas_json =  json_encode($arrayMaquinas_json);
$datosMateriasPrimas_json =  json_encode($arrayMateriasPrimas_json);


// escribimos en el archvo json
// el primer parametro es la ubicacion donde vamos a tener el archivo json
$gestorReactivos = fopen("reactivos.json", 'w+');
fwrite($gestorReactivos, $datosReactivos_json);
fclose($gestorReactivos);

$gestorMaquinas = fopen("maquinas.json", 'w+');
fwrite($gestorMaquinas, $datosMaquinas_json);
fclose($gestorMaquinas);

$gestorMateriasPrimas = fopen("materiasPrimas.json", 'w+');
fwrite($gestorMateriasPrimas, $datosMateriasPrimas_json);
fclose($gestorMateriasPrimas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Crear servicios</title>
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
                                <a class="nav-link" href="#">Crear servicios</a>
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
                    <h1 class="mt-4">Crear servicios</h1>


                    <div>
                        <a href="listadoServicios.php" class="btn btn-primary mb-3 mt-3">Listado de servicios</a>
                    </div>

                    <form action="../crud/crudServicio.php" method="post">

                        <fieldset>
                            <legend>Información del servicio</legend>

                            <div class="form-group">
                                <label for="">Identificador</label>
                                <input type="number" class="form-control" name="identificador" required>
                            </div>

                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <textarea class="form-control" name="descripcion" rows="3" required>

                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Categoria</label>

                                <select name="categoriaId" required>
                                    <option value="">Selecciona la categoria</option>
                                    <?php while ($filaCategoria = $resultadoCategoria->fetch_assoc()) { ?>
                                        <option value="<?php echo $filaCategoria['identificador']; ?>"><?php echo $filaCategoria['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </fieldset>

                        <fieldset>

                            <legend>Informacion sobre elementos necesarios</legend>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button class="btn btn-primary mr-20" id="agregarReactivosNecesarios">Agregar reactivo</button>
                                    <button class="btn btn-primary mr-20" id="agregarMaquinaNecesarias">Agregar maquina</button>
                                    <button class="btn btn-primary " id="agregarMateriasPrimasNecesarias">Agregar Materia prima</button>
                                </div>
                            </div>

                            <div class="contenedorElementosNecesarios row">

                                <div class="col mb-3">
                                    <div>
                                        <label for="">reactivo necesario</label>

                                        <select name="reactivoNecesario1" required>
                                            <option value="">elija una opcion</option>
                                            <?php
                                            $resultado = mostrarReactivos($bd);
                                            while ($fila = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $fila['identificador']; ?>"><?php echo $fila['nombre']; ?></option>
                                            <?php  } ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <div>
                                        <label for="">Maquina necesaria</label>

                                        <select name="maquinaNecesaria1" required>
                                            <option value="">seleccione una opcion</option>

                                            <?php
                                            $resultado = mostrarMaquinas($bd);
                                            while ($fila = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $fila['identificador']; ?>"><?php echo $fila['nombre']; ?></option>
                                            <?php  } ?>

                                        </select>

                                    </div>
                                </div>


                                <div class="col mb-3">
                                    <div>
                                        <label for="">Materia prima necesaria</label>

                                        <select name="materiaPrimaNecesaria1" required>
                                            <option value="">seleccione una opcion</option>
                                            <?php
                                            $resultado = mostrarMateriasPrimas($bd);
                                            while ($fila = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $fila['identificador']; ?>"><?php echo $fila['nombre']; ?></option>
                                            <?php  } ?>
                                        </select>


                                    </div>
                                </div>

                            </div>

                            <!-- inputs dinamicamente -->
                            <div class="row">
                                <div id="contenedorElementosNecesariosClon" class="col">

                                </div>

                                <div id="contenedorMaquinasNecesariasClon" class="col">

                                </div>

                                <div id="contenedorMateriasPrimasNecesarias" class="col">

                                </div>

                            </div>


                            <div style="width: 300px;">
                                <label class="mb-3">Porcentaje de ganancia</label>
                                <div class="input-group ancho">
                                    <input type="text" class="form-control" name="porcentaje">
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

                                <select name="presionArterial">
                                    <option value="">elige una opcion</option>
                                    <option value="baja">baja</option>
                                    <option value="sube">sube</option>
                                </select>
                            </div>


                            <div>
                                <label>Evolucion</label>
                                <select name="evolucion" required >
                                    <option value="">elija una opcion</option>
                                    <option value="positiva">positiva</option>
                                    <option value="negativa" disabled>negativa</option>
                                </select>
                            </div>

                        </fieldset>

                </div>


                <div class="form-group" style="margin-left: 20px;">
                    <input type="hidden" name="estado" value="activo">
                    <input type="hidden" name="operacion" value="guardar">
                    <input type="hidden" id="totalReactivosNecesarios" name="totalReactivosNecesarios">
                    <input type="hidden" id="totalMaquinasNecesarias" name="totalMaquinasNecesarias">
                    <input type="hidden" id="totalMateriasPrimasNecesarias" name="totalMateriasPrimasNecesarias">
                    <input class="btn btn-primary" value="Cancelar" type="reset" id="cancelarRegistroServicio">
                    <input class="btn btn-primary" type="submit" value="Registrar" id="registrarServicio">
                </div>

                </form>
            </main>

            <?php require "../templates/footer.php" ?>
        </div>



    </div>
    </div>
    <script src="../../assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>