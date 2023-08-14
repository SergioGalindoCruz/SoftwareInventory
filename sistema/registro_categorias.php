<?php include_once "includes/header.php"; ?>
<?php
	if (!empty($_POST)) {
		$alert = "";
		if (empty($_POST['nombre'])) {
			$alert = '<div class="alert alert-danger" role="alert">
										Todo los campos son obligatorio
									</div>';
		} else {
			$nombre = $_POST['nombre'];
			$idcategoria = 1;

			$result = 0;
			if (is_numeric($idcategoria) and $idcategoria != 0) {
				$query = mysqli_query($conectar, "SELECT * FROM categorias where nombre = '$nombre'");
				$result = mysqli_fetch_array($query);
			}
			if ($result > 0) {
				$alert = '<div class="alert alert-danger" role="alert">
										La categoria ya existe
									</div>';
			} else {
				$query_insert = mysqli_query($conectar, "INSERT INTO categorias(nombre) values ('$nombre')");
				if ($query_insert) {
					$alert = '<div class="alert alert-primary" role="alert">
										Categoria Registrada
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
				<h1 class="h3 mb-0 text-gray-800">Panel Creación Categorias</h1>
				<a href="listar_categorias.php" class="btn btn-primary">Regresar</a>
			</div>

			<!-- Content Row -->
			<div class="row">
				<div class="col-lg-6 m-auto">
					<form action="" method="post" autocomplete="off">
						<?php echo isset($alert) ? $alert : ''; ?>
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
						</div>
						<input type="submit" value="Guardar" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
<?php include_once "includes/footer.php"; ?>