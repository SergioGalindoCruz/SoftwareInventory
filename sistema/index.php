<?php include_once "includes/header.php"; ?>
		<!-- Index -->
		<div id="contenido">		
			<div class="">
				<div class="">
					<h1 class="">Configuración</h1>
				</div>
				<div class="row">
					<div>
						<div class="">
							<div class="">
								Información Personal
							</div>
							<div class="">
								<div class="">
									<label>Nombre: <strong><?php echo $_SESSION['nombreempleado']; ?></strong></label>
								</div>
								<div class="">
									<label>Correo: <strong><?php echo $_SESSION['email']; ?></strong></label>
								</div>
								<div class="">
									<label>Rol: <strong><?php echo $_SESSION['rol_name']; ?></strong></label>
								</div>
								<div class="">
									<label>Usuario: <strong><?php echo $_SESSION['user']; ?></strong></label>
								</div>
								<ul class="list-group">
									<li class="list-group-item active">Cambiar Contraseña</li>
									<form action="" method=" post" name="frmChangePass" id="frmChangePass" class="p-3">
										<div class="form-group">
											<label>Contraseña Actual</label>
											<input type="password" name="actual" id="actual" placeholder="Clave Actual" required class="form-control">
										</div>
										<div class="form-group">
											<label>Nueva Contraseña</label>
											<input type="password" name="nueva" id="nueva" placeholder="Nueva Clave" required class="form-control">
										</div>
										<div class="form-group">
											<label>Confirmar Contraseña</label>
											<input type="password" name="confirmar" id="confirmar" placeholder="Confirmar clave" required class="form-control">
										</div>
										<div class="alertChangePass" style="display:none;">
										</div>
										<div>
											<button type="submit" class="btn btn-primary btnChangePass">Cambiar Contraseña</button>
										</div>
									</form>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include_once "includes/footer.php"; ?>