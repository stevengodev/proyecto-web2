<?php

class ElementosServicios {

    public $elementoId;
    public $servicioId;

    function __construct($elementoId, $servicioId ){

        $this->elementoId = $elementoId;
        $this->servicioId = $servicioId;

    }
}