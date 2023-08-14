<?php include_once "includes/header.php"; ?>
<?php
	if (!empty($_POST)) {
		$alert = "";
		if (empty($_POST['nombreempleado']) || empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['email']) || empty($_POST['idrol'])) {
			$alert = '<div class="alert alert-danger" role="alert">
										Todo los campos son obligatorio
									</div>';
		} else {
			$idusuario = $_POST['idusuario'];
			$nombreempleado = $_POST['nombreempleado'];
			$usuario = $_POST['usuario'];
			$contrasena = $_POST['contrasena'];
			$email = $_POST['email'];
			$idrol = $_POST['idrol'];

			$result = 0;
			if (is_numeric($idusuario) and $idusuario != 0) {
				$query = mysqli_query($conectar, "SELECT * FROM usuarios where idusuario = '$idusuario'");
				$result = mysqli_fetch_array($query);
			}
			if ($result > 0) {
				$alert = '<div class="alert alert-danger" role="alert">
										El usuario ya existe
									</div>';
			} else {
				$query_insert = mysqli_query($conectar, "INSERT INTO usuarios(idusuario, nombreempleado, usuario, contrasena, email, idrol) values ('$idusuario', '$nombreempleado', '$usuario', MD5('$contrasena'), '$email', '$idrol')");
				if ($query_insert) {
					$alert = '<div class="alert alert-primary" role="alert">
										Usuario Registrado
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
				<h1 class="h3 mb-0 text-gray-800">Panel Creación Usuarios</h1>
				<a href="listar_usuarios.php" class="btn btn-primary">Regresar</a>
			</div>

			<!-- Content Row -->
			<div class="row">
				<div class="col-lg-6 m-auto">
					<form action="" method="post" autocomplete="off">
						<?php echo isset($alert) ? $alert : ''; ?>
						<div class="form-group">
							<label for="idusuario">Identificacion</label>
							<input type="number" placeholder="Ingrese Identificacion" name="idusuario" id="idusuario" class="form-control">
						</div>
						<div class="form-group">
							<label for="nombreempleado">Nombre</label>
							<input type="text" placeholder="Ingrese Nombre" name="nombreempleado" id="nombreempleado" class="form-control">
						</div>
						<div class="form-group">
							<label for="usuario">Usuario</label>
							<input type="text" placeholder="Ingrese Usuario" name="usuario" id="usuario" class="form-control">
						</div>
						<div class="form-group">
							<label for="contrasena">Contraseña</label>
							<input type="password" placeholder="Ingrese Contraseña" name="contrasena" id="contrasena" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" placeholder="Ingrese Email" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
						<label for="idrol">Rol</label>
						<select name="idrol" id="idrol">
							<option value="0">Ingrese Rol</option>
								<?php
								$query = $conectar -> query ("SELECT * FROM rol");
								while ($valores = mysqli_fetch_array($query)) {
								echo '<option value="'.$valores['idrol'].'">'.$valores['rol'].'</option>';
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