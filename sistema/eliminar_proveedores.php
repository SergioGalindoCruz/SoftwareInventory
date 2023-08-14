<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conectar, "DELETE FROM proveedores WHERE idproveedor = $id");
    mysqli_close($conectar);
    header("location: listar_proveedores.php");
}
?>