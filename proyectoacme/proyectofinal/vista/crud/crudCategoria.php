<?php

require '../../modelos/categorias.php';
require '../../controladores/controladorcategoria.php';
require '../../componentes/conexionbd.php';

$operacion = $_POST['operacion'];
$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$controladorCategoria = new ControladorCategoria();

if ($operacion == 'guardar') {

    $identificador = $_POST['identificador'];
    $nombre = $_POST['nombre'];

    $categoria = new Categorias($identificador, $nombre);
    $controladorCategoria->guardar($categoria, $bd);
    header('Location: ../admin/crearCategorias.php');

}elseif ($operacion == 'eliminar') {

    $identificador = $_POST['identificador'];

    $categoria = new Categorias($identificador);
    $controladorCategoria->eliminar($categoria, $bd);
    header('Location: ../admin/listadoCategorias.php');

}elseif ($operacion == 'consultar') {

    $identificador = $_POST['identificador'];
    $categoria = new Categorias($identificador);
    $controladorCategoria->consultarRegistro($categoria, $bd);
    header('Location: ../admin/listadoCategorias.php');

}elseif ($operacion == 'listar') {
    $controladorCategoria->listar($bd);
    header('Location: ../admin/listadoCategorias.php');

}


?>