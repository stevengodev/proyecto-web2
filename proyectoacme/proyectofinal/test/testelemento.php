<?php

require("../modelos/elementos.php");
require("../controladores/controladorelementos.php");

require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$elemento = new Elementos(1);

$controladorElemento = new ControladorElementos();
// $controladorElemento->eliminar($elemento, $bd);
$resultado = $controladorElemento->listar($bd);

while ($fila = $resultado->fetch_assoc()) {
  echo "Identificador: ".$fila['identificador'] . "Nombre: ".$fila['nombre'] .
  "costo " . $fila['costo'] . "tipo ". $fila['tipo'] .
  "<br>"; 
}
