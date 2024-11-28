<?php  


   class ControladorElementosServicios{

     public function guardar($objeto,$bd){
        $operacion = 'G';

        $sql = "call gestionarelementosservicios(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->elementoId,
            $objeto->servicioId
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarelementosservicios(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->elementoId,
            $objeto->servicioId
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){

        $operacion = 'C';
        
        $sql = "call gestionarelementosservicios(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->elementoId,
            $objeto->servicioId
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionarelementosservicios(?,null,null)";

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