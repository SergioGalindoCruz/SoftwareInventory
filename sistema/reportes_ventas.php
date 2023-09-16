<?php
	include "../conexion.php";
    header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=lista_ventas.xls");
?>

<table border="1">
<caption>Tabla Ventas</caption>
<tr>
    <th>ID</th>
    <th>Fecha</th>
    <th>Total</th>
</tr>
<tbody>
    <?php
    $query = mysqli_query($conectar, "SELECT nofactura, fecha,codcliente, totalfactura, estado FROM factura ORDER BY nofactura DESC");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $data['nofactura']; ?></td>
                <td><?php echo $data['fecha']; ?></td>
                <td><?php echo $data['totalfactura']; ?></td>            
            </tr>
    <?php }
    } ?>
</table>