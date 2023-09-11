<!-- Header -->
<?php
session_start();
if (empty($_SESSION['active'])) {
	header('location: ../');
}
include "includes/functions.php";
include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/logocaja.png">
    <title>SoftwareInventory</title>
</head>

<body>
	<div id="contenedor">

		<?php include_once "includes/menu.php"; ?>

		<!-- Header -->
		<div id="">
			<div class="row-cabecera">
				<div class="colcabecera text-right text-dark">
					<a><?php echo fechaBogota();?></a>
				</div>
				<div class="colcabecera text-right text-dark">
					<div class="dropdown">
						<!-- <button><?php echo $_SESSION['nombreempleado'];?></button> -->
						<button><a href="salir.php">Salir</a></button>
						<div class="dropdown-content">
							<!-- <a href="#"><?php echo $_SESSION['email']; ?></a> -->
							<!-- <a href="salir.php">Salir</a> -->
						</div>
					</div>
				</div>
			</div>
		</div>
