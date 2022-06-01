    <?php
        include("../Includes/header.php");
        include("../Includes/conexion.php");
        if (isset($_GET['id'])) {
            $id = @$_GET['id'];
            $sql = "SELECT * FROM articulos_justificativos WHERE id='$id'";
            $resultado = $conexion->query($sql);
            if (!$resultado) {
                echo '<a href="index.php">Regresar a Menu Principal' . '</a>';
                die ("OCURRIO UN FALLO AL GRABAR LA CONSULTA");
            }
            $fila = $resultado->fetch_assoc();
        }
        if (isset($_POST['enviar'])) {
            $numero_articulo = $_POST['numero_articulo'];
            $descripcion = $_POST['descripcion'];
            $dias_justificados = $_POST['dias_justificados'];
            if ($numero_articulo == '' or $descripcion == '' or $dias_justificados == '') {
                $_SESSION['message'] = 'Articulo MODIFICADO';
                $_SESSION['message_type'] = 'primary';
            } else {
                $sql = "UPDATE articulos_justificativos SET numero_articulo = '$numero_articulo',descripcion='$descripcion', dias_justificados='$dias_justificados' WHERE id='$id'";
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
                  <label for="numero" class="col-lg-2 col-form-label">Art. Numero:</label>
                <div class="col-lg-3">
                  <input type="number" class="form-control" id="numero" name="numero_articulo" value="<?php echo $fila['numero_articulo']?>">
                </div>
              </div>
                <div class="form-group row justify-content-center">
                    <label for="descripcion" class="col-lg-2 col-form-label">Descripcion:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']?>">
                    </div>
                </div>
              <div class="form-group row justify-content-center">
                <label for="dias_aplicacion" class="col-lg-2 col-form-label">Dias que aplica:</label>
                <div class="col-lg-3">
                  <input type="text" class="form-control" id="dias_justificados" name="dias_justificados"  value="<?php echo $fila['dias_justificados']?>">
                </div>
              </div>
                <hr>
                <div class="row justify-content-center">
                    <button type="submit" name="enviar" value="Entrar" class="btn btn-warning">Actualizar</button>
                </div>

            </form>

        </div>       
    </div>
    <br/>
    <?php
    include ("../Includes/footer.php");?>