<!DOCTYPE html>
<html lang="es">
   
    <head>
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insertar Nuevos Legajos</title>

        <link rel="stylesheet" href="librerias/css_bootstrap/bootstrap.css">
        <link rel="stylesheet" href="estilos_popup.css">

    </head>

    <body>

       <div class="container">
           
                <div class="row mt-3 mb-2">
               
               <div class="col">
                   
                     <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                        <div>
                            <div class="form-row">
                                <div class="custom-file mb-1">
                                    
                                    <label for="file_legajo" class="custom-file-label">Elija un archivo de legajos excel</label><br/>
                                    <input type="file" name="file_legajo" id="file" class="custom-file-input" accept=".xls,.xlsx">
                                    
                                </div>
                            </div>
                            
                            <div class="form-row">
            
                                <button type="submit" id="submit" name="import_legajo" class="btn btn-warning btn-block">Importar Registros</button>
                                
                            </div>
                            
                         </div>
                    </form>
                </div>
                   
               </div>
           
           <div class="row">
               
               <div class="col">
                   
                  
                    <?php
    
        //print_r($_FILES);

        // Includes

        require_once( 'vendor/php-excel-reader/excel_reader2.php' );
        require_once( 'vendor/SpreadsheetReader.php' );
        include('data.php');

        //Variables

        $consulta_legajos_bd = "SELECT `legajo` FROM personal;";

        $legajos_bd = array();

        $contador = 0;


        //Consulta legajos

        
        //Consulta legajos desde excel

        if ( isset( $_POST["import_legajo"] ) ) {

            echo '<table class="table table-dark">';
            
            $query_consulta_legajos_bd = mysqli_query( $con, $consulta_legajos_bd );

                while( $res = mysqli_fetch_array($query_consulta_legajos_bd) ) {

                array_push( $legajos_bd, $res[0] );

            }   

            
            $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

                        if ( in_array( $_FILES["file_legajo"]["type"], $allowedFileType ) ) {
                            

                            $targetPath = 'subidas_legajos/'.$_FILES['file_legajo']['name'];
                            move_uploaded_file( $_FILES['file_legajo']['tmp_name'], $targetPath );

                            $Reader = new SpreadsheetReader( $targetPath );

                            $sheetCount = count( $Reader -> sheets() );

                            for ( $i = 0; $i < $sheetCount; $i++ ) {

                                $Reader->ChangeSheet( $i );

                                foreach ( $Reader as $Row ) {


                                        if(in_array(mysqli_real_escape_string($con,$Row[0]),$legajos_bd)){



                                        }else{

                                            $contador++;

                                            $legajo = mysqli_real_escape_string($con,$Row[0]);
                                            $nombre = mysqli_real_escape_string($con,$Row[1]);
                                            $direccion = mysqli_real_escape_string($con,$Row[6]);
                                            $telefono = mysqli_real_escape_string($con,$Row[5]);

                                            $query_insertar_legajos = "INSERT into `personal`(`legajo`,`nombre`,`direccion`,`telefono`) values('$legajo','$nombre','$direccion','$telefono')";

                                            $consulta_insertar_legajos = mysqli_query($con, $query_insertar_legajos);
                                        }                            

                                    }

                            }

                        }else{

                            echo '<tr><td>El archivo seleccionado es invalido</td></tr>';

                        } 

            $query_eliminar_membrete = "DELETE FROM personal WHERE legajo = 0;";
            $consulta_eliminar_membrete = mysqli_query($con, $query_eliminar_membrete);

            if($contador > 1){

                echo '<tr><td>Se agregaron '.$contador.' registros a la base de datos</td></tr>';

            }else{

                echo '<tr><td>No se agregaron nuevos legajos a la base de datos</td></tr>';

            }
            
            echo '</table>';
            mysqli_close($con);
        }


        ?>
                   
                   
               </div>
               
               
           </div>
           
       </div> 
   
    </body>
    
</html>
<script src="librerias/java_script/jquery-3.4.1.min.js"></script>    
<script src="librerias/java_script/bootstrap.js"></script>    
<script src="librerias/java_script/popper.min.js"></script>    
  

