<?php 

class ConexionBD {

    private $conexion;

    function __construct() {

        $servidor = "127.0.0.1";
        //$servidor = "localhost";
        $usuario = "root";
        $contraseña = "";
        $baseDatos = "proyectofinal";
        $puerto = "3306";

        $this->conexion = mysqli_connect($servidor, $usuario, 
        $contraseña,$baseDatos,$puerto);
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }

}

?>