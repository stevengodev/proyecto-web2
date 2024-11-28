<?php

class Diagnosticos {

    public $identificador;
    public $peso;
    public $presionArterial;
    public $diagnostico;
    public $numeroSesiones;
    public $citaId;

    function __construct($identificador, $peso = '', $presionArterial = '', $diagnostico ='',$numeroSesiones='', $citaId = ''){

        $this->identificador = $identificador;
        $this->peso = $peso;
        $this->presionArterial = $presionArterial;
        $this->diagnostico = $diagnostico;
        $this->numeroSesiones = $numeroSesiones;
        $this->citaId = $citaId;

    }
}