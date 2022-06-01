    <?php
    include ("../Includes/header.php");?>
    <?php
    include('data.php');
    require_once('vendor/php-excel-reader/excel_reader2.php');

    require_once('vendor/SpreadsheetReader.php');

    if (isset($_POST["import"]))
    {
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if(in_array($_FILES["file"]["type"],$allowedFileType)){

            $targetPath = 'subidas/'.$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

            $Reader = new SpreadsheetReader($targetPath);

            $sheetCount = count($Reader->sheets());
            for($i=0;$i<$sheetCount;$i++)
            {

                $Reader->ChangeSheet($i);

                foreach ($Reader as $Row)
                {

                    $legajo = "";
                    if(isset($Row[1])) {
                        $legajo = mysqli_real_escape_string($con,$Row[1]);
                    }

                    $nombre = "";
                    if(isset($Row[2])) {
                        $nombre = mysqli_real_escape_string($con,$Row[2]);
                    }

                    $horario = "";
                    if(isset($Row[3])) {
                        $horario = mysqli_real_escape_string($con,$Row[3]);
                    }
                    if (!empty($legajo) || !empty($nombre) || !empty($horario)) {
                        $query = "INSERT into registros(legajo,nombre,horario) values(".$legajo.",'".$nombre."','".$horario."')";
                        $resultados = mysqli_query($con,$query);
                        if (!empty($resultados)) {
                            $type = "success";
                            $message = "Excel importado correctamente";
                        } else {
                            $type = "error";
                            $message = "Hubo un problema al importar registros";
                        }
                    }
                }

            }
        }
        else
        {
            $type = "error";
            $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
        }
    }
    ?>
    <body>
    <!-- Begin page content -->
    <div class="container">
        <h3>Importar archivo de Lector</h3>
        <hr>
        <div class="row justify-content-center">
                <!-- Contenido -->
                        <form action="" method="post"
                          name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                        <div>
                            <label for="file" class="col-lg-5 col-form-label">Elija Archivo Excel</label>
                            <input type="file" name="file" id="file" class="btn btn-success" accept=".xls,.xlsx">
                            <div class="form-group">
                                <button type="submit" id="submit" name="import" class="btn btn-warning col-sm-3">Importar Registros</button>
                            </div>
                        </div>
                    </form>
                <!-- Fin Contenido -->
        </div>

        <h3>Importar Listado de Personal Nuevo</h3>
        <hr>
            <div class="row justify-content-center">
             <?php
                    $valor=$_SESSION['mostrar'];
                    if ($valor=='Admin') {
                        echo '   
                <div class="row justify-content-center">
                <!-- Contenido -->
                    <div class="outer-container">
                        <form action="" method="post"
                              name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <div>
                                <label for="file" class="col-lg-2 col-form-label">Elija Archivo Excel</label>
                                <input type="file" name="file" id="file" class="btn btn-success" accept=".xls,.xlsx">
                                <button type="submit" id="submit" name="import" class="btn btn-warning">Importar Registros</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>                          
              ';}
                    else 
                        {echo '<h3>Para agregar nuevos legajos, consulte con un Administrador</h3></div>';}
                ?>
           <!-- Fin Contenido -->
           <!-- Fin row -->
            </div>
    <!-- Fin container -->
        <br/>
    </body>
    <?php
    include ("../Includes/footer.php");?>
