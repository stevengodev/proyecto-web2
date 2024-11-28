<?php  

   class ControladorEstudios{

     public function guardar($objeto, $bd){
        $operacion = 'G';
        
        $sql = "call gestionarestudios(?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sisss",
            $operacion,
            $objeto->identificador,
            $objeto->nombre,
            $objeto->tipoIdentificacionProfesional,
            $objeto->identificacionProfesional
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarestudios(?,?,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionarestudios(?,?,null,null,null)";

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
        
        $sql = "call gestionarestudios(?,null,null,null,null)";

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