<?php  

   class ControladorUsuarios{

     public function guardar($objeto, $bd){
      $operacion = 'G';

      $sql = "call gestionarusuarios(?,?,?,?,?,?,?,?,?,?)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("ssssssssss",
          $operacion,
          $objeto->usuario,
          $objeto->contrasena,
          $objeto->tipoIdentificacionCliente,
          $objeto->identificacionCliente,
          $objeto->tipoIdentificacionProfesional,
          $objeto->identificacionProfesional,
          $objeto->tipoIdentificacionEmpleado,
          $objeto->identificacionEmpleado,
          $objeto->tipo
      );

      $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarusuarios(?,?,null,null,null,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("ss",
            $operacion,
            $objeto->usuario
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
      $operacion = 'C';
        
      $sql = "call gestionarusuarios(?,?,null,null,null,null,null,null,null,null)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("ss",
          $operacion,
          $objeto->usuario
      );

      $stmt->execute();

      $resultado = $stmt->get_result();  
      return $resultado;
     }
     
     public function listar($bd){
      $operacion = 'L';
        
      $sql = "call gestionarusuarios(?,null,null,null,null,null,null,null,null,null)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("s",
          $operacion
      );

      $stmt->execute();

      $resultado = $stmt->get_result();  
      return $resultado;
     }

   }
