<?php
include_once "includes/header.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombreempleado']) || empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['email']) || empty($_POST['idrol'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $idusuario = $_GET['id'];
    $nombreempleado = $_POST['nombreempleado'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];
    $idrol = $_POST['idrol'];
    
    $query_update = mysqli_query($conectar, "UPDATE usuarios SET nombreempleado = '$nombreempleado' , usuario = '$usuario', contrasena = MD5('$contrasena') , email = '$email' , idrol = '$idrol' WHERE idusuario = $idusuario");
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
  header("Location: listar_usuarios.php");
} else {
  $idusuario = $_REQUEST['id'];
  if (!is_numeric($idusuario)) {
    header("Location: listar_usuarios.php");
  }
  $query_usuarios= mysqli_query($conectar, "SELECT usuarios.* , rol.rol FROM usuarios LEFT JOIN rol on usuarios.idrol = rol.idrol WHERE idusuario = $idusuario");
  $result_usuarios = mysqli_num_rows($query_usuarios);

  if ($result_usuarios > 0) {
    $data_usuarios = mysqli_fetch_assoc($query_usuarios);
  } else {
    header("Location: listar_usuarios.php");
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
                            <h1 class="h3 mb-0 text-gray-800">Panel Edición Usuarios</h1>
                            <a href="listar_usuarios.php" class="btn btn-primary">Regresar</a>
                        </div>

                        <div class="card-body">
                        <form action="" method="post">
                            <?php echo isset($alert) ? $alert : ''; ?>

                            <div class="form-group">
                            <label for="nombreempleado">Nombre Empleado</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre Empleado" name="nombreempleado" id="nombreempleado" value="<?php echo $data_usuarios['nombreempleado']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario" value="<?php echo $data_usuarios['usuario']; ?>">
                            </div>
                        
                            <div class="form-group">
                            <label for="contrasena">Contrasena</label>
                            <input type="text" class="form-control" placeholder="Ingrese Contrasena" name="contrasena" id="contrasena" value="">
                            </div>
                        
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Ingrese Email" name="email" id="email" value="<?php echo $data_usuarios['email']; ?>">
                            </div>

                            <div class="form-group">
                            <label for="idrol">ROL</label>
                            <?php $query_rol = mysqli_query($conectar, "SELECT * FROM rol ORDER BY idrol ASC");
                            $resultado_rol = mysqli_num_rows($query_rol);
                            mysqli_close($conectar);                            
                            ?>
                            <select id="idrol" name="idrol" class="form-control">
                                <option value="<?php echo $data_usuarios['idrol']; ?>" selected><?php echo $data_usuarios['rol']; ?></option>
                                <?php
                                if ($resultado_rol > 0) {
                                while ($idrol = mysqli_fetch_array($query_rol)) {
                                ?>
                                    <option value="<?php echo $idrol['idrol']; ?>"><?php echo $idrol['rol']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
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