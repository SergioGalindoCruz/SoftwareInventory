<?php include_once "includes/header.php"; ?>
<?php
	if (!empty($_POST)) {
		$alert = "";
		if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['email'])) {
			$alert = '<div class="alert alert-danger" role="alert">
										Todo los campos son obligatorio
									</div>';
		} else {
			$idcliente = $_POST['idcliente'];
			$nombre = $_POST['nombre'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];

			$result = 0;
			if (is_numeric($idcliente) and $idcliente != 0) {
				$query = mysqli_query($conectar, "SELECT * FROM clientes where idcliente = '$idcliente'");
				$result = mysqli_fetch_array($query);
			}
			if ($result > 0) {
				$alert = '<div class="alert alert-danger" role="alert">
										El cliente ya existe
									</div>';
			} else {
				$query_insert = mysqli_query($conectar, "INSERT INTO clientes(idcliente,nombre,direccion,telefono, email) values ('$idcliente', '$nombre', '$direccion', '$telefono', '$email')");
				if ($query_insert) {
					$alert = '<div class="alert alert-primary" role="alert">
										Cliente Registrado
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
				<h1 class="h3 mb-0 text-gray-800">Panel Creación Clientes</h1>
				<a href="listar_cliente.php" class="btn btn-primary">Regresar</a>
			</div>

			<!-- Content Row -->
			<div class="row">
				<div class="col-lg-6 m-auto">
					<form action="" method="post" autocomplete="off">
						<?php echo isset($alert) ? $alert : ''; ?>
						<div class="form-group">
							<label for="idcliente">Identificacion</label>
							<input type="number" placeholder="Ingrese Identificacion" name="idcliente" id="idcliente" class="form-control">
						</div>
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
						</div>
						<div class="form-group">
							<label for="direccion">Dirección</label>
							<input type="text" placeholder="Ingrese Direccion" name="direccion" id="direccion" class="form-control">
						</div>
						<div class="form-group">
							<label for="telefono">Teléfono</label>
							<input type="number" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" placeholder="Ingrese Email" name="email" id="email" class="form-control">
						</div>

						<input type="submit" value="Guardar" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
<?php include_once "includes/footer.php"; ?>