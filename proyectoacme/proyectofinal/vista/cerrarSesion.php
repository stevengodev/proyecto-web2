<?php

session_start();

$salir = $_GET['salir'];

if (isset($salir) == 'salir') {
    session_destroy();
    header("Location: login.php");
}


// 

?>