<?php  

    require("interfazcontrolador.php");


   class ControladorEmpleado extends ConexionBD  
     implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';
        
        $sql = "call gestionarempleados(?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("ssssss",
            $operacion,
            $objeto->tipoIdentificacion,
            $objeto->identificacion,
            $objeto->nombres,
            $objeto->apellidos,
            $objeto->tipo
        );

        $stmt->execute();

     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';

        $sql = "call gestionarempleados(?,?,?,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sss",
            $operacion,
            $objeto->tipoIdentificacion,
            $objeto->identificacion
        );

        $stmt->execute();
     }
      
     public function consultarRegistro($objeto, $bd){

        $operacion = 'C';
        
        $sql = "call gestionarempleados(?,?,?,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("sss",
            $operacion,
            $objeto->tipoIdentificacion,
            $objeto->identificacion
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }
     
     public function listar($bd){
        $operacion = 'L';
        
        $sql = "call gestionarempleados(?,null,null,null,null,null)";

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