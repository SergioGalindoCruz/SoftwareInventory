<?php 
    include "../conexion.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);


    $usuario = $_POST["username"];
    $email = $_POST["email"]; 
    
    $consulta = "SELECT * FROM usuarios WHERE  usuario = '$usuario'";
    $resultado = mysqli_query($conectar , $consulta) or die(mysqli_connect_error());
    $validacion = mysqli_fetch_assoc($resultado);
    $filas = mysqli_num_rows($resultado);
    
    if($filas == 1){
        $validacion_email =  $validacion['email'];

        if($validacion_email == $email){

            $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitud = 12;
            $nuevopass = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sergio.galindo733@misena.edu.co';
                $mail->Password = '123456789';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
            
                $mail->setFrom('sergio.galindo733@misena.edu.co', 'Software Inventory');
                $mail->addAddress($email);
            
                $mail->isHTML(true);
                $mail->Subject = 'Software Inventory - Recuperacion Contraseña';
                $mail->Body = "Su nueva contraseña es: ".$nuevopass.". Esta contraseña expira en 15 minutos, una vez inicie sesión realice el cambio.";
                $mail->send();

                echo'<script type="text/javascript">
                    alert("Contraseña enviada al coreo registrado.");
                    window.location.href="index.php";
                    </script>';
                    
                    $query_updatereset = mysqli_query($conectar, "UPDATE usuarios SET contrasena = MD5('$nuevopass') WHERE usuario = '$usuario'");
                    if ($query_updatereset) {} else {}

            } catch (Exception $e) {
                echo 'Mensaje ' . $mail->ErrorInfo;
            }
        }else{
            echo'<script type="text/javascript">
            alert("Su email no coincide.");
            window.location.href="index.php";
            </script>';
        } 
    }else{
        echo'<script type="text/javascript">
        alert("Su usuario no se encuentra en la aplicacion.");
        window.location.href="index.php";
        </script>';
    }
?>
<?php