<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conectar, "DELETE FROM usuarios WHERE idusuario = $id");
    mysqli_close($conectar);
    header("location: listar_usuarios.php");
}
?>