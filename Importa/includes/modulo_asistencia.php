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
         
            //------------------------------Funciones y Variables-----------------------------------------------------------//   
         
            require_once( 'vendor/php-excel-reader/excel_reader2.php' );
            require_once( 'vendor/SpreadsheetReader.php' );
         
         
         
            function operar_dia($fecha,$datos_con){
    
                $legajos_dia = array();
                $legajos_pre = array();

                //Esta parte de la funcion carga el dia marcado en la base de datos.
                $consulta_cargar_dia = "INSERT into `dias_cargados`(`fecha`) values('$fecha')";
                $cargar_dia = mysqli_query( $datos_con, $consulta_cargar_dia );

                //Esta parte de la funcion determina el dia de la semana correspondiente a la fecha y carga los legajos correspondientes en un array.

                $dia = date('l',strtotime($fecha)); // <---- Determina el dia de la semana.
                $receptor = array();

                 switch($dia){
                    case 'Monday':
                        $dia = 'lun';
                        break;

                    case 'Tuesday':
                        $dia = 'mar';
                        break;

                    case 'Wednesday':        //<------- Ese switch hace una traduccion
                        $dia = 'mie';
                        break;

                    case 'Thursday':
                        $dia = 'jue';
                        break;

                    case 'Friday':
                        $dia = 'vie';
                        break;

                     default:
                         echo ' El dia ingresano no es válido';
                         exit();
                }

                $consuta_legajos_presentes = "SELECT * FROM `temporal` WHERE `fecha` = '$fecha' AND `suceso` = 'Entrada'";
                $query_determinar_presentes = mysqli_query($datos_con, $consuta_legajos_presentes);

                    while($res = mysqli_fetch_array($query_determinar_presentes)){
                            array_push($legajos_pre,$res[1]);
                    }

                $legajos_pre = array_unique($legajos_pre);
                $legajos_pre = array_values($legajos_pre);

                $consulta_legajos_bd = "SELECT * FROM `personal` WHERE `$dia` = 0"; 
                $query_legajos_dia = mysqli_query($datos_con, $consulta_legajos_bd);

                     while($res = mysqli_fetch_array($query_legajos_dia)){
                            array_push($legajos_dia,$res[1]);
                    }


                for($p = 0; $p < count($legajos_dia); $p++){

                    if(in_array($legajos_dia[$p],$legajos_pre)){

                        $consultar_horario_entrada = "SELECT horaentrada FROM `personal` WHERE `legajo` = $legajos_dia[$p]";
                        $query_horario_entrada = mysqli_query($datos_con, $consultar_horario_entrada);
                        $query_horario_entrada = mysqli_fetch_array($query_horario_entrada);
                        $horario_entrada = new DateTime($query_horario_entrada[0]);

                        $consultar_horario_entro = "SELECT hora FROM `temporal` WHERE `legajo` = $legajos_dia[$p] AND `suceso` = 'Entrada'";
                        $query_horario_entro = mysqli_query($datos_con, $consultar_horario_entro);
                        $query_horario_entro = mysqli_fetch_array($query_horario_entro);
                        $Hora_entro = new DateTime($query_horario_entro[0]);

                        $diferencia_horario = date_diff($horario_entrada, $Hora_entro);
                        $diferencia_horario = $diferencia_horario -> format('%R%i');

                        $Hora_entro = $Hora_entro -> format('H:i');

                        if($diferencia_horario > 5){ //<------- Modificar ese numero para cambiar la "TOLERANCIA"

                            $query_llegada = "INSERT into `presentes`(`legajo`,`fecha`,`hora`) values('$legajos_dia[$p]','$fecha','$Hora_entro')";
                            $consulta_llegada = mysqli_query($datos_con, $query_llegada);
                            $query_agregar_tarde = "UPDATE personal set tarde = tarde + 1 WHERE legajo = $legajos_dia[$p]";
                            $consulta_agregar_tarde = mysqli_query($datos_con, $query_agregar_tarde);
                            $query_agregar_asistencia = "UPDATE personal set asistencia = asistencia + 1 WHERE legajo = $legajos_dia[$p]";
                            $consulta_agregar_tarde = mysqli_query($datos_con, $query_agregar_asistencia);
                            $query_llegada_tarde = "INSERT into `llegadas_tardes`(`legajo`,`fecha`,`hora`) values('$legajos_dia[$p]','$fecha','$Hora_entro')";
                            $consulta_llegada_tarde = mysqli_query($datos_con, $query_llegada_tarde);

                        }
                        else{

                            $query_llegada = "INSERT into `presentes`(`legajo`,`fecha`,`hora`) values('$legajos_dia[$p]','$fecha','$Hora_entro')";
                            $consulta_llegada = mysqli_query($datos_con, $query_llegada);
                            $query_agregar_asistencia = "UPDATE personal set asistencia = asistencia + 1 WHERE legajo = $legajos_dia[$p]";
                            $consulta_agregar_tarde = mysqli_query($datos_con, $query_agregar_asistencia);

                        }

                    }
                    else{

                        $query_ausencia = "INSERT into `ausentes`(`Legajo`,`Fecha`,`Estado`) values('$legajos_dia[$p]','$fecha','Injustificado')";
                        $consulta_ausencia = mysqli_query($datos_con, $query_ausencia);
                        $query_agregar_ausencia = "UPDATE personal set falta = falta + 1 WHERE legajo = $legajos_dia[$p]";
                        $consulta_agregar_ausencia = mysqli_query($datos_con, $query_agregar_ausencia);

                    }

                }

                return;
            }
            
         
         
         

            //--------------------------------Carga de excel----------------------------------------------------------------//

            if ( isset( $_POST["import"] ) ) {

                $fechas_excel = array();
                //Aqui se va a almacenar las fechas proveniente del excel
                $fechas_bd = array();
                //Aqui se va a almacenar las fechas provenientes de la base de datos

                //-------------------Gernerar Array con fechas desde EXCEL----------//

                $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

                if ( in_array( $_FILES["file"]["type"], $allowedFileType ) ) {

                    $targetPath = 'subidas/'.$_FILES['file']['name'];
                    move_uploaded_file( $_FILES['file']['tmp_name'], $targetPath );

                    $Reader = new SpreadsheetReader( $targetPath );

                    $sheetCount = count( $Reader->sheets() );
                    for ( $i = 0; $i<$sheetCount; $i++ ) {

                        $Reader->ChangeSheet( $i );

                        foreach ( $Reader as $Row ) {
                            $consulta_fecha = "";
                            if ( isset( $Row[3] ) ) {
                                $consulta_fecha_excel = mysqli_real_escape_string( $con, $Row[3] );
                                $consulta_fecha_excel = explode( ' ', $consulta_fecha_excel );
                                $consulta_fecha_excel = $consulta_fecha_excel[0];
                                array_push( $fechas_excel, $consulta_fecha_excel );


                                //-------- CARGA TABLA TEMPORARL BD--------//

                                 $legajo = "";
                                if(isset($Row[0])) {
                                    $legajo = mysqli_real_escape_string($con,$Row[1]);
                                }

                                $fecha = "";
                                if(isset($Row[3])) {
                                    $fecha = mysqli_real_escape_string($con,$Row[3]);
                                    $fecha = explode(' ',$fecha);
                                   @ $hora = $fecha[1];
                                    $fecha = $fecha[0];
                                }

                                $suceso = "";
                                if(isset($Row[1])) {
                                    $suceso = mysqli_real_escape_string($con,$Row[4]);
                                }

                                if (!empty($legajo)) {

                                    $query="INSERT into `temporal`(`legajo`,`fecha`,`hora`,`suceso`) values('$legajo','$fecha','$hora','$suceso')";
                                    $query3="DELETE FROM `temporal` WHERE `legajo` = 0";        
                                    $carga = mysqli_query($con,$query);
                                    $carga3 = mysqli_query($con,$query3);

                                }


                            }
                        }
                    }

                    $fechas_excel = array_unique( $fechas_excel );
                    unset( $fechas_excel[0] );
                    array_pop( $fechas_excel );
                    $fechas_excel = array_values( $fechas_excel );

                    //--------------Generar Array con las fechas desde la base de datos------------//

                    $query_c = "SELECT * FROM `dias_cargados`";
                    $consulta_c = mysqli_query( $con, $query_c );

                    while( $res = mysqli_fetch_array( $consulta_c ) ) {
                        array_push( $fechas_bd, $res[0] );
                    }


                } else {

                    echo 'El archivo importado no tiene el formato adecuado';

                }

                //---------------Comprobaciones y operaciones----------------------------------------------------------------------------//

                for ( $r = 0; $r < count( $fechas_excel );
                $r++ ) {

                    if ( in_array( $fechas_excel[$r], $fechas_bd ) ) {

                        echo "$fechas_excel[$r] esta fecha ya se encuentra cargada en la base de datos <br/>";

                    } else {

                        operar_dia($fechas_excel[$r],$con);

                    }

                }

            }

            //-------------------------Eliminar Temporales----------------//

                $query_eliminar_temporal = "TRUNCATE TABLE temporal";
                $conlsulta_eliminar_temporal = mysqli_query($con,$query_eliminar_temporal);
                mysqli_close($con);

            ?>
           

    </div>

</div>