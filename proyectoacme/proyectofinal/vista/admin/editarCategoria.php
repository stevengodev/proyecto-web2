<?php
    if (isset($_POST['identificador'])) {
        $identificador = $_GET['identificador'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>


    <h1 class="text-center mt-5">Editar categoria</h1>

    <form class="container" style="margin: 0 auto; width:500px" action="../crud/crudCategoria.php" method="POST">
        <div class="form-group">
            <label for="">Identificador</label>
            <input type="number" class="form-control" style="width: 500px;" name="identificador" value="<?php echo $identificador ?>">
        </div>

        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" style="width: 500px;" name="nombre" required>
        </div>

        <input type="submit" class="btn btn-primary" value="Registrar">
        <a href="listadoCategorias.php" class="btn btn-secondary">Cancelar</a>

        <input type="hidden" name="operacion" value="guardar">

    </form>



</body>

</html>