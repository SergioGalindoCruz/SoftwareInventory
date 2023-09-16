<?php
	include "../conexion.php";
    header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=lista_usuarios.xls");
?>

<table border="1">
<caption>Tabla Usuarios</caption>
<tr>
    <th>IDENTIFICACIÓN</th>
    <th>NOMBRE</th>
    <th>USUARIO</th>
    <th>EMAIL</th>
    <th>ROL</th>
</tr>
<tbody>
    <?php
    $query = mysqli_query($conectar, "SELECT * FROM usuarios inner join rol on usuarios.idrol = rol.idrol");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $data['idusuario']; ?></td>
                <td><?php echo $data['nombreempleado']; ?></td>
                <td><?php echo $data['usuario']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['rol']; ?></td>
            </tr>
    <?php }
    } ?>
</table>