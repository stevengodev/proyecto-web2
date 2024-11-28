<?php

require("../controladores/controladorcategoria.php");
require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorCategoria = new ControladorCategoria();
// $controladorCategoria->guardar($categoria);
$resultado = $controladorCategoria->listar($bd);


while ($fila = $resultado->fetch_assoc()) {
  echo $fila['identificador'] . $fila['nombre'] . "<br>" ;
}
