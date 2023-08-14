<?php
include_once "includes/header.php";
// Validar producto

if (empty($_REQUEST['id'])) {
    header("Location: listar_productos.php");
} else {
    $id_producto = $_REQUEST['id'];
    if (!is_numeric($id_producto)) {
        header("Location: listar_productos.php");
    }
    $query_producto = mysqli_query($conectar, "SELECT idproducto, descripcion, idproveedor, precioventa, stock FROM productos WHERE idproducto = $id_producto");
    $result_producto = mysqli_num_rows($query_producto);

    if ($result_producto > 0) {
        $data_producto = mysqli_fetch_assoc($query_producto);
    } else {
        header("Location: listar_productos.php");
    }
}
// Agregar Productos a entrada
if (!empty($_POST)) {
    $alert = "";
    if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['producto_id'])) {
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $producto_id = $_GET['id'];
        $usuario_id = $_SESSION['idUser'];
        $query_insert = mysqli_query($conectar, "INSERT INTO entradas(codproducto,cantidad,precio,usuario_id) VALUES ($producto_id, $cantidad, $precio, $usuario_id)");
        if ($query_insert) {
            // ejecutar procedimiento almacenado
            $query_upd = mysqli_query($conectar, "CALL actualizar_precio_producto($cantidad,$precio,$producto_id)");
            $result_pro = mysqli_num_rows($query_upd);
            if ($result_pro > 0) {
                $alert = '<div class="alert alert-primary" role="alert">
                        Producto actualizado con exito
                    </div>';
            }
        } else {
            echo "error";
        }
        mysqli_close($conectar);
    } else {
        echo "error";
    }
}
?>
		<!-- Contenido -->
		<div id="contenido">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <form action="" method="post">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <div class="form-group">
                                <label for="precio">Precio Actual</label>
                                <input type="number" class="form-control" value="<?php echo $data_producto['precioventa']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="precio">Cantidad de productos Disponibles</label>
                                <input type="number" class="form-control" value="<?php echo $data_producto['stock']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="precio">Nuevo Precio</label>
                                <input type="number" placeholder="Ingrese nombre del precio" name="precio" class="form-control" value="<?php echo $data_producto['precioventa']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Agregar Cantidad</label>
                                <input type="number" placeholder="Ingrese cantidad" name="cantidad" id="cantidad" class="form-control">
                            </div>

                            <input type="submit" value="Actualizar" class="btn btn-primary">
                            <a href="listar_productos.php" class="btn btn-danger">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php include_once "includes/footer.php"; ?>