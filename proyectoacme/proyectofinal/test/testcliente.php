<?php

require("../modelos/clientes.php");
require("../controladores/controladorcliente.php");

require '../componentes/conexionbd.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$cliente = new Clientes('C','100','STEVEN','GOMEZ','STEVEN@GMAIL.COM','3218146258','2004-04-24','ANA','FOLIACO','1981-02-07');

$controladorCliente = new ControladorClientes();
$controladorCliente->guardar($cliente, $bd);
$resultado = $controladorCliente->consultarRegistro($cliente, $bd);

while ($fila = $resultado->fetch_assoc()) {
  echo "Identificador: ".$fila['identificacion'] . "Nombres: ".$fila['nombres'] . "<br>"; 
}