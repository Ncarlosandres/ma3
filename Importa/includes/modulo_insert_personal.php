<div class="row">

    <div class="col">

      <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
       
       <div class="input-group mb-3 mt-3">       
           
           
           
           <div class="custom-file">
               
               <input type="file" name="file" class="custom-file" id='file_excel' aria-describedby="cartelfile1" accept=".xls,.xlsx">
               <label class="custom-file-label" for='file_excel'>Elija un Archivo Excel</label>
               
           </div>
           
           <div class="input-goup-apend">
              
               <button class="btn btn-outline-secondary" type="submit" id="submit" name="import">Importar registros</button>       
               
           </div>
           
       </div>
              
   </form>
 
</div>

</div>

<div class="row">
    <div class="col">
        
        <?php

        // Includes

        require_once( 'vendor/php-excel-reader/excel_reader2.php' );
        require_once( 'vendor/SpreadsheetReader.php' );

        //Variables

        $consulta_legajos_bd = "SELECT `legajo` FROM personal;";

        $legajos_bd = array();

        $contador = 0;


        //Consulta legajos

        $query_consulta_legajos_bd = mysqli_query( $con, $consulta_legajos_bd );

            while( $res = mysqli_fetch_array($query_consulta_legajos_bd) ) {

                array_push( $legajos_bd, $res[0] );

            }

        //Consulta legajos desde excel

        if ( isset( $_POST["import"] ) ) {


            $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

                        if ( in_array( $_FILES["file"]["type"], $allowedFileType ) ) {

                            $targetPath = 'subidas/'.$_FILES['file']['name'];
                            move_uploaded_file( $_FILES['file']['tmp_name'], $targetPath );

                            $Reader = new SpreadsheetReader( $targetPath );

                            $sheetCount = count( $Reader -> sheets() );

                            for ( $i = 0; $i < $sheetCount; $i++ ) {

                                $Reader->ChangeSheet( $i );

                                foreach ( $Reader as $Row ) {


                                        if(in_array(mysqli_real_escape_string($con,$Row[0]),$legajos_bd)){



                                        }else{

                                            $contador++;

                                            $legajo = mysqli_real_escape_string($con,$Row[0]).'<br/>';
                                            $nombre = mysqli_real_escape_string($con,$Row[1]);
                                            $direccion = mysqli_real_escape_string($con,$Row[6]);
                                            $telefono = mysqli_real_escape_string($con,$Row[5]);

                                            $query_insertar_legajos = "INSERT into `personal`(`legajo`,`nombre`,`direccion`,`telefono`) values('$legajo','$nombre','$direccion','$telefono')";

                                            $consulta_insertar_legajos = mysqli_query($con, $query_insertar_legajos);
                                        }                            

                                    }

                            }

                        }else{

                            echo 'El archivo seleccionado es invalido';

                        } 

            $query_eliminar_membrete = "DELETE FROM personal WHERE legajo = 0;";
            $consulta_eliminar_membrete = mysqli_query($con, $query_eliminar_membrete);

            if($contador > 1){

                echo 'Se agregaron '.$contador.' registros a la base de datos';

            }else{

                echo 'No se agregaron nuevos legajos a la base de datos';

            }
            
            mysqli_close($con);
        }


        ?>
            
    </div>
</div>

