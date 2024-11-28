<?php 

    interface InterfazControlador {

        public function guardar($objeto, $bd);
        public function eliminar($objeto, $bd);
        public function consultarRegistro($objeto, $bd);
        public function listar($bd);
    }

?>