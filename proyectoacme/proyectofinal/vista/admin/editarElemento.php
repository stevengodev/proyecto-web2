<?php
    if (isset($_GET['identificador'])) {
        $identificador = $_GET['identificador'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar elemento</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>


    <h1 class="text-center mt-5">Editar elemento</h1>

    <form class="container" style="margin: 0 auto; width:500px" method="POST" action="../crud/crudElemento.php">
        <div class="form-group">
            <label for="">Identificador</label>
            <input type="number" class="form-control" style="width: 500px;" name="identificador" required value="<?php echo $identificador ?>">
        </div>

        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" style="width: 500px;" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="">Costo</label>
            <input required type="number" class="form-control" name="costo" style="width: 500px;">
        </div>

        <div style="width: 500px;">  
            <label for="">Tipo de elemento</label>

            <select style="width: 500px;" name="tipo" required>
                <option value="">Selecciona el tipo de elemento</option>
                <option value="maquina">maquina</option>
                <option value="reactivo">reactivo</option>
                <option value="materia prima">materia prima</option>
            </select>

        </div>

        <input type="hidden" class="btn btn-primary" name="operacion" value="guardar">

        <a href="listadoReactivos.php" class="btn btn-secondary">Cancelar</a>
        <input type="submit" class="btn btn-primary" value="Registrar">
        


    </form>




</body>

</html>