<!DOCTYPE html>
<html lang="UTF-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/570bb18b54.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css"
          integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <script src="js/jquery.js"> </script>
    <script src="js/bootstrap.min.js"></script>

</head>
    <body>
        <header>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-1 centrado">
                        <img src="pics/logo.png" alt="logo" width="70" height="100">
                    </div>
                    <div class="col-lg-8 izquierda" style="margin-top: 15px">
                        <h3 class="titulo">E.E.T. 3149 Dr. Julio I. Mera Figueroa</h3>
                        <h5 class="titulo2">Veterano de Malvinas s/n</h5>
                        <h5 class="titulo2">Barrio Jesús María - Salta Capital</h5>
                    </div>
                    <div class="col-lg-3 derecha">
                        <h5>
                            <?php
                            session_start();
                            $user = $_SESSION["usuario"];
                            $mostrar=$_SESSION["mostrar"];
                            if(!isset($user)) {
                                header("location: ../index.php");
                            }else {
                                echo $user.' - '.$mostrar;
                            }?>
                        </h5>
                    </div>

                </div>
            </div>
        </header>
    <nav>
        <ul>
            <?php
                $valor=$_SESSION['mostrar'];
                if ($valor=='Admin') {echo '
            <li><a href="../Importa/index.php">
                <div class="zoom">
                    <img class="inside" src="pics/carpeta.png" alt="IMPORTACION" width="70" height="70" title="IMPORTACION" >
                </div></a></li>';} ?>
            <li><a href="../Personal/index.php">
                <div class="zoom">
                    <img class="inside" src="pics/persona.png" alt="PERSONAL" width="70" height="70" title="PERSONAL">
                </div></a></li>
            <li><a href="../Docentes/index.php">
                <div class="zoom">
                    <img class="inside" src="pics/docentes.png" alt="DOCENTES" width="70" height="70" title="DOCENTES" >
                </div></a></li>
            <?php
                $valor=$_SESSION['mostrar'];
                if ($valor=='Admin') {echo '
                <li><a href="../Usuarios/index.php">
                <div class="zoom">
                    <img src="pics/Usuarios.png" alt="USUARIOS" width="70" height="70" title="USUARIOS" class="inside" >
                </div></a></li>
		';} ?>
            <li><a href="../Articulos/index.php">
                <div class="zoom">
                    <img src="pics/articulos.png" alt="ARTICULOS" width="70" height="70" title="ARTICULOS" class="inside" >
                </div></a></li>
            <li><a href="../Asistencia/index.php">
                <div class="zoom">
                    <img src="pics/asistencia.png" alt="ASISTENCIA" width="70" height="70" title="ASISTENCIA" class="inside" >
                </div></a></li>

        </ul>
    </nav>