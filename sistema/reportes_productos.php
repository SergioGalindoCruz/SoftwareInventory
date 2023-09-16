<?php
	include "../conexion.php";
    header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=lista_productos.xls");
?>

<table border="1">
<caption>Tabla Productos</caption>
<tr>
    <th>ID</th>
    <th>CODIGOBARRAS</th>
    <th>DESCRIPCION</th>
    <th>PRECIO VENTA</th>
    <th>PRECIO COSTO</th>
    <th>STOCK</th>
    <th>CATEGORIA</th>
    <th>PROVEEDOR</th>
</tr>
<tbody>
    <?php
    $query = mysqli_query($conectar, "SELECT productos.idproducto , productos.codigobarras , productos.descripcion , productos.precioventa , productos.preciocosto , productos.stock , categorias.nombre as categoria, proveedores.nombre as proveedor FROM productos left join categorias on productos.idcategoria = categorias.idcategoria left join proveedores on productos.idproveedor = proveedores.idproveedor");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $data['idproducto']; ?></td>
                <td><?php echo $data['codigobarras']; ?></td>
                <td><?php echo $data['descripcion']; ?></td>
                <td><?php echo $data['precioventa']; ?></td>
                <td><?php echo $data['preciocosto']; ?></td>
                <td><?php echo $data['stock']; ?></td>
                <td><?php echo $data['categoria']; ?></td>
                <td><?php echo $data['proveedor']; ?></td>
            
            </tr>
    <?php }
    } ?>
</table>