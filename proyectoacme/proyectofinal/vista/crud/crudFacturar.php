<?php 

require '../../componentes/conexionbd.php';
require '../../funciones/funciones.php';
require '../../modelos/ventasencabezado.php';
require '../../modelos/ventadetalles.php';
require '../../controladores/controladorventasencabezado.php';
require '../../controladores/controladorventadetalles.php';

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$operacion = $_POST['operacion'];

if ($operacion == 'guardar') {

    $numerofactura = $_POST['numerofactura'];
    $tipoIdentificacion = $_POST['tipoIdentificacion'];
    $identificacion = $_POST['identificacion'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $precioTotal = $_POST['preciototal'];

    date_default_timezone_set("America/Bogota");
    $fecha = date("Y-m-d H:i:s");

    $ventaEncabezado = new VentasEncabezado($numerofactura, $tipoIdentificacion, $identificacion,$fecha,$precioTotal);
    $controladorVentaEncabezado = new ControladorVentasEncabezado();
    $controladorVentaEncabezado->guardar($ventaEncabezado, $bd);

    // $iterador = 0;
    $citaId = $_POST['identificadorCita'];
    $resultado = datosNecesariosFactura($citaId, $bd);

    while ($fila = $resultado->fetch_assoc()) {
        $precio = $fila['precio'];
        $costo = $fila['costoTotal'];
        $ganancia = $fila['ganancia'];
        $servicioId = $fila['servicioId'];

        $ventaDetalle = new VentaDetalles($servicioId, $numerofactura, $precio, $costo, $ganancia);

        $controladorVentaDetalle = new ControladorVentaDetalles();
        $controladorVentaDetalle->guardar($ventaDetalle, $bd);

        // $arregloServicios[$iterador]['identificador'] = $servicioId;
        // $arregloServicios[$iterador]['precio'] = $precio;
        // $arregloServicios[$iterador]['costo'] = $costo;
        // $arregloServicios[$iterador]['ganancia'] = $ganancia;
        // $iterador++;
    }

    header('Location: ../secretaria/facturarServicio.php');


}


