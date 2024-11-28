<?php  

    require("interfazcontrolador.php");

   class ControladorServicios implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionarservicios(?,?,?,?,?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sissdsisss",
            $operacion,
            $objeto->identificador,
            $objeto->nombre,
            $objeto->descripcion,
            $objeto->porcentaje,
            $objeto->estado,
            $objeto->categoriaId,
            $objeto->peso,
            $objeto->presionArterial,
            $objeto->evolucion
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarservicios(?,?,null,null,null,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
      $operacion = 'C';
        
      $sql = "call gestionarservicios(?,?,null,null,null,null,null,null,null,null)";

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
        
      $sql = "call gestionarservicios(?,null,null,null,null,null,null,null,null,null)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("s",
          $operacion
      );

      $stmt->execute();

      $resultado = $stmt->get_result();  
      return $resultado;
     }

   }
