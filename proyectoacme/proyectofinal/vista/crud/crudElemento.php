<?php

require '../../modelos/elementos.php';
require '../../controladores/controladorelementos.php';
require '../../componentes/conexionbd.php';

$operacion = $_POST['operacion'];
$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$controladorElemento = new ControladorElementos();

if ($operacion == 'guardar') {

    $identificador = $_POST['identificador'];
    $nombre = $_POST['nombre'];
    $costo = $_POST['costo'];
    $tipo = $_POST['tipo'];

    $elemento = new Elementos($identificador, $nombre, $costo, $tipo);
    $controladorElemento->guardar($elemento, $bd);
    header('Location: ../admin/crearReactivos.php');

}elseif ($operacion == 'eliminar') {

    $identificador = $_POST['identificador'];

    $elemento = new elementos($identificador);
    $controladorElemento->eliminar($elemento, $bd);
    header('Location: ../admin/listadoReactivos.php');

}elseif ($operacion == 'consultar') {

    $identificador = $_POST['identificador'];
    $elemento = new elementos($identificador);
    $controladorElemento->consultarRegistro($elemento, $bd);
    header('Location: ../admin/listadoReactivos.php');

}elseif ($operacion == 'listar') {
    $controladorElemento->listar($bd);
    header('Location: ../admin/listadoReactivos.php');

}


?>