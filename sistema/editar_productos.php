<?php
include_once "includes/header.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['codigobarras']) || empty($_POST['descripcion']) || empty($_POST['precioventa']) || empty($_POST['preciocosto']) || empty($_POST['idcategoria']) || empty($_POST['idproveedor'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $idproducto = $_GET['id'];
    $codigobarras = $_POST['codigobarras'];
    $descripcion = $_POST['descripcion'];
    $precioventa = $_POST['precioventa'];
    $preciocosto = $_POST['preciocosto'];
    $idcategoria = $_POST['idcategoria'];
    $idproveedor = $_POST['idproveedor'];
    $query_update = mysqli_query($conectar, "UPDATE productos SET codigobarras = '$codigobarras', descripcion = '$descripcion', precioventa = '$precioventa', preciocosto = '$preciocosto', idcategoria = '$idcategoria', idproveedor = '$idproveedor' WHERE idproducto = $idproducto");
    if ($query_update) {
      $alert = '<div class="alert alert-primary" role="alert">
              Modificado
            </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                Error al Modificar
              </div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: listar_productos.php");
} else {
  $idproducto = $_REQUEST['id'];
  if (!is_numeric($idproducto)) {
    header("Location: listar_productos.php");
  }
  $query_producto = mysqli_query($conectar, "SELECT productos.*, categorias.nombre as categoria , proveedores.nombre proveedor FROM productos left join categorias on productos.idcategoria = categorias.idcategoria left join proveedores on productos.idproveedor = proveedores.idproveedor WHERE idproducto = $idproducto");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: listar_productos.php");
  }
}
?>
		<!-- Contenido -->
		<div id="contenido">		
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Panel Edición Productos</h1>
                            <a href="listar_productos.php" class="btn btn-primary">Regresar</a>
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <div class="form-group">
                            <label for="codigobarras">Codigo Barras</label>
                            <input type="text" class="form-control" placeholder="Ingrese Codigo Barras" name="codigobarras" id="codigobarras" value="<?php echo $data_producto['codigobarras']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" placeholder="Ingrese Descripcion" name="descripcion" id="descripcion" value="<?php echo $data_producto['descripcion']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="precioventa">Precio Venta</label>
                            <input type="number" class="form-control" placeholder="Ingrese Precio Venta" name="precioventa" id="precioventa" value="<?php echo $data_producto['precioventa']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="preciocosto">Precio Costo</label>
                            <input type="number" class="form-control" placeholder="Ingrese Precio Costo" name="preciocosto" id="preciocosto" value="<?php echo $data_producto['preciocosto']; ?>">
                            </div>

                            <div class="form-group">
                            <label for="nombre">Categoria</label>
                            <?php $query_categoria = mysqli_query($conectar, "SELECT * FROM categorias ORDER BY idcategoria ASC");
                            $resultado_categoria = mysqli_num_rows($query_categoria);
                            
                            ?>
                            <select id="idcategoria" name="idcategoria" class="form-control">
                                <option value="<?php echo $data_producto['idcategoria']; ?>" selected><?php echo $data_producto['categoria']; ?></option>
                                <?php
                                if ($resultado_categoria > 0) {
                                while ($idcategoria = mysqli_fetch_array($query_categoria)) {
                                ?>
                                    <option value="<?php echo $idcategoria['idcategoria']; ?>"><?php echo $idcategoria['nombre']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="nombre">Proveedores</label>
                            <?php $query_proveedores = mysqli_query($conectar, "SELECT * FROM proveedores ORDER BY idproveedor ASC");
                            $resultado_proveedores = mysqli_num_rows($query_proveedores);
                            mysqli_close($conectar);
                            ?>
                            <select id="idproveedor" name="idproveedor" class="form-control">
                                <option value="<?php echo $data_producto['idproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>
                                <?php
                                if ($resultado_proveedores > 0) {
                                while ($idproveedor = mysqli_fetch_array($query_proveedores)) {
                                ?>
                                    <option value="<?php echo $idproveedor['idproveedor']; ?>"><?php echo $idproveedor['nombre']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                            </div>

                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
		</div>
<?php include_once "includes/footer.php"; ?>