<?php
    include "conexion.php";
        
    mysqli_query($conectar, "insert into Stock (fecha,tipomovimiento,IdProducto,cantidad)
        values ($_REQUEST[fecha],'$_REQUEST[tipomovimiento]','$_REQUEST[IdProducto]','$_REQUEST[cantidad]')")
        or die("Problemas en el select".
    mysqli_error($conectar));
    mysqli_close($conectar);

    echo "<h3 class='alert alert-success'>Se ha creado el movimiento en el sistema</h3><br>";
?>