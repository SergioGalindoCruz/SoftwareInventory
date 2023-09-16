<?php
	include "../conexion.php";
    header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=lista_clientes.xls");
?>

<table border="1">
<caption>Tabla Clientes</caption>
<tr>
    <th>IDENTIFICACIÓN</th>
    <th>NOMBRE</th>
    <th>DIRECCION</th>
    <th>TELEFONO</th>
    <th>EMAIL</th>
</tr>
<tbody>
    <?php
    $query = mysqli_query($conectar, "SELECT * FROM clientes");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $data['idcliente']; ?></td>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['direccion']; ?></td>
                <td><?php echo $data['telefono']; ?></td>
                <td><?php echo $data['email']; ?></td>            
            </tr>
    <?php }
    } ?>
</table>