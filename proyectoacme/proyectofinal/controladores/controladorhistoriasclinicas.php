<?php  

    require("interfazcontrolador.php");

   class ControladorHistoriasClinicas implements InterfazControlador{

     public function guardar($objeto, $bd){

     }

     public function eliminar($objeto, $bd){

     }
      
     public function consultarRegistro($objeto, $bd){
        
        $sql = "call gestionarhistoriasclinicas(?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("ss",
            $objeto->tipoIdentificacion,
            $objeto->identificacion
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;


     }
     
     public function listar($bd){

     }

   }
