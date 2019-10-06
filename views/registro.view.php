<!DOCTYPE html>
<html lang="en">
<head>
    <link rel = "stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body><br><br>

    <div class="card text-cente bg-light col-3 offset-md-5">
        <h1> Registrate</h1>
        <a href="cerrar.php">cerrar sesion</a>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"  >
            <div class="form-group">
                <label for="">Nombre</label><input type="text" class="form-control" name="txtnombre">
            </div>
            <div class="form-group">
                <label for="">Clave</label><input type="password" class="form-control" name="txtclave">
            </div>
            <div class="form-group">
                <label for="">Confirmar Clave</label><input type="password" class="form-control" name="txtclave2">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="btnEnviar">Confirmar</button>
            </div>

            <?php if(!empty($errores)):?>
                <div>
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                </div>
            <?php endif; ?>


            <p> Ya tienes Cuenta ?<a href="login.php">Inicio de sesion </a></p>
        </form>
    </div>
    
</body>
</html>