<?php  

    require("interfazcontrolador.php");


   class ControladorClientes implements InterfazControlador{

     public function guardar($objeto, $bd){
        $operacion = 'G';

        $sql = "call gestionarclientes(?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("ssssssssssss",
            $operacion,
            $objeto->tipoIdentificacion,
            $objeto->identificacion,
            $objeto->nombres,
            $objeto->apellidos,
            $objeto->correo,
            $objeto->celular,            
            $objeto->fechaNacimiento,
            $objeto->nombresAcompañante,
            $objeto->apellidosAcompañante,
            $objeto->fechaNacimientoAcompañante,
            $objeto->correoAcompañante
        );

        $stmt->execute();
     }

     public function eliminar($objeto, $bd){
        $operacion = 'E';
        
        $sql = "call gestionarclientes(?,?,?,null,null,null,null,null,null,null,null,null)";

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
        
        $sql = "call gestionarclientes(?,?,?,null,null,null,null,null,null,null,null,null)";

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
        
        $sql = "call gestionarclientes(?,null,null,null,null,null,null,null,null,null,null,null)";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("s",
            $operacion
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

     }


   }
