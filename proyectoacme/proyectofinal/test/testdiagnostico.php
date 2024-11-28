<?php

require("../modelos/diagnosticos.php");
require("../controladores/controladordiagnostico.php");

require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$diagnostico = new Diagnosticos(2, 20,100,'bbbbbbbb',10,2);

$controladorDiagnosticos = new ControladorDiagnosticos();
$controladorDiagnosticos->guardar($diagnostico, $bd);

$resultado = $controladorDiagnosticos->listar($bd);

while ($fila = $resultado->fetch_assoc()) {
  echo "Identificador: ".$fila['identificador'] . "Diagnostico: ".$fila['diagnostico'] . "<br>"; 
}
