<?php

session_start();

$tipoIdentificacionGerente = $_SESSION['tipoidentificacionempleado'];
$identificacionGerente = $_SESSION['identificacionempleado'];

if (($tipoIdentificacionGerente == null || $tipoIdentificacionGerente == '') && ($identificacionGerente == null || $identificacionGerente == '')) {
    header("Location: ../../login.php");
  }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Importes por ventas</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="/proyectofinal/assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    </head>
    <body class="sb-nav-fixed">

        <!-- Header -->
        <?php require "../../templates/header.php";?>

        <!-- Fin Header -->

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Navegacion</div>

                            <a class="nav-link" href="../menugerente.php">
                                Menu
                            </a>

                            <!-- <div class="sb-sidenav-menu-heading">Servicios</div> -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Privilegios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../serviciosofertados.php">Servicios ofertados</a>
                                    <a class="nav-link " href="../reportesfinancieros.php">Reportes financieros</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Semanal</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Quincenal</button>
                      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Mensual</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <main class="centrar-main">
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Importe de ventas por semana</h1><br>
                        </div>
                    </main>
                    <canvas id="graficaSemanal" width="300px" height="100px"></canvas>
                    <div class="container-fluid px-4">
                        <table class="table table-striped">
                            <thead style="background-color: black; color: white;">
                                <tr>
                                  <th scope="col">Semanas</th>
                                  <th scope="col">Fechas(Inicia -Termina)</th>
                                  <th scope="col">Numero de ventas</th>
                                  <th scope="col">Costo total</th>
                                  <th scope="col">Venta total</th>
                                  <th scope="col">Ganancias</th>                                </tr>
                              </thead>  
                            <tbody>
                              <tr>
                                <td>Semana 1</td>
                                <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                <td>20</td>
                                <td>10000000</td>
                                <td>20000000</td>
                                <td>10000000</td>
                              </tr>
                              <tr>
                                <td>Semana 2</td>
                                <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                <td>20</td>
                                <td>10000000</td>
                                <td>20000000</td>
                                <td>10000000</td>                              
                            </tr>
                              <tr>
                                <td>Semana 3</td>
                                <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                <td>20</td>
                                <td>15000000</td>
                                <td>25000000</td>
                                <td>10000000</td>                              
                            </tr>
                              <tr>
                                <td>Semana 4</td>
                                <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                <td>20</td>
                                <td>20000000</td>
                                <td>350000000</td>
                                <td>15000000</td>                              
                            </tr>

                            </tbody>
                          </table>
                        </div>    
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <main class="centrar-main">
                            <div class="container-fluid px-4">
                                <h1 class="mt-4">Importe por de venta por quincena</h1><br>
                            </div>
                        </main>
                        <canvas id="graficaQuincenal" width="300px" height="100px"></canvas>
                        <div class="container-fluid px-4">
                            <table class="table table-striped">
                                <thead style="background-color: black; color: white;">
                                    <tr>
                                      <th scope="col">Quincenas</th>
                                      <th scope="col">Fechas(Inicia -Termina)</th>
                                      <th scope="col">Numero de ventas</th>
                                      <th scope="col">Costo total</th>
                                      <th scope="col">Venta total</th>
                                      <th scope="col">Ganancias</th>                                    </tr>
                                  </thead>  
                                <tbody>
                                  <tr>
                                    <td>Quincena 1</td>
                                    <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                    <td>$500</td>
                                  </tr>
                                  <tr>
                                    <td>Quincena 2</td>
                                    <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                    <td>$150</td>
                                  </tr>
                                  <tr>
                                    <td>Quincena 3</td>
                                    <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                    <td>$800</td>
                                  </tr>
                                  <tr>
                                    <td>Quincena 4</td>
                                    <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                    <td>$200</td>
                                  </tr>
                                  <tr>
                                    <td>Quincena 5</td>
                                    <td>DD/MM/YYYY - DD/MM/YYYY</td>
                                    <td>$450</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>    
                    </div>

                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <main class="centrar-main">
                            <div class="container-fluid px-4">
                                <h1 class="mt-4">Importe de venta por mes</h1><br>
                            </div>
                        </main>
                        <canvas id="graficaMensual" width="300px" height="100px"></canvas>
                        <div class="container-fluid px-4">
                            <table class="table table-striped">
                                <thead style="background-color: black; color: white;">
                                    <tr>
                                      <th scope="col">Mes</th>
                                      <th scope="col">Fechas(MES/AÑO)</th>
                                      <th scope="col">Numero de ventas</th>
                                      <th scope="col">Costo total</th>
                                      <th scope="col">Venta total</th>
                                      <th scope="col">Ganancias</th>
                                    </tr>
                                  </thead>  
                                <tbody>
                                  <tr>
                                    <td>Enero</td>
                                    <td>MM/YYYY - MM/YYYY</td>
                                    <td>15</td>
                                    <td>15000000</td>
                                    <td>25000000</td>
                                    <td>10000000</td>
                                  </tr>
                                  <tr>
                                    <td>Febrero</td>
                                    <td>MM/YYYY - MM/YYYY</td>
                                    <td>20</td>
                                    <td>20000000</td>
                                    <td>1000000</td>
                                    <td>11000000</td>
                                  </tr>

                                  <tr>
                                    <td>Marzo</td>
                                    <td>MM/YYYY - MM/YYYY</td>
                                    <td>8</td>
                                    <td>9000000</td>
                                    <td>15000000</td>
                                    <td>6000000</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>    
                    </div>
                  </div>

                  <?php require "../../templates/footer.php";?>

            </div>
        </div>
        <script src="../../../javascript/utilidades.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    </body>

    <script>
        // Obtener una referencia al elemento canvas del DOM
        const $graficaSemanal = document.querySelector("#graficaSemanal");
        // Las etiquetas son las que van en el eje X. 
        const etiquetasSemanales = ["Semana 1", "Semana 2", "Semana 3", "Semana 4","Semana 5"]
        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosImportesSemanales = {
            label: "Importe por semana",
            data: [500, 150, 800, 200,450], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1,// Ancho del borde
        };
        new Chart($graficaSemanal, {
            type: 'bar',// Tipo de gráfica
            data: {
                labels: etiquetasSemanales,
                datasets: [
                    datosImportesSemanales,
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>

    <script>
            // Obtener una referencia al elemento canvas del DOM
            const $graficaQuincenal = document.querySelector("#graficaQuincenal");
            // Las etiquetas son las que van en el eje X. 
            const etiquetasQuincenales = ["Quincena 1", "Quincena 2", "Quincena 3", "Quincena 4","Quincena 5"]
            // Podemos tener varios conjuntos de datos. Comencemos con uno
            const datosImportesQuincenales = {
                label: "Importe por quincena",
                data: [500, 150, 800, 200,450], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                borderWidth: 1,// Ancho del borde
            };
            new Chart($graficaQuincenal, {
                type: 'bar',// Tipo de gráfica
                data: {
                    labels: etiquetasQuincenales,
                    datasets: [
                        datosImportesQuincenales,
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                    },
                }
            });
        </script>
    <script>
        // Obtener una referencia al elemento canvas del DOM
        const $graficaMensual = document.querySelector("#graficaMensual");
        // Las etiquetas son las que van en el eje X. 
        const etiquetasMensuales = ["Enero", "Febrero", "Marzo"]
        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosImportesMensuales = {
            label: "Importe por mes ",
            data: [10000000, 11000000, 6000000], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1,// Ancho del borde
        };
        new Chart($graficaMensual, {
            type: 'bar',// Tipo de gráfica
            data: {
                labels: etiquetasMensuales,
                datasets: [
                    datosImportesMensuales,
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
</html>