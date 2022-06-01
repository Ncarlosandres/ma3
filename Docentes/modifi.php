    <?php
        include("../Includes/header.php");
        include("../Includes/conexion.php");
        if (isset($_GET['legajo'])) {
            $legajo = @$_GET['legajo'];
            $sql = "SELECT * FROM personal WHERE legajo='$legajo'";
            $resultado = $conexion->query($sql);
            if (!$resultado) {
                echo '<a href="index.php">Regresar a Menu Principal' . '</a>';
                die ("OCURRIO UN FALLO AL GRABAR LA CONSULTA");
            }
            $fila = $resultado->fetch_assoc();
        }
        if (isset($_POST['enviar'])) {

            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $entrada = $_POST['entrada'];
            $salida = $_POST['salida'];
            if ($entrada == '' or $salida == '') {
                $_SESSION['message'] = 'USUARIO MODIFICADO';
                $_SESSION['message_type'] = 'primary';
            } else {
                $sql = "UPDATE personal SET Telefono= '$telefono',Direccion='$direccion', horaentrada='$entrada', horasalida='$salida' WHERE legajo='$legajo'";
                $resultado = $conexion->query($sql);
                echo $sql;
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
            <form action="modifi.php?legajo=<?php echo $_GET['legajo']; ?>" method="POST">
              <div class="form-group row justify-content-center">
                  <label for="legajo" class="col-lg-2 col-form-label">Legajo:</label>
                <div class="col-lg-3">
                  <input disabled type="number" class="form-control" id="legajo" name="legajo" value="<?php echo $fila['legajo']?>">
                </div>
              </div>
                <div class="form-group row justify-content-center">
                    <label for="nombre" class="col-lg-2 col-form-label">Nombre:</label>
                    <div class="col-lg-3">
                        <input disabled type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre']?>">
                    </div>
                </div>
              <div class="form-group row justify-content-center">
                <label for="telefono" class="col-lg-2 col-form-label">Telefono:</label>
                <div class="col-lg-3">
                  <input type="text" class="form-control" id="telefono" name="telefono"  value="<?php echo $fila['Telefono']?>">
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <label for="domicilio" class="col-lg-2 col-form-label">Domicilio:</label>
                <div class="col-lg-3">
                  <input type="text" class="form-control" id="domicilio" name="direccion"  value="<?php echo $fila['Direccion']?>">
                </div>
              </div>
              <div class="form-group row justify-content-center">
                    <label for="entrada" class="col-lg-1 col-form-label">Entrada:</label>
                    <input type="time" name="entrada" class="form-control col-sm-2" id="entrada" name="entrada"  value="<?php echo $fila['horaentrada']?>">
                    <label for="salida" class="col-sm-1 col-form-label">Salida:</label>
                    <input type="time" name="salida" class="form-control col-sm-2" id="salida" name="salida"  value="<?php echo $fila['horasalida']?>">
                </div>
                <hr>
                <div class="row justify-content-center">
                    <button type="submit" name="enviar" value="Entrar" class="btn btn-warning">Actualizar</button>
                </div>

            </form>

    </div>       

    <br/>
    <?php
    include ("../Includes/footer.php");?>