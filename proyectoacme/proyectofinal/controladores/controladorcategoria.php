<?php  

   class ControladorCategoria{

     public function guardar($objeto, $bd){

        $operacion = 'G';

        $sql = "call gestionarcategorias(?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sis",
            $operacion,
            $objeto->identificador,
            $objeto->nombre
        );

        $stmt->execute();

     }

     public function eliminar($objeto, $bd){

        $operacion = 'E';
        
        $sql = "call gestionarcategorias(?,?,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();


     }
      
     public function consultarRegistro($objeto, $bd){

        $operacion = 'C';
        
        $sql = "call gestionarcategorias(?,?,null)";

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
        
        $sql = "call gestionarcategorias(?,null,null)";

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