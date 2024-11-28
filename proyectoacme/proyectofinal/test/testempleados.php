<?php

require "../modelos/empleados.php";
require "../controladores/controladorempleado.php";

require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$empleado = new Empleados('E','112','Juan andres', 'Martinez Rivera', 'gerente');

$controladorEmpleado = new ControladorEmpleado();
$controladorEmpleado->eliminar($empleado, $bd);
// $resultado = $controladorEmpleado->consultarRegistro($empleado);

// while ($fila = $resultado->fetch_assoc()) {
//   echo "Identificador: ".$fila['identificacion'] . "Nombres: ".$fila['nombres'] . "<br>"; 
// }