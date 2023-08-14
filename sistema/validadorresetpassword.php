<?php 
    include "../conexion.php";
    $usuario = $_POST["username"];
    $email = $_POST["email"];
    
    $consulta = "SELECT * FROM usuarios WHERE  usuario = '$usuario'";
    
    $resultado = mysqli_query($conectar , $consulta) or die(mysqli_connect_error());
    $validacion = mysqli_fetch_assoc($resultado);
    $filas = mysqli_num_rows($resultado);
    
    if($filas == 1){
        $validacion_email =  $validacion['email'];

        if($validacion_email == $email){
            echo'<script type="text/javascript">
            alert("El administrador se encargara de informale cual es su nueva contraseña.");
            window.location.href="index.php";
            </script>';               
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