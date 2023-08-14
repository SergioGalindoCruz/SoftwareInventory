<?php
include_once "includes/header.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['tipodocumento']) || empty($_POST['nombre']) || empty($_POST['contacto']) || empty($_POST['direccion']) || empty($_POST['email']) || empty($_POST['nombre'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $idproveedor = $_GET['id'];
    $tipodocumento = $_POST['tipodocumento'];
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    
    $query_update = mysqli_query($conectar, "UPDATE proveedores SET tipodocumento = '$tipodocumento' , nombre = '$nombre', contacto = '$contacto' , direccion = '$direccion' , telefono = '$telefono' , email = '$email' WHERE idproveedor = $idproveedor");
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
  header("Location: listar_proveedores.php");
} else {
  $idproveedor = $_REQUEST['id'];
  if (!is_numeric($idproveedor)) {
    header("Location: listar_proveedores.php");
  }
  $query_proveedor= mysqli_query($conectar, "SELECT * FROM proveedores WHERE idproveedor = $idproveedor");
  $result_proveedor = mysqli_num_rows($query_proveedor);

  if ($result_proveedor > 0) {
    $data_proveedor = mysqli_fetch_assoc($query_proveedor);
  } else {
    header("Location: listar_proveedores.php");
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
                            <h1 class="h3 mb-0 text-gray-800">Panel Edición Proveedores</h1>
                            <a href="listar_proveedores.php" class="btn btn-primary">Regresar</a>
                        </div>

                        <div class="card-body">
                        <form action="" method="post">
                            <?php echo isset($alert) ? $alert : ''; ?>

                            <div class="form-group">
                            <label for="tipodocumento">Tipo Documento</label>
                            <input type="text" class="form-control" placeholder="Ingrese Tipo Documento" name="tipodocumento" id="tipodocumento" value="<?php echo $data_proveedor['tipodocumento']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="nombre">Proveedor</label>
                            <input type="text" class="form-control" placeholder="Ingrese Proveedor" name="nombre" id="nombre" value="<?php echo $data_proveedor['nombre']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="contacto">Contacto</label>
                            <input type="text" class="form-control" placeholder="Ingrese Contacto" name="contacto" id="contacto" value="<?php echo $data_proveedor['contacto']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" placeholder="Ingrese Direccion" name="direccion" id="direccion" value="<?php echo $data_proveedor['direccion']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="numeric" class="form-control" placeholder="Ingrese Telefono" name="telefono" id="telefono" value="<?php echo $data_proveedor['telefono']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Ingrese Email" name="email" id="email" value="<?php echo $data_proveedor['email']; ?>">
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