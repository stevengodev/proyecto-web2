<?php   

    function mostrarServicios($bd){

    $sql = "select identificador, nombre from servicios where estado = 'activo'";

    $stmt = $bd->prepare($sql);

    $stmt->execute();

    $resultado = $stmt->get_result();  
    return $resultado;
    
    }

    function mostrarIdentificadorCita($bd){

        $sql = "SELECT * FROM citas";

        $stmt = $bd->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result();  

        if ($resultado->num_rows == 0) {
            $identificador = 1;
        }else{

            $sql = "SELECT identificador FROM citas ORDER BY identificador DESC LIMIT 1";

            $stmt = $bd->prepare($sql);
    
            $stmt->execute();
    
            $resultado = $stmt->get_result();
            // return $resultado;
    
            while ($fila = $resultado->fetch_assoc()) {
                $identificador = $fila['identificador'];
            }
    
            $identificador+=1;
        }

        return $identificador;

    }

    function mostrarReactivos($bd){
        $sql = "SELECT identificador, nombre, costo FROM elementos WHERE tipo = 'reactivo'";
        
        $stmt = $bd->prepare($sql);

        $stmt->execute();
    
        $resultado = $stmt->get_result();  
        return $resultado;

    }

    function mostrarMaquinas($bd){
        $sql = "SELECT identificador, nombre, costo FROM elementos WHERE tipo = 'maquina'";
        
        $stmt = $bd->prepare($sql);

        $stmt->execute();
    
        $resultado = $stmt->get_result();  
        return $resultado;

    }

    function mostrarMateriasPrimas($bd){
        $sql = "SELECT identificador, nombre, costo FROM elementos WHERE tipo = 'materia prima'";
        
        $stmt = $bd->prepare($sql);

        $stmt->execute();
    
        $resultado = $stmt->get_result();  
        return $resultado;

    }

    function mostrarCitasProximas($fecha, $bd){
        $sql = "select ci.fecha , cl.nombres, cl.apellidos, cl.celular
        from citas ci, clientes cl
        where (ci.fecha between ? and date_add(?, interval 30 minute))
        and (ci.tipoidentificacioncliente = cl.tipoidentificacion and ci.identificacioncliente = cl.identificacion);
        ";
        
        
        $stmt = $bd->prepare($sql);
        $stmt->bind_param("ss",
            $fecha,
            $fecha
        );

        $stmt->execute();
    
        $resultado = $stmt->get_result();  
        return $resultado;
    }

    function mostrarIdentificadorExperticia($bd){

        $sql = "SELECT * FROM experticias";

        $stmt = $bd->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result();  

        if ($resultado->num_rows == 0) {
            $identificador = 1;
        }else{
            $sql = "SELECT identificador FROM experticias ORDER BY identificador DESC LIMIT 1";

            $stmt = $bd->prepare($sql);
    
            $stmt->execute();
    
            $resultado = $stmt->get_result();
            // return $resultado;
    
            while ($fila = $resultado->fetch_assoc()) {
                $identificador = $fila['identificador'];
            }
    
            $identificador+=1;
        }

        return $identificador;

    }

    function mostrarIdentificadorEstudio($bd){

        $sql = "SELECT * FROM estudios";

        $stmt = $bd->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result();  

        if ($resultado->num_rows == 0) {
            $identificador = 1;
        }else{
            $sql = "SELECT identificador FROM estudios ORDER BY identificador DESC LIMIT 1";

            $stmt = $bd->prepare($sql);
    
            $stmt->execute();
    
            $resultado = $stmt->get_result();
            // return $resultado;
    
            while ($fila = $resultado->fetch_assoc()) {
                $identificador = $fila['identificador'];
            }
    
            $identificador+=1;
        }        

        return $identificador;

    }

    function datosNecesariosFactura($identificadorCita, $bd){
        $sql = "SELECT ci.identificador citaid, cl.identificacion, cl.tipoidentificacion, cl.nombres, cl.apellidos ,ds.servicioId, s.precio, s.costoTotal, s.ganancia,s.nombre 
        FROM citas ci, tratamientos t, clientes cl, diagnosticosservicios ds, servicios s
        WHERE ci.identificador = t.citaId AND 
            (ci.tipoidentificacioncliente = cl.tipoidentificacion AND ci.identificacioncliente = cl.identificacion ) AND
            t.diagnosticoId = ds.diagnosticoId AND
            ds.servicioId = s.identificador
        GROUP BY 1, 6
        HAVING ci.identificador = ?";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("i",
            $identificadorCita
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

    }

    function mostrarUsuario($tipoIdentificacionCliente, $identificacion, $bd){
        $sql = "SELECT usuario, contrasena FROM usuarios WHERE tipoidentificacioncliente = ? AND identificacioncliente = ?";
    
        
        $stmt = $bd->prepare($sql);

        $stmt->bind_param("ss",
            $tipoIdentificacionCliente,
            $identificacion
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

    }

    function mostrarIdentificadorServiciosNecesarios($diagnosticoId, $bd){
        $sql = "SELECT diagnosticoId, servicioId, s.peso, s.presionarterial, s.evolucion
        FROM diagnosticosservicios ds, servicios s
        WHERE ds.servicioId = s.identificador
        GROUP BY 1,2
        HAVING diagnosticoId = ?";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("i",
            $diagnosticoId
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  
        return $resultado;

    }

    function citasOtraBd($bd){
        $sql = "SELECT * FROM cita";

        $stmt = $bd->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result();  

        if ($resultado->num_rows == 0) {
            $identificador = 1;
        }else{
            $sql = "SELECT idcita FROM cita ORDER BY 1 DESC LIMIT 1";

            $stmt->execute();

            $resultado = $stmt->get_result(); 

            while ($fila = $resultado->fetch_assoc()) {
                $identificador = $fila['idcita'] + 1 ; 
            }

        }

        return $identificador;
    }

    function mostrarPesoAnterior($diagnosticoId, $bd){
        $sql = "SELECT * FROM tratamientos WHERE diagnosticoId = ?";

        $stmt = $bd->prepare($sql);

        $stmt->bind_param("i",
            $diagnosticoId
        );

        $stmt->execute();

        $resultado = $stmt->get_result();  

        if ($resultado->num_rows == 0) {
            $sql = "SELECT peso, presionarterial FROM diagnosticos WHERE identificador = ?";

            $stmt = $bd->prepare($sql);

            $stmt->bind_param("i",
                $diagnosticoId
            );
    
            $stmt->execute();
    
            $resultado = $stmt->get_result(); 

        }else{


        }

        return $resultado;

    }

    function importePorServicio($bd){
        $sql = "select sum(vd.ganancia) ganancia, servicioId, nombre
        from ventasencabezado ve, ventadetalles vd, servicios s
        where vd.numerofactura = ve.numerofactura and vd.servicioId = s.identificador
        group by servicioId";

        $stmt = $bd->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result(); 

        return $resultado;

    }
