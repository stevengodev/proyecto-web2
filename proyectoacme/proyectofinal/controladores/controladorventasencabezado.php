<?php  

    require("interfazcontrolador.php");

   class ControladorVentasEncabezado implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionarventasencabezado(?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sisssd",
            $operacion,
            $objeto->numeroFactura,
            $objeto->tipoIdentificacionCliente,
            $objeto->identificacionCliente,
            $objeto->fecha,
            $objeto->total
        );

        $stmt->execute();
        
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarventasencabezado(?,?,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->numeroFactura
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){
        $operacion = 'C';
        
        $sql = "call gestionarventasencabezado(?,?,null,null,null,null)";
  
        $stmt = $bd->prepare($sql);
  
        $stmt->bind_param("ss",
            $operacion,
            $objeto->numeroFactura
        );
  
        $stmt->execute();
  
        $resultado = $stmt->get_result();  
        return $resultado;
     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionarventasencabezado(?,null,null,null,null,null)";
  
        $stmt = $bd->prepare($sql);
  
        $stmt->bind_param("s",
            $operacion
        );
  
        $stmt->execute();
  
        $resultado = $stmt->get_result();  
        return $resultado;
     }

   }
