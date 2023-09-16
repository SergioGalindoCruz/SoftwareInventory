<?php
	include "../conexion.php";
    header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=lista_proveedores.xls");
?>

<table border="1">
<caption>Tabla Proveedores</caption>
<tr>
    <th>IDENTIFICACION</th>
    <th>TIPO DOCUMENTO</th>
    <th>NOMBRE</th>
    <th>CONTACTO</th>
    <th>DIRECCION</th>
    <th>TELEFONO</th>
    <th>EMAIL</th>
</tr>
<tbody>
    <?php
    $query = mysqli_query($conectar, "SELECT * FROM proveedores");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $data['idproveedor']; ?></td>
                <td><?php echo $data['tipodocumento']; ?></td>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['contacto']; ?></td>
                <td><?php echo $data['direccion']; ?></td>
                <td><?php echo $data['telefono']; ?></td>
                <td><?php echo $data['email']; ?></td>           
            </tr>
    <?php }
    } ?>
</table>