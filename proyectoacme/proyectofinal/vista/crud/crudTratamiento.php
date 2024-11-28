<?php

require '../../componentes/conexionbd.php';
require '../../modelos/tratamientos.php';
require '../../controladores/controladortratamiento.php';
require '../../funciones/funciones.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$servicios = [];

$operacion = $_POST['operacion'];

if ($operacion == 'guardar') {

    $tipoIdentificacionProfesional = $_POST['tipoidentificacionprofesional'];
    $identificacionProfesional = $_POST['identificacionprofesional'];
    $diagnosticoId = $_POST['diagnosticoId'];
    $pesoAnterior = $_POST['pesoAnterior'];
    $presionArterialAnterior = $_POST['presionArterialAnterior'];
    $peso = $_POST['peso'];
    $presionArterial = $_POST['presionArterial'];

    $identificador = $_POST['identificador'];
    $citaId = $_POST['citaId'];
    $sesionesRealizadas = $_POST['sesionesRealizadas'];
    $sesionesRestantes = $_POST['sesionesRestantes'];
    $derivacion = $_POST['derivacion'];
    $resultados = $_POST['resultados'];

    $resultado = mostrarIdentificadorServiciosNecesarios($diagnosticoId, $bd);

    $i = 0;
    while ($fila = $resultado->fetch_assoc()) {

        $servicios[$i]['servicioId'] = $fila['servicioId'];
        $servicios[$i]['peso'] = $fila['peso'];
        $servicios[$i]['presionarterial'] = $fila['presionarterial'];
        $servicios[$i]['evolucion'] = $fila['evolucion'];

        $i++;
    }


    // echo "diagnostico" . $diagnosticoId . "<br>" ;

    // echo "peso actual " . $peso . " peso anterior".$pesoAnterior . "<br>" ;

    // echo "presion actual " . $presionArterial . " presion anterior".$presionArterialAnterior . "<br>" ;


    foreach ($servicios as $servicio) {

        $evolucion = "negativa";

        echo "servicio: " . $servicio['servicioId'] . " peso: " . $servicio['peso'] . " presion " . $servicio['presionarterial'] . " ";

        if (($servicio['peso'] == 'baja' && $peso < $pesoAnterior) && ($servicio['presionarterial'] == 'baja' && $presionArterial < $presionArterialAnterior)) {
            // evolucion positiva
            $evolucion = 'positiva';
        } elseif (($servicio['peso'] == 'baja' && $peso < $pesoAnterior) && ($servicio['presionarterial'] == 'sube' && $presionArterial > $presionArterialAnterior) ) {
            // evolucion positiva
            $evolucion = 'positiva';
        } elseif (($servicio['peso'] == 'sube' && $peso > $pesoAnterior) && ($servicio['presionarterial'] == 'sube' && $presionArterial > $presionArterialAnterior)) {
            //evolucion negativa
            $evolucion = 'positiva';
        } elseif (($servicio['peso'] == 'sube' && $peso > $pesoAnterior) && ($servicio['presionarterial'] == 'sube' && $presionArterial > $presionArterialAnterior)) {
            //evolucion positiva
            $evolucion = 'positiva';
        }

        // echo "evolucion " . $evolucion . "<br>";

        $tratamiento = new Tratamientos($identificador, $peso, $presionArterial, $sesionesRealizadas, $sesionesRestantes, $derivacion, $resultados, $diagnosticoId, $citaId, $servicio['servicioId'], $evolucion, $pesoAnterior, $presionArterialAnterior);

        $controladorTratamiento = new ControladorTratamiento();
        $controladorTratamiento->guardar($tratamiento, $bd);

    }


        require '../../controladores/controladorcitas.php';
        $controladorCita = new ControladorCitas();
        $controladorCita->actualizarProfesionalEnCitas($citaId, $tipoIdentificacionProfesional, $identificacionProfesional, $bd);

        echo "guardado correctamente";

    header('Location: ../profesional/tratamiento.php');
    // } elseif ($operacion == 'eliminar') {
    //     $tratamiento = new Tratamientos($identificador, null, null, null, null, null, null, null, null);
    //     $controladorTratamiento = new ControladorTratamiento();
    //     $controladorTratamiento->eliminar($tratamiento, $bd);

    //     header('Location: ../profesional/tratamiento.php');
}
