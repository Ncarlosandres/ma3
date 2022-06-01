<?php
    include("../Includes/header.php");
    include("../Includes/conexion.php");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM usu_pass WHERE id='$id'";
        $resultado = $conexion->query($sql);
        if (!$resultado) {
            echo '<a href="index.php">Regresar a Menu Principal' . '</a>';
            die ("OCURRIO UN FALLO AL GRABAR LA CONSULTA");
        }
        $fila = $resultado->fetch_assoc();
    }
    if (isset($_POST['enviar'])) {
        $apellidoynombre = $_POST['apellidoynombre'];
        $nombre = $_POST['nombre'];
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $rolstring = $_POST['rol'];
        if ($password == '' or  $nombre == '') {
            $_SESSION['message'] = 'USUARIO MODIFICADO';
            $_SESSION['message_type'] = 'primary';
        } else {
            if ($rolstring=='Administrador'){
                $rol=TRUE;
            }
            else{
                $rol=FALSE;
            }
            $sql = "UPDATE usu_pass SET apellidoynombre='$apellidoynombre', nombre='$nombre', password= '$password', direccion= '$direccion',email='$email', rol='$rol' WHERE id='$id'";
            $resultado = $conexion->query($sql);
            header("location: index.php");
        }
    }
?>
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">
                <img src="pics/logo.png" alt="logachoooo" width="90" height="100">
            </div>
            <div class="row justify-content-center">
               <h3>Actualizar Registros</h3>
            </div>
           <hr>
            <form action="modifi.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div class="form-group row justify-content-center">
                    <label for="apellidoynombre" class="col-lg-3 col-form-label">Apellido y Nombre REAL:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="apellidoynombre" name="apellidoynombre"  value="<?php echo $fila['apellidoynombre']?>">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="nombre" class="col-lg-3 col-form-label">Nombre Usuario:</label>
                        <div class="col-lg-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre']?>">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="password" class="col-lg-3 col-form-label">Password:</label>
                    <div class="col-lg-3">
                        <input type="password" class="form-control" id="password" name="password"  value="<?php echo substr ( $fila['password'] ,0,10) ; ?>">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="direccion" class="col-lg-3 col-form-label">Direccion:</label>
                    <div class="col-lg-3">
                      <input type="text" class="form-control" id="direccion" name="direccion"  value="<?php echo $fila['direccion']?>">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="email" class="col-lg-3 col-form-label">Email:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="email" name="email"  value="<?php echo $fila['email']?>">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="rol" class="col-lg-3 col-form-label">Tipo de rol:</label>
                    <div class="col-lg-3">
                        <select class="form-control" id="rol" name="rol" value="
                        <?php
                        if ($fila['rol']==TRUE){echo 'Administrador';}
                        else {echo 'Usuario';}
                        ?>">
                            <option>Usuario</option>
                            <option>Administrador</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <button type="submit" name="enviar" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>       
    </div>
<br/>
<?php
include ("../Includes/footer.php");?>