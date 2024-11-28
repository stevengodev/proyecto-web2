<?php

class Usuarios
{

    public $usuario;
    public $contrasena;
    public $tipoIdentificacionCliente;
    public $identificacionCliente;
    public $tipoIdentificacionProfesional;
    public $identificacionProfesional;
    public $tipoIdentificacionEmpleado;
    public $identificacionEmpleado;
    public $tipo;

    function __construct($usuario, $contrasena, $tipoIdentificacionCliente, $identificacionCliente,
    $tipoIdentificacionProfesional,$identificacionProfesional,$tipoIdentificacionEmpleado,
    $identificacionEmpleado, $tipo)
    {

        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->tipoIdentificacionCliente = $tipoIdentificacionCliente;
        $this->identificacionCliente = $identificacionCliente;
        $this->tipoIdentificacionProfesional = $tipoIdentificacionProfesional;
        $this->identificacionProfesional = $identificacionProfesional;
        $this->tipoIdentificacionEmpleado = $tipoIdentificacionEmpleado;
        $this->identificacionEmpleado = $identificacionEmpleado;
        $this->tipo = $tipo;
    }
}
