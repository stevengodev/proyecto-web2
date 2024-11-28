<?php

class Servicios {

    public $identificador;
    public $nombre;
    public $descripcion;
    public $porcentaje;
    public $estado;
    public $categoriaId;
    public $peso;
    public $presionArterial;
    public $evolucion;

    function __construct($identificador, $nombre = '', $descripcion = '', $porcentaje = '', $estado = '', $categoriaId = '', $peso = '', $presionArterial = '', $evolucion =''){

        $this->identificador = $identificador;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->porcentaje = $porcentaje;
        $this->estado = $estado;
        $this->categoriaId = $categoriaId;
        $this->peso = $peso;
        $this->presionArterial = $presionArterial;
        $this->evolucion = $evolucion;

    }
}