<?php include_once "includes/header.php"; ?>
<?php
	if (!empty($_POST)) {
		$alert = "";
		if (empty($_POST['codigobarras']) || empty($_POST['descripcion']) || empty($_POST['precioventa']) || empty($_POST['precioventa']) || empty($_POST['stock']) || empty($_POST['idcategoria']) || empty($_POST['idproveedor'])) {
			$alert = '<div class="alert alert-danger" role="alert">
										Todo los campos son obligatorio
									</div>';
		} else {
			$codigobarras = $_POST['codigobarras'];
			$descripcion = $_POST['descripcion'];
			$precioventa = $_POST['precioventa'];
			$preciocosto = $_POST['preciocosto'];
			$stock = $_POST['stock'];
			$idcategoria = $_POST['idcategoria'];
			$idproveedor = $_POST['idproveedor'];

			$result = 0;
			if ($codigobarras != 0) {
				$query = mysqli_query($conectar, "SELECT * FROM productos where codigobarras = '$codigobarras'");
				$result = mysqli_fetch_array($query);
			}
			if ($result > 0) {
				$alert = '<div class="alert alert-danger" role="alert">
										El producto ya existe
									</div>';
			} else {
				$query_insert = mysqli_query($conectar, "INSERT INTO productos(codigobarras, descripcion, precioventa, preciocosto, stock, idcategoria, idproveedor) values ('$codigobarras', '$descripcion', '$precioventa', '$preciocosto', '$stock', '$idcategoria', '$idproveedor')");
				if ($query_insert) {
					$alert = '<div class="alert alert-primary" role="alert">
										Producto Registrado
									</div>';
				} else {
					$alert = '<div class="alert alert-danger" role="alert">
										Error al Guardar
								</div>';
				}
			}
		}
		mysqli_close($conectar);
	}
?>
		<!-- Contenido -->
		<div id="contenido">		
			<!-- Page Heading -->
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Panel Creación Productos</h1>
				<a href="listar_productos.php" class="btn btn-primary">Regresar</a>
			</div>

			<!-- Content Row -->
			<div class="row">
				<div class="col-lg-6 m-auto">
					<form action="" method="post" autocomplete="off">
						<?php echo isset($alert) ? $alert : ''; ?>
						<div class="form-group">
							<label for="codigobarras">Codigo Barras</label>
							<input type="text" placeholder="Ingrese Codigo Barras" name="codigobarras" id="codigobarras" class="form-control">
						</div>
						<div class="form-group">
							<label for="descripcion">Nombre</label>
							<input type="text" placeholder="Ingrese Descripcion" name="descripcion" id="descripcion" class="form-control">
						</div>
						<div class="form-group">
							<label for="precioventa">Precio Venta</label>
							<input type="number" placeholder="Ingrese Precio Venta" name="precioventa" id="precioventa" class="form-control">
						</div>
						<div class="form-group">
							<label for="preciocosto">Crecio Costo</label>
							<input type="number" placeholder="Ingrese Contraseña" name="preciocosto" id="preciocosto" class="form-control">
						</div>
						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" placeholder="Ingrese Stock" name="stock" id="stock" class="form-control">
						</div>
						<div class="form-group">
						<label for="idcategoria">Categoria</label>
						<select name="idcategoria" id="idcategoria">
							<option value="0">Ingrese Categoria</option>
								<?php
								$query = $conectar -> query ("SELECT * FROM categorias");
								while ($valores = mysqli_fetch_array($query)) {
								echo '<option value="'.$valores['idcategoria'].'">'.$valores['nombre'].'</option>';
								}
								?>
						</select>
						</div>
						<div class="form-group">
						<label for="idproveedor">Proveedor</label>
						<select name="idproveedor" id="idproveedor">
							<option value="0">Ingrese Proveedor</option>
								<?php
								$query = $conectar -> query ("SELECT * FROM proveedores");
								while ($valores = mysqli_fetch_array($query)) {
								echo '<option value="'.$valores['idproveedor'].'">'.$valores['nombre'].'</option>';
								}
								?>
						</select>
						</div>

						<input type="submit" value="Guardar" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
<?php include_once "includes/footer.php"; ?>