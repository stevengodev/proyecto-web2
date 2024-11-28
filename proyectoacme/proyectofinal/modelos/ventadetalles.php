<?php

class VentaDetalles {

    public $servicioId;
    public $numeroFactura;
    public $precio;
    public $costo;
    public $ganancia;

    function __construct($servicioId, $numeroFactura, $precio, $costo, $ganancia){

        $this->servicioId = $servicioId;
        $this->numeroFactura = $numeroFactura;
        $this->precio = $precio;
        $this->costo = $costo;
        $this->ganancia = $ganancia;
    }
}