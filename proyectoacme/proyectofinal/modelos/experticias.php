<?php

class Experticias {

    public $identificador;
    public $nombre;
    public $tipoIdentificacionProfesional;
    public $identificacionProfesional;

    function __construct($identificador, $nombre = '', $tipoIdentificacionProfesional = '', $identificacionProfesional =''){

        $this->identificador = $identificador;
        $this->nombre = $nombre;
        $this->tipoIdentificacionProfesional = $tipoIdentificacionProfesional;
        $this->identificacionProfesional = $identificacionProfesional;
    }
}