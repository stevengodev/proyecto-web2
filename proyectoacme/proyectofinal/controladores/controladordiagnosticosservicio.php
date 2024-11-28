<?php  

   class ControladorDiagnosticosServicios{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionardiagnosticosservicios(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->diagnosticoId,
            $objeto->servicioId
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';
        
        $sql = "call gestionardiagnosticosservicios(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
        $operacion,
        $objeto->diagnosticoId,
        $objeto->servicioId
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionardiagnosticosservicios(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->diagnosticoId,
            $objeto->servicioId
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionardiagnosticosservicios(?,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("s",
            $operacion
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }

   }
 

?>