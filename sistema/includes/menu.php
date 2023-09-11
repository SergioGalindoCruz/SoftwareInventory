<!-- Menu -->
<div id="menu">
	<ul>
		<a class="logo-menu" href="index.php"> <img src="img/logocompleto.png" class="logo-img" width="300px" height=""></a>
		<table class="table table-dark table-striped">
			<thead>
				<tr class="table-active">
					MENU
				</tr>
			</thead>
			<tbody>
				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="registro_venta.php">
							<i class="bi bi-basket"></i>
							<span>Venta</span>
						</a>
					</li>
				<?php } ?>

				<?php if ($_SESSION['rol'] == 1) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="listar_usuarios.php">
							<i class="bi bi-person-fill"></i>
							<span>Usuarios</span>
						</a>
					</li>
				<?php } ?>

				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="listar_cliente.php">
							<i class="bi bi-people-fill"></i>
							<span>Clientes</span>
						</a>
					</li>
				<?php } ?>

				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="listar_categorias.php">
							<i class="bi bi-tags-fill"></i>
							<span>Categorias</span>
						</a>
					</li>
				<?php } ?>

				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="listar_proveedores.php">
							<i class="bi bi-building-fill"></i>
							<span>Proveedores</span>
						</a>
					</li>
				<?php } ?>

				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="listar_productos.php">
							<i class="bi bi-box-seam-fill"></i>
							<span>Productos</span>
						</a>
					</li>
				<?php } ?>
			</tbody>
		</table>
	</ul>
</div>