<?php 
    define('Servidor', 'dbappsoftwareinventory.mysql.database.azure.com:3306');
    define('Usuario', 'sergio_galindo733');
    define('Password', 'G20Isabella');
    define('Database', 'softwareinventory');

    $conectar = mysqli_connect(Servidor, Usuario, Password, Database);

    if($conectar===FALSE){
        die("Revise los datos de conexión.<br> Ha habido un error: ".mysqli_connect_error());
    }else{
        //echo "La conexión a la base de datos ha sido exitosa.";
    }
?>
