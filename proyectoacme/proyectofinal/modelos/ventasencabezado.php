<?php

class VentasEncabezado {

    public $numeroFactura;
    public $tipoIdentificacionCliente;
    public $identificacionCliente;
    public $fecha;
    public $total;

    function __construct($numeroFactura, $tipoIdentificacionCliente, $identificacionCliente, $fecha, $total = ''){

        $this->numeroFactura = $numeroFactura;
        $this->tipoIdentificacionCliente = $tipoIdentificacionCliente;
        $this->identificacionCliente = $identificacionCliente;
        $this->fecha = $fecha;
        $this->total = $total;

    }
}