<?php  

   class ControladorCitas{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionarcitas(?,?,?,null,null,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sisss",
            $operacion,
            $objeto->identificador,
            $objeto->fecha,
            $objeto->tipoIdentificacionCliente,
            $objeto->identificacionCliente
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';
        
        $sql = "call gestionarcitas(?,?,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionarcitas(?,?,null,null,null,null,null)";

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
        
        $sql = "call gestionarcitas(?,null,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("s",
            $operacion
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }

     public function registroDeCitas($tipoIdentificacion, $identificacion, $bd){
      $operacion = 'R';
      
      $sql = "call gestionarcitas(?,null,null,null,null,?,?)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("sss",
          $operacion,
          $tipoIdentificacion,
          $identificacion
      );

      $stmt->execute();

      $resultado = $stmt->get_result();  
      return $resultado;

   }

   public function actualizarProfesionalEnCitas($citaId, $tipoIdentificacion, $identificacion,$bd){
      $operacion = 'U';
      
      $sql = "call gestionarcitas(?,?,null,?,?,null,null)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("siss",
          $operacion,
          $citaId,
          $tipoIdentificacion,
          $identificacion
      );

      $stmt->execute();
   }

   }

?>
