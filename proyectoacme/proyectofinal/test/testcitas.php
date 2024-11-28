<?php

require("../modelos/citas.php");
require("../controladores/controladorcitas.php");
require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

// para registro nuevo colocar null, para editar colocar el id
// $cita = new Citas(null, '2022-11-02 05:10:00','null','null','C','1');
$cita = new Citas(null, 'null','null','null','C','1');

$controladorCitas = new ControladorCitas();

$resultado = $controladorCitas->listar($bd);

while ($fila = $resultado->fetch_assoc()) {
  echo "Identificador: ".$fila['identificador'] . "Fecha: ".$fila['fecha'] . "<br>"; 
}

