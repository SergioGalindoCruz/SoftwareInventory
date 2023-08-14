<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conectar, "DELETE FROM productos WHERE idproducto = $id");
    mysqli_close($conectar);
    header("location: listar_productos.php");
}
?>