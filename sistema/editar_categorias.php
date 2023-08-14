<?php
include_once "includes/header.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $idcategoria = $_GET['id'];
    $nombre = $_POST['nombre'];
    $query_update = mysqli_query($conectar, "UPDATE categorias SET nombre = '$nombre' WHERE idcategoria = $idcategoria");
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
  header("Location: listar_categorias.php");
} else {
  $idcategoria = $_REQUEST['id'];
  if (!is_numeric($idcategoria)) {
    header("Location: listar_categorias.php");
  }
  $query_producto = mysqli_query($conectar, "SELECT * FROM categorias WHERE idcategoria = $idcategoria");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: listar_categorias.php");
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
                            <h1 class="h3 mb-0 text-gray-800">Panel Edición Categorias</h1>
                            <a href="listar_categorias.php" class="btn btn-primary">Regresar</a>
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <div class="form-group">
                            <label for="nombre">Categoria</label>
                            <input type="text" class="form-control" placeholder="Ingrese Categoria" name="nombre" id="nombre" value="<?php echo $data_producto['nombre']; ?>">
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