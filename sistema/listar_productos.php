<?php include_once "includes/header.php"; ?>
		<!-- Contenido -->
		<div id="contenido">		
			<div class="container-fluid">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Productos</h1>
				<a href="registro_productos.php" class="btn btn-primary">Nuevo</a>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table">
							<thead class="thead-dark">
								<tr>
									<th>ID</th>
									<th>CODIGOBARRAS</th>
									<th>DESCRIPCIÓN</th>
									<th>PRECIO VENTA</th>
									<th>PRECIO COSTO</th>
									<th>STOCK</th>
									<th>CATEGORIA</th>
									<th>PROVEEDOR</th>
									<?php if ($_SESSION['rol'] == 1) { ?>
									<th>ACCIONES</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = mysqli_query($conectar, "SELECT productos.idproducto , productos.codigobarras , productos.descripcion , productos.precioventa , productos.preciocosto , productos.stock , categorias.nombre as categoria, proveedores.nombre as proveedor FROM productos left join categorias on productos.idcategoria = categorias.idcategoria left join proveedores on productos.idproveedor = proveedores.idproveedor");
								$result = mysqli_num_rows($query);
								if ($result > 0) {
									while ($data = mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td><?php echo $data['idproducto']; ?></td>
											<td><?php echo $data['codigobarras']; ?></td>
											<td><?php echo $data['descripcion']; ?></td>
											<td><?php echo $data['precioventa']; ?></td>
											<td><?php echo $data['preciocosto']; ?></td>
											<td><?php echo $data['stock']; ?></td>
											<td><?php echo $data['categoria']; ?></td>
											<td><?php echo $data['proveedor']; ?></td>
											<?php if ($data['idproducto'] != 1) { ?>
												<?php if ($_SESSION['rol'] == 1) { ?>
												<td>
													<a href="agregar_producto.php?id=<?php echo $data['idproducto']; ?>" class="btn btn-primary"><i class="fas fa-audio-description"></i></a>
													<a href="editar_productos.php?id=<?php echo $data['idproducto']; ?>" class="btn btn-success"><i class="fas fa-pen-square"></i></a>
													<form action="eliminar_productos.php?id=<?php echo $data['idproducto']; ?>" method="post" class="confirmar d-inline">
														<button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></i> </button>
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