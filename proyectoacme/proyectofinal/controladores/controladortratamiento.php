<?php  

    require("interfazcontrolador.php");

   class ControladorTratamiento implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionartratamientos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("siiiiissiiisdd",
            $operacion,
            $objeto->identificador,
            $objeto->peso,
            $objeto->presionArterial,
            $objeto->sesionesRealizadas,
            $objeto->sesionesRestantes,
            $objeto->derivacion,
            $objeto->resultados,
            $objeto->diagnosticoId,
            $objeto->citaId,
            $objeto->servicioId,
            $objeto->evolucion,
            $objeto->pesoAnterior,
            $objeto->presionArterialAnterior
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionartratamientos(?,?,null,null,null,null,null,null,null,null,?,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->identificador,
            $objeto->servicioId
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionartratamientos(?,?,null,null,null,null,null,null,null,null,?,null,null,null)";
  
        $stmt = $bd->prepare($sql);
  
        $stmt->bind_param("sii",
            $operacion,
            $objeto->identificador,
            $objeto->servicioId
        );
  
        $stmt->execute();
  
        $resultado = $stmt->get_result();  
        return $resultado;
     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionartratamientos(?,null,null,null,null,null,null,null,null,null,null,null,null,null)";
  
        $stmt = $bd->prepare($sql);
  
        $stmt->bind_param("s",
            $operacion
        );
  
        $stmt->execute();
  
        $resultado = $stmt->get_result();  
        return $resultado;
     }

   }
