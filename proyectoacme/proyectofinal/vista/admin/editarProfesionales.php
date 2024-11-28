<?php

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

if (isset($_GET['identificacion'])) {
    $identificacion = $_GET['identificacion'];
}


if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $identificacion = $_POST['identificacion'];
    $tipoidentificacion =  $_POST['tipoidentificacion'];
    $nombres =  $_POST['nombres'];
    $apellidos =  $_POST['apellidos'];
    $celular = $_POST['celular'];
    $usuario =  $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];

    $totalEstudios = $_POST['totalEstudios'];
    $totalExperticias = $_POST['totalExperticias'];

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

        header('Location: crearProfesionales.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar profesionales</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>


    <h1 class="text-center mt-5">Editar profesionales</h1>
    <div style="display:flex; justify-content:center;">
        <form action="" method="POST" style="width:1000px">
            <fieldset>

                <legend>Datos del profesional</legend>

                <div class="row">
                    <div class="form-group col">
                        <label for="">Identificacion</label>
                        <input type="text" class="form-control" name="identificacion" value="<?php echo $identificacion; ?>">
                    </div>


                    <div class="form-group col">
                        <label for="">Tipo de identificacion</label>

                        <select name="tipoidentificacion" class="custom-select custom-select-sm">
                            <option value="">Selecciona el tipo de identificacion</option>
                            <option value="C">C</option>
                            <option value="I">I</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="">Nombres</label>
                    <input type="text" class="form-control" id="" name="nombres" value="">
                </div>

                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" class="form-control" id="" name="apellidos" value="">
                </div>

                <div class="form-group">
                    <label for="">Celular</label>
                    <input type="text" class="form-control" id="" name="celular" value="">
                </div>

                <div class="form-group col">
                        <label for="">estado</label>

                        <select name="estado" required>
                            <option value="">Selecciona el estado del profesional</option>
                            <option value="activo">activo</option>
                            <option value="activo">inactivo</option>
                        </select>
                    </div>

            </fieldset>

            <fieldset>

                <legend>Establecer usuario y contraseña</legend>

                <div class="d-flex justify-content-between">
                    <div>
                        <label for="">Usuario</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>

                    <div>
                        <label for="">Contraseña</label>
                        <input type="text" class="form-control" name="contrasena">
                    </div>

                </div>

            </fieldset>

            <div class="form-group">
                <input type="hidden" name="tipo" value="P">
                <input type="hidden" name="operacion" value="guardar">
                <a href="listadoProfesionales.php" class="btn btn-secondary">Cancelar</a>
                <input class="btn btn-primary" type="submit" value="Registrar" id="">
            </div>

        </form>
    </div>

    <script src="/proyectofinal/assets/js/utilidades.js"></script>
</body>

</html>