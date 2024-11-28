<?php

class Tratamientos {

    public $identificador;
    public $peso;
    public $presionArterial;
    public $sesionesRealizadas;
    public $sesionesRestantes;
    public $derivacion;
    public $resultados;
    public $diagnosticoId;
    public $citaId;
    public $servicioId;
    public $evolucion;
    public $pesoAnterior;
    public $presionArterialAnterior;

    function __construct($identificador, $peso, $presionArterial, 
    $sesionesRealizadas,$sesionesRestantes, $derivacion,
     $resultados, $diagnosticoId, $citaId, $servicioId, $evolucion, $pesoAnterior, $presionArterialAnterior){

        $this->identificador = $identificador;
        $this->peso = $peso;
        $this->presionArterial = $presionArterial;
        $this->sesionesRealizadas = $sesionesRealizadas;
        $this->sesionesRestantes = $sesionesRestantes;
        $this->derivacion = $derivacion;
        $this->resultados = $resultados;
        $this->diagnosticoId = $diagnosticoId;
        $this->citaId = $citaId;
        $this->servicioId = $servicioId;
        $this->evolucion = $evolucion;
        $this->pesoAnterior = $pesoAnterior;
        $this->presionArterialAnterior = $presionArterialAnterior;
    }
}