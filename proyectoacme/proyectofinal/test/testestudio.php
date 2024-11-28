<?php

require("../modelos/estudios.php");
require("../controladores/controladorestudio.php");

require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$estudio = new Estudios(null, 'tecnico en masajes', 'C', '1');

$controladorEstudio = new ControladorEstudios();
// $controladorEstudio->eliminar($estudio);
// $resultado = $controladorEstudio->listar();

// while ($fila = $resultado->fetch_assoc()) {
//   echo "Identificador: ".$fila['identificador'] . "Nombre: ".$fila['nombre'] .
//   "tipo id profesional " . $fila['tipoidentificacionprofesional'] . "id ". $fila['identificacionprofesional'] .
//   "<br>"; 
// }

// probar