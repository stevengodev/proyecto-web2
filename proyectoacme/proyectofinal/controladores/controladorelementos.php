<?php  

    require("interfazcontrolador.php");


   class ControladorElementos implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionarelementos(?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sisis",
            $operacion,
            $objeto->identificador,
            $objeto->nombre,
            $objeto->costo,
            $objeto->tipo
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){

        $operacion = 'E';

        $sql = "call gestionarelementos(?,?,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("si",
            $operacion,
            $objeto->identificador
        );

        $stmt->execute();

     }
      
     public function consultarRegistro($objeto, $bd){

        $operacion = 'C';
        
        $sql = "call gestionarelementos(?,?,null,null,null)";

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
        
        $sql = "call gestionarelementos(?,null,null,null,null)";

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