<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="sistema/style/style.css">
    <link rel="icon" href="sistema/img/logocaja.png">  
    <title>SoftwareInventory</title>
    
</head>
<body>
    <form action="sistema/validadorresetpassword.php" method="POST">
        <div id="reset-box">
            <h2>Recupera tu cuenta</h2>
            <h6>Introduce tu usuario y correo electrónico para buscar tu cuenta.</h6>
            <br><br>
            <div class="form">
                <div class="item">
                    <input type="text" placeholder="Ingrese Usuario" name="username" required>
                </div>
                <br>
                <div class="item">
                    <input type="email" placeholder="Ingrese correo" name="email" required>
                </div>
            </div> 
            <br>
            <button type="submit">Enviar</button>
        </div>
    </form>
</body>
<?php include "sistema/includes/footer.php" ?>
</html>