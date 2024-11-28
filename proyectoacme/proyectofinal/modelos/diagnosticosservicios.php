<?php

class DiagnosticosServicios {

    public $diagnosticoId;
    public $servicioId;

    function __construct($diagnosticoId, $servicioId){

        $this->diagnosticoId = $diagnosticoId;
        $this->servicioId = $servicioId;

    }
}