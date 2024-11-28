<?php  

    require("interfazcontrolador.php");


   class ControladorDiagnosticos implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionardiagnosticos(?,?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("siiisii",
            $operacion,
            $objeto->identificador,
            $objeto->peso,
            $objeto->presionArterial,
            $objeto->diagnostico,
            $objeto->numeroSesiones,
            $objeto->citaId

        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';
        
        $sql = "call gestionardiagnosticos(?,?,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionardiagnosticos(?,?,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionardiagnosticos(?,null,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("s",
            $operacion,
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }

   }
 

?>