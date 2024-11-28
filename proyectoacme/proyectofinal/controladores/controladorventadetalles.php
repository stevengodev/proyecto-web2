<?php  

   class ControladorVentaDetalles{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionarventadetalles(?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sisddd",
            $operacion,
            $objeto->servicioId,
            $objeto->numeroFactura,
            $objeto->precio,
            $objeto->costo,
            $objeto->ganancia
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarventadetalles(?,?,?,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sii",
            $operacion,
            $objeto->servicioId,
            $objeto->numeroFactura
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionarventadetalles(?,?,?,null,null,null)";
  
        $stmt = $bd->prepare($sql);
  
        $stmt->bind_param("sii",
            $operacion,
            $objeto->servicioId,
            $objeto->numeroFactura
        );
  
        $stmt->execute();
  
        $resultado = $stmt->get_result();  
        return $resultado;
     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionarventadetalles(?,null,null,null,null,null)";
  
        $stmt = $bd->prepare($sql);
  
        $stmt->bind_param("s",
            $operacion
        );
  
        $stmt->execute();
  
        $resultado = $stmt->get_result();  
        return $resultado;
     }

   }
