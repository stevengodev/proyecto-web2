<?php

require '../../controladores/controladorprofesionales.php';
require '../../componentes/conexionbd.php';
require '../../modelos/profesionales.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorProfesional = new ControladorProfesional();

$operacion = $_POST['operacion'];
$tipoidentificacion = $_POST['tipoidentificacion'];
$identificacion = $_POST['identificacion'];
$estado = $_POST['estado'];

if ($operacion == 'eliminar') {
    $profesional = new Profesionales($tipoidentificacion, $identificacion, null, null, null, $estado);
    $controladorProfesional->eliminar($profesional, $bd);

    header('Location: ../admin/listadoProfesionales.php');

}

?>