<?php

require '../../modelos/citas.php';
require '../../controladores/controladorcitas.php';
require '../../componentes/conexionbd.php';

$operacion = $_POST['operacion'];
$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$controladorCita = new ControladorCitas;

$identificador = $_POST['identificador'];
$rol = $_POST['rol'];

if ($operacion == 'guardar' && $rol == 'profesional') {

    $tipoIdentificacionCliente = $_POST['tipoIdentificacionCliente'];
    $identificacionCliente = $_POST['identificacionCliente'];
    $fecha = $_POST['fecha'];

    $cita = new Citas($identificador, $fecha, null, null, $tipoIdentificacionCliente, $identificacionCliente);
    $controladorCita->guardar($cita, $bd);

    header('Location: ../profesional/asignarCita.php');

} elseif ($operacion == 'guardar' && $rol == 'cliente') {

    $tipoIdentificacionCliente = $_POST['tipoIdentificacionCliente'];
    $identificacionCliente = $_POST['identificacionCliente'];
    $fecha = $_POST['fecha'];

    $cita = new Citas($identificador, $fecha, null, null, $tipoIdentificacionCliente, $identificacionCliente);
    $controladorCita->guardar($cita, $bd);

    header('Location: ../cliente/agendarCitas.php');

}elseif ($operacion == 'eliminar' && $rol == 'cliente') {
    $cita = new Citas($identificador, null, null, null, null, null);
    $controladorCita->eliminar($cita, $bd);

    header('Location: ../cliente/listadoCitas.php');

} elseif ($operacion == 'eliminar' && $rol == 'profesional') {
    $cita = new Citas($identificador, null, null, null, null, null);
    $controladorCita->eliminar($cita, $bd);

    header('Location: ../profesional/listadoCitas.php');

}
