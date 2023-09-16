<?php
	include "../conexion.php";
    header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=lista_categorias.xls");
?>

<table border="1">
<caption>Tabla Categorias</caption>
<tr>
    <th>ID</th>
    <th>CATEGORIAS</th>
</tr>

<tbody>
    <?php
    $query = mysqli_query($conectar, "SELECT * FROM categorias");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $data['idcategoria']; ?></td>
                <td><?php echo $data['nombre']; ?></td>            
            </tr>
    <?php }
    } ?>
</table>