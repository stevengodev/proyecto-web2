<?php

require("../modelos/experticias.php");
require("../controladores/controladorexperticia.php");

require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$experticia = new Experticias(null, 'experto con las manos', 'C', '3');

$controladorExperticia = new controladorExperticia();
// $controladorExperticia->eliminar($experticia);
// $resultado = $controladorExperticia->listar();

// while ($fila = $resultado->fetch_assoc()) {
//   echo "Identificador: ".$fila['identificador'] . "Nombre: ".$fila['nombre'] .
//   "tipo id profesional " . $fila['tipoidentificacionprofesional'] . "id ". $fila['identificacionprofesional'] .
//   "<br>"; 
// }

// probar