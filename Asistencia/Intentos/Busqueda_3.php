<div class="row">

            <div class="col">

                <form action="" method="post">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-12">
                            <h4>Búsqueda Asistencia</h4>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="campo_legajo" class="mb-4">Búsqueda por legajo</label>
                            <input type="number" class="form-control" id="campo_legajo" name="num_legajo" placeholder="Nº de legajo">
                        </div>

                        <div class="form-group col-md-1"></div>

                        <div class="form-group col-md-5">
                            <label>Filtrar</label><br />

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_asistencias" name="check_asistencia" value="presentes" checked/>
                                <label class="form-check-label" for="check_asistencias">Asistencias</label><br />
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_inasistencias" name="check_asistencia" value="ausentes"/>
                                <label class="form-check-label" for="check_inasistencias">Inasistencias</label><br />
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_tardes" name="check_asistencia" value="llegadas_tardes">
                                <label class="form-check-label" for="check_tardes">Llegadas Tardes</label><br />
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Busqueda por fecha</label><br />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fecha_desde">Desde</label>
                            <input type="date" class="form-control" name="fecha_desde" id="fecha_desde" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fecha_hasta">Hasta</label>
                            <input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" name="buscar" class="btn btn-primary btn-block">Buscar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row">

            <div class="col">

                <?php

                    if ( isset( $_POST['buscar'] ) ) {

                        $legajo = $_POST['num_legajo'];
                        $chek = $_POST['check_asistencia'];
                        $fecha_desde = $_POST['fecha_desde'];
                        $fecha_hasta = $_POST['fecha_hasta'];
                        $consulta = "";

                        if ( $legajo != null and $fecha_desde != null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM '$chek' WHERE legajo = '$legajo' AND fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";

                        } elseif ( $legajo == null and $fecha_desde == null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE 1;";

                        } elseif ( $legajo == null and $fecha_desde != null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";

                        } elseif ( $legajo == null and $fecha_desde == null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Fecha <= '$fecha_hasta';";

                        } elseif ( $legajo == null and $fecha_desde != null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Fecha >= '$fecha_desde';";

                        } elseif ( $legajo != null and $fecha_desde == null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE legajo = '$legajo'";

                        } elseif ( $legajo != null and $fecha_desde != null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Legajo = '$legajo' AND Fecha >= '$fecha_desde';";

                        } else {

                            $consulta = "SELECT * FROM `$chek` WHERE Legajo = '$legajo' AND Fecha <= '$fecha_hasta';";
                        }

                        if ( $chek == 'ausentes' ) {

                            $consulta_variable = $consulta;

                            $consulta_articulos = "SELECT * FROM `articulos_justificativos` WHERE 1";

                            $query_variable = mysqli_query($con, $consulta_variable);

                            echo '<table class="table table-striped table-bordered" style="text-align: center">';
                            echo '<tr><td>Id</td><td>Legajo</td><td>Fecha</td><td>Estado</td><td>Justificar con</td><td>Accion</td>';

                            while($res_variable = mysqli_fetch_array($query_variable)){

                                $query_articulos = mysqli_query($con, $consulta_articulos);
                                
                                if($res_variable[3] != 'justificado'){
                                    
                                    echo '<tr class="table-primary">';
                                    
                                }else{
                                    
                                    echo '<tr class="table-success">';
                                    
                                }
                                
                                echo '<td>'.$res_variable[0].'</td>';
                                echo '<td>'.$res_variable[1].'</td>';
                                echo '<td>'.date('d/m/Y',strtotime($res_variable[2])).'</td>';
                                echo '<td>'.$res_variable[3].'</td>';
                                
                                if($res_variable[3] != 'justificado'){
                                    
                                    echo '<td><form action="" method="GET">
                                
                                    <select name="articulo" class="custom-select">
                                        <option>Seleccione un artículo...</option>';

                                        while($res_articulos = mysqli_fetch_array($query_articulos)){
                                            echo '<option value='.$res_articulos[1].'>Artículo '.$res_articulos[1].'</option>';
                                        }

                                    echo '</select>
                                        <input type="hidden" value='.$res_variable[1].' name="legajo"/>
                                        <input type="hidden" value='.$res_variable[2].' name="fecha"/>
                                        </td>';
                                    echo 
                                        '<td> 
                                            <button type="submit" name="justificar" class="btn btn-success btn-sm">Impactar cambios</button></form>
                                        </td>';
                                    
                                }else{
                                    
                                    echo '<td colspan="2">'.$res_variable[4].'</td>';
                                    
                                }
                                
                                echo '</tr>';

                            }

                            echo '</table>';

                        } else {

                            $consulta_variable = $consulta;
                            $query_variable = mysqli_query($con, $consulta_variable);

                            echo '<table class="table table-striped table-bordered" style="text-align: center">';
                            echo '<tr><td>Id</td><td>Legajo</td><td>Fecha</td><td>Hora</td>';

                            while($res_variable = mysqli_fetch_array($query_variable)){

                                $res_variable[2] = date('d/m/Y',strtotime($res_variable[2]));
                                echo '<tr>';
                                echo '<td>'.$res_variable[0].'</td>';
                                echo '<td>'.$res_variable[1].'</td>';
                                echo '<td>'.$res_variable[2].'</td>';
                                echo '<td>'.$res_variable[3].'</td>';
                                echo '</tr>';
                            }

                            echo '</table>';

                        }

                    }
                
                    if(isset($_GET['justificar'])){
                        
                        $justificar_legajo = $_GET['legajo'];
                        $justificar_articulo = $_GET['articulo'];
                        $justificar_fecha = $_GET['fecha'];
                        
                        if($justificar_articulo == 'Seleccione un artículo...'){
                            
                            //echo 'Debe seleccionar un artículo válido';
                            
                        }else{
                            
                            $query_justificar = "UPDATE ausentes set estado = 'justificado' WHERE legajo = $justificar_legajo AND fecha = '$justificar_fecha'";
                            $query_descripcion = "UPDATE ausentes set Obsevaciones = 'justificado con artículo $justificar_articulo ' WHERE legajo = $justificar_legajo AND fecha = '$justificar_fecha'";
                            $consulta_justificar = mysqli_query($con, $query_justificar);
                            $consulta_descripcion = mysqli_query($con, $query_descripcion);   
                        }
                    }

                ?>

            </div>

        </div>

