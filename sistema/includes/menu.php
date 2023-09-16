<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
		<div class="sidebar-brand-icon rotate-n-0">
			<img src="img/logocaja.png" class="img-thumbnail">
		</div>
		<div class="sidebar-brand-text mx-3">Software Inventory</div>
	</a>

	<hr class="sidebar-divider my-0">

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Menu
	</div>

	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
				<i class="fa fa-cart-arrow-down"></i>
				<span>Ventas</span>
			</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_venta.php">Nueva Venta</a>
					<a class="collapse-item" href="listar_ventas.php">Ventas</a>
				</div>
			</div>
		</li>
	<?php } ?>


	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-users"></i>
				<span>Clientes</span>
			</a>
			<div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_cliente.php">Nuevo Clientes</a>
					<a class="collapse-item" href="listar_cliente.php">Clientes</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fa fa-inbox"></i>
				<span>Categorias</span>
			</a>
			<div id="collapseCategorias" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_categorias.php">Nueva Categoria</a>
					<a class="collapse-item" href="listar_categorias.php">Categorias</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fa fa-university"></i>
				<span>Proveedor</span>
			</a>
			<div id="collapseProveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_proveedores.php">Nuevo Proveedor</a>
					<a class="collapse-item" href="listar_proveedores.php">Proveedores</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fa fa-coffee"></i>
				<span>Productos</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_productos.php">Nuevo Producto</a>
					<a class="collapse-item" href="listar_productos.php">Productos</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 1) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fa fa-address-card"></i>
				<span>Usuarios</span>
			</a>
			<div id="collapseUsuarios" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_usuarios.php">Nuevo Usuario</a>
					<a class="collapse-item" href="listar_usuarios.php">Usuarios</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 1) { ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fa fa-database"></i>
				<span>Reportes</span>
			</a>
			<div id="collapseReportes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="reportes_ventas.php">Reportes Ventas</a>
					<a class="collapse-item" href="reportes_clientes.php">Reportes Clientes</a>
					<a class="collapse-item" href="reportes_categorias.php">Reportes Categoria</a>
					<a class="collapse-item" href="reportes_proveedores.php">Reportes Proveedores</a>
					<a class="collapse-item" href="reportes_productos.php">Reportes Productos</a>
					<a class="collapse-item" href="reporte_usuarios.php">Reportes Usuarios</a>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>