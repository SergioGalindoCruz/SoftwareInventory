<?php include_once "includes/header.php"; ?>
		<!-- Contenido -->
		<div id="contenido">		
			<div class="container-fluid">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Categorias</h1>
				<a href="registro_categorias.php" class="btn btn-primary">Nuevo</a>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table">
							<thead class="thead-dark">
								<tr>
									<th>ID</th>
									<th>CATEGORIAS</th>
									<?php if ($_SESSION['rol'] == 1) { ?>
									<th>ACCIONES</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = mysqli_query($conectar, "SELECT * FROM categorias");
								$result = mysqli_num_rows($query);
								if ($result > 0) {
									while ($data = mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td><?php echo $data['idcategoria']; ?></td>
											<td><?php echo $data['nombre']; ?></td>
											<?php if ($data['idcategoria'] != 1) { ?>
												<?php if ($_SESSION['rol'] == 1) { ?>
												<td>
													<a href="editar_categorias.php?id=<?php echo $data['idcategoria']; ?>" class="btn btn-success"><i class='fas fa-pen-square'></i></a>
													<form action="eliminar_categorias.php?id=<?php echo $data['idcategoria']; ?>" method="post" class="confirmar d-inline">
														<button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> </button>
													</form>
												</td>
												<?php } ?>
											<?php } ?>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</div>
			</div>
		</div>
<?php include_once "includes/footer.php"; ?>