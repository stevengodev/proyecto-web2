<?php

session_start();

$tipoIdentificacionAdmin = $_SESSION['tipoidentificacionempleado'];
$identificacionAdmin = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionAdmin == null || $tipoIdentificacionAdmin == '') && ($identificacionAdmin == null || $identificacionAdmin == '')) {
  header("Location: ../login.php");
}
// se prendio esta mierd4

// patrones
$patronCelular = '/^([0-9]{3})(-)([0-9]{3})(-)([0-9]{4})$/';

//arreglo con mensajes de errores
$errores = [];

$identificacion = "";
$tipoidentificacion = "";
$nombres = "";
$apellidos = "";
$celular = "";
$estudio1 = '';
$experticia1 = '';
$usuario = "";
$contrasena = "";
$estado = "";


if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $identificacion = $_POST['identificacion'];
    $tipoidentificacion =  $_POST['tipoidentificacion'];
    $nombres =  $_POST['nombres'];
    $apellidos =  $_POST['apellidos'];
    $celular = $_POST['celular'];
    $estudio1 = $_POST['estudio1'];
    $experticia1 = $_POST['experticia1'];
    $usuario =  $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];

    $totalEstudios = $_POST['totalEstudios'];
    $totalExperticias = $_POST['totalExperticias'];
    $arregloEstudios = [];
    $arregloExperticias = [];
    $arregloEstudiosOk = [];
    $arregloExperticiasOk = [];

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
        $errores[] = "Los apellido no es correctos";
    }

    if (!preg_match($patronCelular, $celular)) {
        $errores[] = "El numero de celular no es correcto";
    }

    if (!ctype_alnum($usuario)) {
        $errores[] = "El nombre de usuario no es correcto";
    }

    if (!ctype_alnum($contrasena)) {
        $errores[] = "La contraseña es incorrecta";
    }

    for ($iteradorExperticia = 1; $iteradorExperticia < $totalExperticias; $iteradorExperticia++) {
        array_push($arregloExperticias, $_POST["experticia${iteradorExperticia}"]);
    }

    for ($iteradorEstudio = 1; $iteradorEstudio < $totalEstudios; $iteradorEstudio++) {
        array_push($arregloEstudios, $_POST["estudio${iteradorEstudio}"]);
    }

    foreach ($arregloEstudios as $estudiox) {
        if ($estudiox == '') {
            array_push($errores, "Debes añadir los estudios");
        } else {
            array_push($arregloEstudiosOk, $estudiox);
        }
    }

    foreach ($arregloExperticias as $experticiax) {
        if ($experticiax == '') {
            array_push($errores, "Debes añadir las experticias");
        } else {
            array_push($arregloExperticiasOk, $experticiax);
        }
    }

    // revisar que el array de errores este vacio

    if (empty($errores)) {

        require '../../controladores/controladorprofesionales.php';
        require '../../modelos/profesionales.php';
        require '../../componentes/conexionbd.php';
        require '../../controladores/controladorexperticia.php';
        require '../../modelos/experticias.php';
        require '../../modelos/estudios.php';
        require '../../controladores/controladorestudio.php';
        require '../../funciones/funciones.php';
        require '../../modelos/usuarios.php';
        require '../../controladores/controladorusuarios.php';

        $conexion = new ConexionBD();
        $bd = $conexion->getConexion();

        $controladorEstudio = new ControladorEstudios();
        $controladorExperticia = new ControladorExperticia();

        $profesional = new Profesionales($tipoidentificacion, $identificacion, $nombres, $apellidos, $celular, $estado);
        $controladorProfesional = new ControladorProfesional();
        $controladorProfesional->guardar($profesional, $bd);


        foreach ($arregloExperticiasOk as $experticiaOk) {
            $identificacorExperticia = mostrarIdentificadorExperticia($bd);
            $experticia = new Experticias($identificacorExperticia, $experticiaOk, $tipoidentificacion, $identificacion);
            $controladorExperticia->guardar($experticia, $bd);
        }

        foreach ($arregloEstudiosOk as $estudioOk) {
            $identificadorEstudio = mostrarIdentificadorEstudio($bd);
            $estudio = new Estudios($identificadorEstudio, $estudioOk, $tipoidentificacion, $identificacion);
            $controladorEstudio->guardar($estudio, $bd);
            $identificadorEstudio++;
        }

        $usuario = new Usuarios($usuario, $contrasena,null,null, $tipoidentificacion, $identificacion, null, null, $tipo);
        $controladorUsuario = new ControladorUsuarios();
        $controladorUsuario->guardar($usuario, $bd);

        $identificacion = "";
        $tipoidentificacion = "";
        $nombres = "";
        $apellidos = "";
        $celular = "";
        $estudio1 = "";
        $experticia1 = '';
        $usuario = "";
        $contrasena = "";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Crear Profesionales</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
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
                                <a class="nav-link" href="#">Crear profesionales</a>
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
                    <h1 class="mt-4">Crear Profesionales</h1>

                    <div>
                        <a href="listadoProfesionales.php" class="btn btn-primary mb-3 mt-3">Listado de profesionales</a>
                    </div>

                    <div class="form-group contenedorErrores">

                        <?php foreach ($errores as $error) : ?>
                            <p class="alert alert-danger text-center" style="padding: 10px 10px;">
                                <?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>

                    <form action="" id="" method="POST">
                        <fieldset>

                            <legend>Datos del profesional</legend>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="">Identificacion</label>
                                    <input type="text" class="form-control" name="identificacion" value="<?php echo $identificacion; ?>">
                                </div>


                                <div class="form-group col">
                                    <label for="">Tipo de identificacion</label>

                                    <select name="tipoidentificacion">
                                        <option value="">Selecciona el tipo de identificacion</option>
                                        <option value="C">C</option>
                                        <option value="I">I</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" value="<?php echo $nombres; ?>" name="nombres">
                            </div>

                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" class="form-control" value="<?php echo $apellidos; ?>" name="apellidos">
                            </div>

                            <div class="form-group">
                                <label for="">Celular</label>
                                <input type="text" class="form-control" value="<?php echo $celular; ?>" name="celular" placeholder="ej: 321-654-9876">
                            </div>

                        </fieldset>

                        <fieldset>

                            <legend>Informacion sobre formacion y estudios</legend>

                            <div class="form-group">
                                <button type="button" id="agregarExperticias" class="btn btn-primary">Agregar Experticia</button>
                                <button type="button" id="agregarEstudios" class="btn btn-secondary">Agregar estudios</button>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <label for="">Experticia</label>
                                    <input type="text" class="form-control w-100 mb-3" placeholder="Experticia" name="experticia1">

                                    <div id="contenedorExperticias">

                                    </div>

                                </div>

                                <div class="col">
                                    <label for="">estudios</label>
                                    <input type="text" name="estudio1" class="form-control w-100 mb-3" placeholder="Estudios">

                                    <div id="contenedorEstudios">

                                    </div>

                                </div>

                            </div>


                        </fieldset>

                        <fieldset>

                            <legend>Establecer usuario y contraseña</legend>

                            <div class="d-flex justify-content-between">
                                <div>
                                    <label for="">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" value="<?php echo $usuario; ?>">
                                </div>

                                <div>
                                    <label for="">Contraseña</label>
                                    <input type="password" class="form-control" name="contrasena" value="<?php echo $contrasena; ?>">
                                </div>

                            </div>

                        </fieldset>

                        <div class="form-group">
                            <input type="hidden" name="tipo" value="P">
                            <input type="hidden" name="totalEstudios" id="totalEstudios">
                            <input type="hidden" name="totalExperticias" id="totalExperticias">
                            <input type="hidden" name="operacion" value="guardar">
                            <input type="hidden" name="estado" value="activo">
                            <input class="btn btn-primary" type="reset" value="Cancelar" id="cancelarRegistroProfesional">
                            <input class="btn btn-primary" type="submit" value="Registrar" id="registrarProfesional">
                        </div>

                    </form>

                </div>
            </main>
            <?php require "../templates/footer.php" ?>

        </div>
    </div>
    <script src="../../assets/js/utilidades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>