<html>
<head>
    <title>Formulario Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="">
</head>
<body>
    <form class="form-register" action="StockPCreate.php" method="post">
        <h4>Formulario stock</h4>
        <input class="controls" type="date" name="fecha" id="fecha" required>
        <select class="controls" name="tipomovimiento" id="tipomovimiento"required>
            <option value="seleccionar">Selecciona el tipo de movimiento</option>
            <option value="E">ENTRADA</option>
            <option value="S">SALIDA</option>
            <input class="controls" type="number" name="IdProducto" id="IdProducto" placeholder="Codigo del producto" required>
            <input class="controls" type="number" name="cantidad" id="cantidad" placeholder="Cantidad" required>
            <!--el id del empleado que hace el movimiento lo debe tomar del logueo previo-->
        </select><br>
        <br>
        <input class="botons" type="submit" value="CARGAR MOVIMIENTO">
    </form>
    <input type="button" onclick="history.back()" name="volver atrás" value="volver atrás">
</body>
</html>