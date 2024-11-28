<?php

class Categorias {

    public $identificador;
    public $nombre;

    function __construct($identificador, $nombre = ''){

        $this->identificador = $identificador;
        $this->nombre = $nombre;

    }
}