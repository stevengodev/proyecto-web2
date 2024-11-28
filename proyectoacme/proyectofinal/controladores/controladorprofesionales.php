<?php  

    require("interfazcontrolador.php");

   class ControladorProfesional implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';
        
        $sql = "call gestionarprofesionales(?,?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sssssss",
            $operacion,
            $objeto->tipoIdentificacion,
            $objeto->identificacion,
            $objeto->nombres,
            $objeto->apellidos,
            $objeto->celular,
            $objeto->estado

        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarprofesionales(?,?,?,null,null,null,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("ssss",
            $operacion,
            $objeto->tipoIdentificacion,
            $objeto->identificacion,
            $objeto->estado
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){

     }
     
     public function listar($bd){
      $operacion = 'L';
        
      $sql = "call gestionarprofesionales(?,null,null,null,null,null, null)";

      $stmt = $bd->prepare($sql);

      $stmt->bind_param("s",
          $operacion
      );

      $stmt->execute();

      $resultado = $stmt->get_result();  
      return $resultado;
     }

   }
