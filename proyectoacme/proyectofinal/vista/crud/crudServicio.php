<?php

require '../../componentes/conexionbd.php';
require '../../modelos/servicios.php';
require '../../modelos/elementosservicios.php';
require '../../controladores/controladorelementosservicios.php';
require '../../controladores/controladorservicios.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$operacion = $_POST['operacion'];

// echo $porcentaje;
if ($operacion == 'guardar') {

    $identificador = $_POST['identificador'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoriaId = $_POST['categoriaId'];
    $porcentaje = $_POST['porcentaje'];
    $estado = $_POST['estado'];
    $totalReactivosNecesarios = $_POST['totalReactivosNecesarios'];
    $totalMaquinasNecesarias = $_POST['totalMaquinasNecesarias'];
    $totalMateriasPrimasNecesarias = $_POST['totalMateriasPrimasNecesarias'];
    $peso = $_POST['peso'];
    $presionArterial = $_POST['presionArterial'];
    $evolucion = $_POST['evolucion'];

    $arregloReactivos = [];
    $arregloMaquinas = [];
    $arregloMateriasPrimas = [];

    $porcentaje = (float)$porcentaje;
    $porcentaje = $porcentaje / 100;
    $descripcion = trim($descripcion);

    $servicio = new Servicios($identificador, $nombre, $descripcion, $porcentaje, $estado, $categoriaId, $peso, $presionArterial, $evolucion);

    $controladorServicio = new ControladorServicios();
    $controladorServicio->guardar($servicio, $bd);

    for ($iteradorReactivosNecesarios = 1; $iteradorReactivosNecesarios < $totalReactivosNecesarios; $iteradorReactivosNecesarios++) {
        array_push($arregloReactivos, (int)$_POST["reactivoNecesario${iteradorReactivosNecesarios}"]);
    }

    for ($iteradorMaquinasNecesarias = 1; $iteradorMaquinasNecesarias < $totalMaquinasNecesarias; $iteradorMaquinasNecesarias++) {
        array_push($arregloMaquinas, (int)$_POST["maquinaNecesaria${iteradorMaquinasNecesarias}"]);
    }

    for ($iteradorMateriasPrimasNecesarias = 1; $iteradorMateriasPrimasNecesarias < $totalMateriasPrimasNecesarias; $iteradorMateriasPrimasNecesarias++) {
        array_push($arregloMateriasPrimas, (int)$_POST["materiaPrimaNecesaria${iteradorMateriasPrimasNecesarias}"]);
    }

    $arregloReactivos = array_unique($arregloReactivos);
    $arregloMaquinas = array_unique($arregloMaquinas);
    $arregloMateriasPrimas = array_unique($arregloMateriasPrimas);

    foreach ($arregloReactivos as $reactivo) {
        // echo $reactivo . "<br>";
        $elementoServicio1 = new ElementosServicios($reactivo, $identificador);
        $controladorElementoServicio1 = new ControladorElementosServicios();
        $controladorElementoServicio1->guardar($elementoServicio1, $bd);
    }

    foreach ($arregloMaquinas as $maquina) {
        // echo $maquina . "<br>";
        $elementoServicio2 = new ElementosServicios($maquina, $identificador);
        $controladorElementoServicio2 = new ControladorElementosServicios();
        $controladorElementoServicio2->guardar($elementoServicio2, $bd);
    }

    foreach ($arregloMateriasPrimas as $materiaPrima) {
        // echo $materiaPrima . "<br>";
        $elementoServicio3 = new ElementosServicios($materiaPrima, $identificador);
        $controladorElementoServicio3 = new ControladorElementosServicios();
        $controladorElementoServicio3->guardar($elementoServicio3, $bd);
    }

    $controladorServicio->guardar($servicio, $bd);

    header('Location: ../admin/crearServicios.php');
} elseif ($operacion == 'eliminar') {

    $identificador = $_POST['identificador'];

    $servicio = new Servicios($identificador, null, null, null, null, null, null, null, null);
    $controladorServicio = new ControladorServicios();


    $controladorServicio->eliminar($servicio, $bd);
    header('Location: ../gerente/serviciosofertados.php');

}
