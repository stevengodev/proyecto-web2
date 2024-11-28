<?php

class Elementos {

    public $identificador;
    public $nombre;
    public $costo;
    public $tipo;

    function __construct($identificador, $nombre = '', $costo = '', $tipo =''){

        $this->identificador = $identificador;
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->tipo = $tipo;
    }
}