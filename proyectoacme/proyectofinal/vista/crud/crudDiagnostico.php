<?php
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

require '../../componentes/conexionbd.php';
require '../../controladores/controladordiagnostico.php';
require '../../modelos/diagnosticos.php';


$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$arregloServiciosNecesarios = [];

$identificador = $_POST['identificador'];
$citaId = $_POST['citaId'];
$peso = $_POST['peso'];
$presionArterial = $_POST['presionArterial'];
$textoDiagnostico = $_POST['diagnostico'];
$operacion = $_POST['operacion'];
$totalServiciosNecesarios = $_POST['totalServiciosNecesarios'];
$numeroSesiones = $_POST['numeroSesiones'];

for ($iteradorServicioNecesario = 1; $iteradorServicioNecesario < $totalServiciosNecesarios; $iteradorServicioNecesario++) {
    // echo $_POST["servicioNecesario${iteradorServicioNecesario}"];
    array_push($arregloServiciosNecesarios, $_POST["servicioNecesario${iteradorServicioNecesario}"]);
}

$arregloServiciosNecesarios = array_unique($arregloServiciosNecesarios);

$controladorDiagnostico = new ControladorDiagnosticos();

if ($operacion == 'guardar') {

    $tipoIdentificacionProfesional = $_POST['tipoidentificacionprofesional'];
    $identificacionProfesional = $_POST['identificacionprofesional'];

    $diagnostico = new Diagnosticos($identificador, $peso, $presionArterial, $textoDiagnostico, $numeroSesiones, $citaId);
    $controladorDiagnostico->guardar($diagnostico, $bd);

    require '../../modelos/diagnosticosservicios.php';
    require '../../controladores/controladordiagnosticosservicio.php';
    require '../../controladores/controladorcitas.php';

    $controladorDiagnosticoServicio = new ControladorDiagnosticosServicios();
    foreach ($arregloServiciosNecesarios as $servicio) {
        $diagnosticoServicio = new DiagnosticosServicios($identificador, $servicio);
        $controladorDiagnosticoServicio->guardar($diagnosticoServicio, $bd);
    }

    
    $controladorCita = new ControladorCitas();
    $controladorCita->actualizarProfesionalEnCitas($citaId, $tipoIdentificacionProfesional,$identificacionProfesional, $bd);

    header('Location: ../profesional/diagnostico.php');
}
