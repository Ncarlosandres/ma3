<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <header>
            <center><br/>
                <img src="Includes/pics/logo.png" alt="logo" width="60" height="75">
                <hr>
                <h1>SISTEMA GESTIÓN ESCUELA</h1>
                <hr>
        </header>
        <div class="row justify-content-center">
            <div class="col-sm-3">
                <div class="card text-white" style="background-color: black;border-radius: 15px;">
                    <form action="Login/Login.php" method="POST" >
                        <center>
                            <div class="form-group">
                                <br/>
                                <h3>BIENVENIDO!</h3>
                                <br/>
                                <h5>Usuario</h5>
                                <input type="text" name="usuario" class="col-xs-2" autofocus>
                            </div>
                            <div class="form-group">
                                <h5>Contraseña</h5>
                                <input type="password" name="clave" class="col-xs-2" autofocus>
                            </div>
                            <div class="alert" style="color:wheat"><?php echo isset($alert)? $alert : ''; ?></div>
                            <br/>
                            <input type="submit" class="btn btn-success btn-block" name="grabar" value="ENTRAR A SISTEMA">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <footer class="page-footer font-small">
        <div class="footer-copyright text-center titulo3">
            <hr>
            <p>© 2021 Copyright PUERTAS - DIAMANTE. </p>
            <p>TRABAJO PRACTICA PROFESIONALIZANTE</p>
            <hr>
        </div>
    </footer>
</html>

