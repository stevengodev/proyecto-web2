<?php  

    require("interfazcontrolador.php");

   class ControladorLogin implements InterfazControlador{

     public function guardar($objeto, $bd){

     }

     public function eliminar($objeto, $bd){

     }
      
     public function consultarRegistro($objeto, $bd){
        $sql = "select * from usuarios where usuario = ? and contrasena = ?";

        $stmt = $bd->prepare($sql);
        
        $stmt->bind_param("ss",
            $objeto->usuario, 
            $objeto->contrasena
        );

        $stmt->execute();        
        
        $resultado = $stmt->get_result();

        return $resultado;
    }
     
     public function listar($bd){

     }

   }
