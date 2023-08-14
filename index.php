<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['contrasena'])) {
      $alert =  '<div class="alert alert-danger" role="alert">
                Ingrese su usuario y su clave
                </div>';
                echo'<script type="text/javascript">
                alert("Ingrese su usuario y su clave.");
                window.location.href="index.php";
                </script>';
    } else {
      require_once "conexion.php";
      $user = mysqli_real_escape_string($conectar, $_POST['usuario']);
      $clave = md5(mysqli_real_escape_string($conectar, $_POST['contrasena']));
      $query = mysqli_query($conectar, "SELECT u.idusuario, u.nombreempleado, u.email,u.usuario,r.idrol,r.rol FROM usuarios u INNER JOIN rol r ON u.idrol = r.idrol WHERE u.usuario = '$user' AND u.contrasena = '$clave'");
      mysqli_close($conectar);
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) {
        $dato = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $dato['idusuario'];
        $_SESSION['nombreempleado'] = $dato['nombreempleado'];
        $_SESSION['email'] = $dato['email'];
        $_SESSION['user'] = $dato['usuario'];
        $_SESSION['rol'] = $dato['idrol'];
        $_SESSION['rol_name'] = $dato['rol'];
        header('location: sistema/');
      } else {
        $alert =    '<div class="alert alert-danger" role="alert">
                    Usuario o Contraseña Incorrecta
                    </div>';
                    echo'<script type="text/javascript">
                    alert("Usuario o Contraseña Incorrecta");
                    window.location.href="index.php";
                    </script>';

        session_destroy();
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="sistema/style/style.css">
    <link rel="icon" href="sistema/img/logocaja.png">
    <title>SoftwareInventory</title>
</head>
<body>
    <div class="row">
        <div class="col">
            <div id="logo-box" >
                <img src="sistema/img/logocompleto.png" alt="" width="500px">
                <p>Somos una empresa dedicada a la organizacion y manejo de inventarios.</p>
            </div>
        </div>
        <div class="col">
            <form action="" method="POST">
                <div id="login-box-container">
                <div id="login-box">
                    <br><br>
                    <div class="form">
                        <div class="item">
                            <input type="text" placeholder="Ingrese Usuario" name="usuario" required>
                        </div>
                        <br>
                        <div class="item">
                            <input type="password" placeholder="Ingrese Contraseña" name="contrasena" required>
                        </div>
                    </div> 
                    <br>
                    <a class="olvpass" href="resetpassword.php">¿Has olvidado la contraseña?</a>
                    <br><br>
                    <button type="submit">Login</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</body>
<?php include "sistema/includes/footer.php" ?>
</html>