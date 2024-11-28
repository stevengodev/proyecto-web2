<?php

require 'funciones/funciones.php';
require 'componentes/conexionbd.php';
require 'controladores/controladorservicios.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();

$controladorServicio = new ControladorServicios();
$resultado = $controladorServicio->listar($bd);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body>

    <header class="fondo-header">

        <nav class="">
            <div class="container d-flex justify-content-between p-4" style="font-weight: bold; font-size: 30px;">
                <a class="navbar-brand" href="principal.php">ACME</a>

                <nav class="navegacion-principal">
                    <a href="#mision">Mision</a>
                    <a href="#vision">Vision</a>
                    <a href="#servicios">Servicios</a>
                </nav>

                <div>
                    <a href="vista/login.php" class="btn btn-outline-primary me-2">Iniciar sesion</a>
                </div>

            </div>
        </nav>

    </header>

    <section id="mision" class="container sobre-mision">
        <div class="imagen-mision">
            <img loading="lazy" src="assets/imagenes/mision.jpg" alt="">
        </div>

        <div class="contenido-mision">
            <h2>Mision</h2>

            <p>
                La misión busca sintetizar en un enunciado la razón de ser de la empresa, así como mencionar lo que la organización hace para cumplir y acercarse cada vez más a su propósito. Es el faro que indicará en todo momento la dirección a la que deben apuntar las acciones y las decisiones. Puede ser objeto de las revisiones y cambios que sean necesarios, para adecuarla a las circunstancias cambiantes del entorno.
            </p>

        </div>
    </section>

    <section class="container sobre-vision" id="vision">
        <div class="imagen-vision">
            <img loading="lazy" src="assets/imagenes/vision.png" alt="">
        </div>

        <div class="contenido-vision">
            <h2>Vision</h2>

            <p>
                La vision busca sintetizar en un enunciado la razón de ser de la empresa, así como mencionar lo que la organización hace para cumplir y acercarse cada vez más a su propósito. Es el faro que indicará en todo momento la dirección a la que deben apuntar las acciones y las decisiones. Puede ser objeto de las revisiones y cambios que sean necesarios, para adecuarla a las circunstancias cambiantes del entorno.
            </p>

        </div>
    </section>

    <section style="background-color: #4CB8B3;" id="servicios">

        <h2 class="text-center mb-4">Servicios</h2>

        <div class="col conjunto-de-servicios container">

            <?php
            
            while ($fila = $resultado->fetch_assoc()) { 
                
                if ($fila['estado']=='activo') { ?>
                    <div class="principal-servicio">
                        <h3 class="text-center mb-0 titulo-servicio"><?php echo $fila['nombre']; ?></h3>
                        <p class="bg-blanco mb-0">Descripcion</p>
                        <p class="bg-blanco mb-0"><?php echo $fila['descripcion']; ?></p>
                        <p class="bg-precioServicio">Precio $<?php echo $fila['precio']; ?></p>
                    </div>  
            
                <?php } ?>
            
             <?php  } ?>

        </div>

    </section>

    <footer class="py-4 bg-footer mt-auto">
        <div class="container-fluid px-4">
            <div>
                <div class="text-muted text-center"> Todos los derechos reservados &copy; 2022 </div>
            </div>
        </div>
    </footer>

</body>

</html>